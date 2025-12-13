<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Propuesta;
use App\Models\Categoria;
use App\Models\Habilidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkspaceClienteController extends Controller
{
    /**
     * Mostrar workspace del cliente
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Obtener trabajos del cliente
        $trabajosPublicados = Trabajo::where('cliente_id', $user->id)
            ->where('estado', 'publicado')
            ->withCount('propuestas')
            ->with(['categoria', 'habilidades'])
            ->latest()
            ->get();

        $trabajosEnProgreso = Trabajo::where('cliente_id', $user->id)
            ->whereIn('estado', ['asignado', 'en_progreso'])
            ->with(['freelancer', 'categoria', 'habilidades'])
            ->latest()
            ->get();

        $trabajosCompletados = Trabajo::where('cliente_id', $user->id)
            ->where('estado', 'completado')
            ->with(['freelancer', 'categoria'])
            ->latest()
            ->take(10)
            ->get();

        // Obtener propuestas recientes
        $propuestasRecientes = Propuesta::whereHas('trabajo', function($q) use ($user) {
                $q->where('cliente_id', $user->id);
            })
            ->where('estado', 'pendiente')
            ->with(['freelancer', 'trabajo'])
            ->latest()
            ->take(20)
            ->get();

        // Freelancers disponibles (usuarios con rol freelancer)
        $freelancers = User::role('freelancer')
            ->where('activo', true)
            ->withCount('trabajosComoFreelancer')
            ->latest()
            ->paginate(12);

        // Categorías y habilidades para formulario
        $categorias = Categoria::where('activo', true)->get();
        $habilidades = Habilidad::where('activo', true)->get();

        // Estadísticas
        $stats = [
            'total_trabajos' => Trabajo::where('cliente_id', $user->id)->count(),
            'en_progreso' => $trabajosEnProgreso->count(),
            'completados' => Trabajo::where('cliente_id', $user->id)->where('estado', 'completado')->count(),
            'propuestas_pendientes' => $propuestasRecientes->count()
        ];

        return view('home.workspaces.cliente.index', compact(
            'trabajosPublicados',
            'trabajosEnProgreso',
            'trabajosCompletados',
            'propuestasRecientes',
            'freelancers',
            'categorias',
            'habilidades',
            'stats'
        ));
    }

    /**
     * Crear nuevo trabajo
     */
    public function crearTrabajo(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_presupuesto' => 'required|in:fijo,por_hora,rango',
            'presupuesto_min' => 'nullable|numeric|min:0',
            'presupuesto_max' => 'nullable|numeric|min:0',
            'duracion_estimada' => 'nullable|integer|min:1',
            'modalidad' => 'required|in:remoto,presencial,hibrido',
            'nivel_experiencia' => 'nullable|in:principiante,intermedio,avanzado,experto',
            'habilidades' => 'nullable|array',
            'habilidades.*' => 'exists:habilidades,id'
        ]);

        DB::beginTransaction();
        try {
            $trabajo = Trabajo::create([
                'cliente_id' => Auth::id(),
                'titulo' => $validated['titulo'],
                'descripcion' => $validated['descripcion'],
                'categoria_id' => $validated['categoria_id'],
                'tipo_presupuesto' => $validated['tipo_presupuesto'],
                'presupuesto_min' => $validated['presupuesto_min'] ?? null,
                'presupuesto_max' => $validated['presupuesto_max'] ?? null,
                'duracion_estimada' => $validated['duracion_estimada'] ?? null,
                'modalidad' => $validated['modalidad'],
                'nivel_experiencia' => $validated['nivel_experiencia'] ?? null,
                'estado' => 'publicado',
                'publicado_en' => now()
            ]);

            // Sincronizar habilidades
            if (isset($validated['habilidades'])) {
                $trabajo->habilidades()->sync($validated['habilidades']);
            }

            DB::commit();

            return redirect()->route('workspace.cliente')
                ->with('success', 'Trabajo publicado exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear el trabajo: ' . $e->getMessage()]);
        }
    }

    /**
     * Ver propuestas de un trabajo específico
     */
    public function verPropuestas($trabajoId)
    {
        $trabajo = Trabajo::where('id', $trabajoId)
            ->where('cliente_id', Auth::id())
            ->with(['propuestas.freelancer', 'categoria', 'habilidades'])
            ->firstOrFail();

        return view('home.workspaces.cliente.propuestas', compact('trabajo'));
    }

    /**
     * Aceptar una propuesta
     */
    public function aceptarPropuesta(Request $request, $propuestaId)
    {
        DB::beginTransaction();
        try {
            $propuesta = Propuesta::findOrFail($propuestaId);

            // Verificar que el trabajo pertenece al cliente
            if ($propuesta->trabajo->cliente_id !== Auth::id()) {
                return back()->withErrors(['error' => 'No autorizado']);
            }

            // Actualizar propuesta
            $propuesta->update([
                'estado' => 'aceptada',
                'aceptada_en' => now()
            ]);

            // Actualizar trabajo
            $propuesta->trabajo->update([
                'freelancer_id' => $propuesta->freelancer_id,
                'estado' => 'asignado',
                'asignado_en' => now()
            ]);

            // Rechazar otras propuestas
            Propuesta::where('trabajo_id', $propuesta->trabajo_id)
                ->where('id', '!=', $propuestaId)
                ->where('estado', 'pendiente')
                ->update(['estado' => 'rechazada', 'rechazada_en' => now()]);

            DB::commit();

            return redirect()->route('workspace.cliente')
                ->with('success', 'Propuesta aceptada. El trabajo ha sido asignado.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al aceptar propuesta: ' . $e->getMessage()]);
        }
    }

    /**
     * Marcar trabajo como completado
     */
    public function completarTrabajo(Request $request, $trabajoId)
    {
        $trabajo = Trabajo::where('id', $trabajoId)
            ->where('cliente_id', Auth::id())
            ->firstOrFail();

        $trabajo->update([
            'estado' => 'completado',
            'completado_en' => now()
        ]);

        return redirect()->route('workspace.cliente')
            ->with('success', 'Trabajo marcado como completado');
    }

    /**
     * Eliminar trabajo
     */
    public function eliminarTrabajo($trabajoId)
    {
        $trabajo = Trabajo::where('id', $trabajoId)
            ->where('cliente_id', Auth::id())
            ->firstOrFail();

        // Solo permitir eliminar si no está asignado
        if (in_array($trabajo->estado, ['asignado', 'en_progreso'])) {
            return back()->withErrors(['error' => 'No puedes eliminar un trabajo en progreso']);
        }

        $trabajo->delete();

        return redirect()->route('workspace.cliente')
            ->with('success', 'Trabajo eliminado');
    }
}
