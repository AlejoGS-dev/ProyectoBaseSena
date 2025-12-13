<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Propuesta;
use App\Models\Categoria;
use App\Models\Habilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkspaceFreelancerController extends Controller
{
    /**
     * Mostrar workspace del freelancer
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Trabajos disponibles (publicados, no asignados)
        $trabajosDisponibles = Trabajo::where('estado', 'publicado')
            ->whereNull('freelancer_id')
            ->whereDoesntHave('propuestas', function($q) use ($user) {
                $q->where('freelancer_id', $user->id);
            })
            ->with(['cliente', 'categoria', 'habilidades'])
            ->withCount('propuestas')
            ->latest('publicado_en')
            ->paginate(10);

        // Mis propuestas activas
        $misPropuestas = Propuesta::where('freelancer_id', $user->id)
            ->whereIn('estado', ['pendiente', 'en_revision'])
            ->with(['trabajo.cliente', 'trabajo.categoria'])
            ->latest()
            ->get();

        // Trabajos asignados/en progreso
        $trabajosActivos = Trabajo::where('freelancer_id', $user->id)
            ->whereIn('estado', ['asignado', 'en_progreso'])
            ->with(['cliente', 'categoria'])
            ->latest()
            ->get();

        // Historial de trabajos completados
        $trabajosCompletados = Trabajo::where('freelancer_id', $user->id)
            ->where('estado', 'completado')
            ->with(['cliente', 'categoria'])
            ->latest('completado_en')
            ->take(10)
            ->get();

        // Estadísticas
        $stats = [
            'trabajos_completados' => Trabajo::where('freelancer_id', $user->id)
                ->where('estado', 'completado')
                ->count(),
            'ganancias_totales' => Propuesta::where('freelancer_id', $user->id)
                ->where('estado', 'aceptada')
                ->whereHas('trabajo', function($q) {
                    $q->where('estado', 'completado');
                })
                ->sum('tarifa_propuesta'),
            'propuestas_activas' => $misPropuestas->count(),
            'trabajos_en_progreso' => $trabajosActivos->count()
        ];

        // Categorías para filtros
        $categorias = Categoria::where('activo', true)->get();
        $habilidades = Habilidad::where('activo', true)->get();

        return view('home.workspaces.freelancer.index', compact(
            'trabajosDisponibles',
            'misPropuestas',
            'trabajosActivos',
            'trabajosCompletados',
            'stats',
            'categorias',
            'habilidades'
        ));
    }

    /**
     * Buscar trabajos con filtros
     */
    public function buscarTrabajos(Request $request)
    {
        $query = Trabajo::where('estado', 'publicado')
            ->whereNull('freelancer_id');

        // Filtro por categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Filtro por habilidades
        if ($request->filled('habilidades')) {
            $query->whereHas('habilidades', function($q) use ($request) {
                $q->whereIn('habilidades.id', $request->habilidades);
            });
        }

        // Filtro por presupuesto
        if ($request->filled('presupuesto_min')) {
            $query->where('presupuesto_max', '>=', $request->presupuesto_min);
        }

        // Filtro por modalidad
        if ($request->filled('modalidad')) {
            $query->where('modalidad', $request->modalidad);
        }

        // Filtro por búsqueda de texto
        if ($request->filled('busqueda')) {
            $query->where(function($q) use ($request) {
                $q->where('titulo', 'like', '%' . $request->busqueda . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->busqueda . '%');
            });
        }

        $trabajos = $query->with(['cliente', 'categoria', 'habilidades'])
            ->withCount('propuestas')
            ->latest('publicado_en')
            ->paginate(10);

        return response()->json($trabajos);
    }

    /**
     * Ver detalle de un trabajo
     */
    public function verTrabajo($trabajoId)
    {
        $trabajo = Trabajo::where('id', $trabajoId)
            ->where('estado', 'publicado')
            ->with(['cliente', 'categoria', 'habilidades'])
            ->withCount('propuestas')
            ->firstOrFail();

        // Verificar si ya envió propuesta
        $propuestaEnviada = Propuesta::where('trabajo_id', $trabajoId)
            ->where('freelancer_id', Auth::id())
            ->first();

        return view('home.workspaces.freelancer.detalle-trabajo', compact('trabajo', 'propuestaEnviada'));
    }

    /**
     * Enviar propuesta a un trabajo
     */
    public function enviarPropuesta(Request $request, $trabajoId)
    {
        $validated = $request->validate([
            'carta_presentacion' => 'required|string|min:50',
            'tarifa_propuesta' => 'required|numeric|min:0',
            'tipo_tarifa' => 'required|in:fijo,por_hora',
            'tiempo_estimado' => 'nullable|integer|min:1'
        ]);

        $trabajo = Trabajo::findOrFail($trabajoId);

        // Verificar que el trabajo esté disponible
        if ($trabajo->estado !== 'publicado' || $trabajo->freelancer_id !== null) {
            return back()->withErrors(['error' => 'Este trabajo ya no está disponible']);
        }

        // Verificar que no haya enviado propuesta antes
        $propuestaExistente = Propuesta::where('trabajo_id', $trabajoId)
            ->where('freelancer_id', Auth::id())
            ->first();

        if ($propuestaExistente) {
            return back()->withErrors(['error' => 'Ya has enviado una propuesta para este trabajo']);
        }

        try {
            Propuesta::create([
                'trabajo_id' => $trabajoId,
                'freelancer_id' => Auth::id(),
                'carta_presentacion' => $validated['carta_presentacion'],
                'tarifa_propuesta' => $validated['tarifa_propuesta'],
                'tipo_tarifa' => $validated['tipo_tarifa'],
                'tiempo_estimado' => $validated['tiempo_estimado'] ?? null,
                'estado' => 'pendiente'
            ]);

            // Incrementar contador de propuestas
            $trabajo->increment('num_propuestas');

            return redirect()->route('workspace.freelancer')
                ->with('success', 'Propuesta enviada exitosamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al enviar propuesta: ' . $e->getMessage()]);
        }
    }

    /**
     * Marcar trabajo como completado (freelancer)
     */
    public function marcarCompletado($trabajoId)
    {
        $trabajo = Trabajo::where('id', $trabajoId)
            ->where('freelancer_id', Auth::id())
            ->whereIn('estado', ['asignado', 'en_progreso'])
            ->firstOrFail();

        // Cambiar a estado "en revisión" para que el cliente confirme
        $trabajo->update([
            'estado' => 'en_revision'
        ]);

        return redirect()->route('workspace.freelancer')
            ->with('success', 'Trabajo marcado como completado. Esperando confirmación del cliente.');
    }

    /**
     * Retirar propuesta
     */
    public function retirarPropuesta($propuestaId)
    {
        $propuesta = Propuesta::where('id', $propuestaId)
            ->where('freelancer_id', Auth::id())
            ->where('estado', 'pendiente')
            ->firstOrFail();

        $propuesta->update(['estado' => 'retirada']);

        // Decrementar contador
        $propuesta->trabajo->decrement('num_propuestas');

        return redirect()->route('workspace.freelancer')
            ->with('success', 'Propuesta retirada');
    }
}
