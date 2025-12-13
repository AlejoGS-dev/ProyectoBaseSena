<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajo;
use App\Models\Propuesta;
use App\Models\FreelancerPerfil;
use App\Models\User;
use App\Models\Calificacion;
use App\Models\Categoria;
use App\Models\Entrega;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    // Vista principal para clientes
    public function clienteIndex()
    {
        $user = Auth::user();

        return view('home.home.workspace-cliente', [
            'user' => $user,
        ]);
    }

    // Vista principal para freelancers
    public function freelancerIndex()
    {
        $user = Auth::user();

        return view('home.home.workspace-freelancer', [
            'user' => $user,
        ]);
    }

    // API: Obtener trabajos del cliente
    public function getMisTrabajos()
    {
        $userId = Auth::id();

        $trabajos = Trabajo::where('cliente_id', $userId)
            ->with(['freelancer', 'categoria', 'propuestas', 'habilidades'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($trabajos);
    }

    // API: Obtener propuestas recibidas para trabajos del cliente
    public function getPropuestasRecibidas()
    {
        $userId = Auth::id();

        $propuestas = Propuesta::whereHas('trabajo', function($query) use ($userId) {
                $query->where('cliente_id', $userId);
            })
            ->with(['freelancer.freelancerPerfil', 'trabajo'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($propuestas);
    }

    // API: Obtener freelancers disponibles
    public function getFreelancers(Request $request)
    {
        $query = User::role('freelancer')
            ->with(['freelancerPerfil', 'portfolioItems']);

        // Filtro por categoría
        if ($request->has('categoria_id')) {
            $query->whereHas('freelancerPerfil', function($q) use ($request) {
                $q->whereJsonContains('categorias_preferidas', [(int)$request->categoria_id]);
            });
        }

        // Filtro por calificación mínima
        if ($request->has('min_rating')) {
            $query->whereHas('freelancerPerfil', function($q) use ($request) {
                $q->where('calificacion_promedio', '>=', $request->min_rating);
            });
        }

        // Ordenar
        $orderBy = $request->get('order_by', 'rating');
        switch ($orderBy) {
            case 'rating':
                $query->join('freelancer_perfiles', 'users.id', '=', 'freelancer_perfiles.user_id')
                    ->orderBy('freelancer_perfiles.calificacion_promedio', 'desc')
                    ->select('users.*');
                break;
            case 'experience':
                $query->join('freelancer_perfiles', 'users.id', '=', 'freelancer_perfiles.user_id')
                    ->orderBy('freelancer_perfiles.anos_experiencia', 'desc')
                    ->select('users.*');
                break;
            case 'price_low':
                $query->join('freelancer_perfiles', 'users.id', '=', 'freelancer_perfiles.user_id')
                    ->orderBy('freelancer_perfiles.tarifa_por_hora', 'asc')
                    ->select('users.*');
                break;
            case 'price_high':
                $query->join('freelancer_perfiles', 'users.id', '=', 'freelancer_perfiles.user_id')
                    ->orderBy('freelancer_perfiles.tarifa_por_hora', 'desc')
                    ->select('users.*');
                break;
        }

        $freelancers = $query->get();

        return response()->json($freelancers);
    }

    // API: Obtener trabajos disponibles (para freelancers)
    public function getTrabajosDisponibles(Request $request)
    {
        $query = Trabajo::where('estado', 'publicado')
            ->with(['cliente', 'categoria', 'habilidades']);

        // Filtro por categoría
        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Filtro por rango de presupuesto
        if ($request->has('min_budget')) {
            $query->where(function($q) use ($request) {
                $q->where('presupuesto_min', '>=', $request->min_budget)
                    ->orWhere('presupuesto_max', '>=', $request->min_budget);
            });
        }

        if ($request->has('max_budget')) {
            $query->where(function($q) use ($request) {
                $q->where('presupuesto_max', '<=', $request->max_budget)
                    ->orWhere('presupuesto_min', '<=', $request->max_budget);
            });
        }

        $trabajos = $query->orderBy('created_at', 'desc')->get();

        return response()->json($trabajos);
    }

    // API: Obtener propuestas enviadas por el freelancer
    public function getMisPropuestas()
    {
        $userId = Auth::id();

        $propuestas = Propuesta::where('freelancer_id', $userId)
            ->with(['trabajo.cliente', 'trabajo.categoria'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($propuestas);
    }

    // API: Obtener trabajos en progreso
    public function getTrabajosEnProgreso()
    {
        $userId = Auth::id();
        $user = Auth::user();

        if ($user->hasRole('cliente')) {
            $trabajos = Trabajo::where('cliente_id', $userId)
                ->where('estado', 'en_progreso')
                ->with(['freelancer', 'categoria'])
                ->get();
        } else {
            $trabajos = Trabajo::where('freelancer_id', $userId)
                ->where('estado', 'en_progreso')
                ->with(['cliente', 'categoria'])
                ->get();
        }

        return response()->json($trabajos);
    }

    // API: Obtener trabajos completados
    public function getTrabajosCompletados()
    {
        $userId = Auth::id();
        $user = Auth::user();

        if ($user->hasRole('cliente')) {
            $trabajos = Trabajo::where('cliente_id', $userId)
                ->where('estado', 'completado')
                ->with(['freelancer', 'categoria', 'calificaciones'])
                ->get();
        } else {
            $trabajos = Trabajo::where('freelancer_id', $userId)
                ->where('estado', 'completado')
                ->with(['cliente', 'categoria', 'calificaciones'])
                ->get();
        }

        return response()->json($trabajos);
    }

    // API: Enviar propuesta
    public function enviarPropuesta(Request $request)
    {
        $request->validate([
            'trabajo_id' => 'required|exists:trabajos,id',
            'carta_presentacion' => 'required|string|min:50',
            'tarifa_propuesta' => 'required|numeric|min:0',
            'tiempo_estimado' => 'required|integer|min:1',
        ]);

        $propuesta = Propuesta::create([
            'trabajo_id' => $request->trabajo_id,
            'freelancer_id' => Auth::id(),
            'carta_presentacion' => $request->carta_presentacion,
            'tarifa_propuesta' => $request->tarifa_propuesta,
            'tipo_tarifa' => $request->tipo_tarifa ?? 'fijo',
            'tiempo_estimado' => $request->tiempo_estimado,
            'estado' => 'pendiente',
        ]);

        // Incrementar contador de propuestas en el trabajo
        $trabajo = Trabajo::find($request->trabajo_id);
        $trabajo->increment('num_propuestas');

        return response()->json([
            'success' => true,
            'message' => 'Propuesta enviada exitosamente',
            'propuesta' => $propuesta->load('trabajo')
        ]);
    }

    // API: Aceptar propuesta
    public function aceptarPropuesta(Request $request, $id)
    {
        $propuesta = Propuesta::findOrFail($id);

        // Verificar que el trabajo pertenece al cliente autenticado
        if ($propuesta->trabajo->cliente_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $propuesta->update([
            'estado' => 'aceptada',
            'aceptada_en' => now(),
        ]);

        // Actualizar el trabajo
        $trabajo = $propuesta->trabajo;
        $trabajo->update([
            'freelancer_id' => $propuesta->freelancer_id,
            'estado' => 'en_progreso',
            'asignado_en' => now(),
        ]);

        // Rechazar otras propuestas
        Propuesta::where('trabajo_id', $trabajo->id)
            ->where('id', '!=', $id)
            ->update([
                'estado' => 'rechazada',
                'rechazada_en' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Propuesta aceptada exitosamente',
        ]);
    }

    // API: Crear calificación
    public function crearCalificacion(Request $request)
    {
        $request->validate([
            'trabajo_id' => 'required|exists:trabajos,id',
            'evaluado_id' => 'required|exists:users,id',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
            'comunicacion' => 'nullable|integer|min:1|max:5',
            'calidad_trabajo' => 'nullable|integer|min:1|max:5',
            'cumplimiento_plazo' => 'nullable|integer|min:1|max:5',
            'profesionalismo' => 'nullable|integer|min:1|max:5',
        ]);

        $userId = Auth::id();
        $user = Auth::user();

        // Determinar tipo de calificación
        $tipo = $user->hasRole('cliente') ? 'cliente_a_freelancer' : 'freelancer_a_cliente';

        $calificacion = Calificacion::create([
            'trabajo_id' => $request->trabajo_id,
            'evaluador_id' => $userId,
            'evaluado_id' => $request->evaluado_id,
            'tipo' => $tipo,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'comunicacion' => $request->comunicacion,
            'calidad_trabajo' => $request->calidad_trabajo,
            'cumplimiento_plazo' => $request->cumplimiento_plazo,
            'profesionalismo' => $request->profesionalismo,
            'verificado' => true,
        ]);

        // Actualizar calificación promedio del evaluado si es freelancer
        if ($tipo === 'cliente_a_freelancer') {
            $perfil = FreelancerPerfil::where('user_id', $request->evaluado_id)->first();
            if ($perfil) {
                $promedio = Calificacion::where('evaluado_id', $request->evaluado_id)
                    ->where('tipo', 'cliente_a_freelancer')
                    ->avg('calificacion');

                $total = Calificacion::where('evaluado_id', $request->evaluado_id)
                    ->where('tipo', 'cliente_a_freelancer')
                    ->count();

                $perfil->update([
                    'calificacion_promedio' => round($promedio, 2),
                    'total_calificaciones' => $total,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Calificación enviada exitosamente',
            'calificacion' => $calificacion
        ]);
    }

    // API: Obtener perfil completo de freelancer
    public function getFreelancerProfile($id)
    {
        $freelancer = User::with([
            'freelancerPerfil',
            'portfolioItems.categoria',
            'calificacionesRecibidas' => function($query) {
                $query->where('tipo', 'cliente_a_freelancer')
                    ->with('evaluador')
                    ->latest()
                    ->limit(10);
            }
        ])->findOrFail($id);

        return response()->json($freelancer);
    }

    // API: Obtener categorías
    public function getCategorias()
    {
        $categorias = Categoria::where('activo', true)->get();
        return response()->json($categorias);
    }

    // API: Entregar trabajo (freelancer)
    public function entregarTrabajo(Request $request)
    {
        $request->validate([
            'trabajo_id' => 'required|exists:trabajos,id',
            'mensaje' => 'required|string|min:20',
            'repositorio_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'archivos' => 'nullable|array',
        ]);

        $trabajo = Trabajo::findOrFail($request->trabajo_id);

        // Verificar que el freelancer sea el asignado
        if ($trabajo->freelancer_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        // Verificar que el trabajo esté en progreso o requiera cambios
        if (!in_array($trabajo->estado, ['en_progreso', 'requiere_cambios'])) {
            return response()->json(['error' => 'El trabajo no está en un estado válido para entregar'], 400);
        }

        // Calcular número de revisión
        $revision = $trabajo->entregas()->count() + 1;

        // Crear la entrega
        $entrega = Entrega::create([
            'trabajo_id' => $request->trabajo_id,
            'freelancer_id' => Auth::id(),
            'mensaje' => $request->mensaje,
            'repositorio_url' => $request->repositorio_url,
            'demo_url' => $request->demo_url,
            'archivos' => $request->archivos,
            'revision' => $revision,
            'estado' => 'pendiente_revision',
        ]);

        // Actualizar estado del trabajo a "en revisión"
        $trabajo->update(['estado' => 'en_revision']);

        return response()->json([
            'success' => true,
            'message' => 'Trabajo entregado exitosamente',
            'entrega' => $entrega->load('trabajo')
        ]);
    }

    // API: Aprobar entrega (cliente)
    public function aprobarEntrega(Request $request, $id)
    {
        $entrega = Entrega::findOrFail($id);

        // Verificar que el trabajo pertenece al cliente autenticado
        if ($entrega->trabajo->cliente_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        // Verificar que la entrega esté pendiente de revisión
        if ($entrega->estado !== 'pendiente_revision') {
            return response()->json(['error' => 'Esta entrega ya fue revisada'], 400);
        }

        // Aprobar entrega
        $entrega->update([
            'estado' => 'aprobada',
            'aprobada_en' => now(),
        ]);

        // Actualizar estado del trabajo a completado
        $entrega->trabajo->update([
            'estado' => 'completado',
            'completado_en' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Entrega aprobada exitosamente',
        ]);
    }

    // API: Rechazar entrega (cliente)
    public function rechazarEntrega(Request $request, $id)
    {
        $request->validate([
            'feedback_cliente' => 'required|string|min:20',
        ]);

        $entrega = Entrega::findOrFail($id);

        // Verificar que el trabajo pertenece al cliente autenticado
        if ($entrega->trabajo->cliente_id !== Auth::id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        // Verificar que la entrega esté pendiente de revisión
        if ($entrega->estado !== 'pendiente_revision') {
            return response()->json(['error' => 'Esta entrega ya fue revisada'], 400);
        }

        // Rechazar entrega
        $entrega->update([
            'estado' => 'rechazada',
            'feedback_cliente' => $request->feedback_cliente,
            'rechazada_en' => now(),
        ]);

        // Actualizar estado del trabajo a "requiere cambios"
        $entrega->trabajo->update(['estado' => 'requiere_cambios']);

        return response()->json([
            'success' => true,
            'message' => 'Entrega rechazada. Se ha solicitado correcciones al freelancer.',
        ]);
    }

    // API: Obtener entregas de un trabajo
    public function getEntregas($trabajoId)
    {
        $trabajo = Trabajo::findOrFail($trabajoId);
        $userId = Auth::id();

        // Verificar que el usuario sea el cliente o el freelancer del trabajo
        if ($trabajo->cliente_id !== $userId && $trabajo->freelancer_id !== $userId) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $entregas = Entrega::where('trabajo_id', $trabajoId)
            ->with('freelancer')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($entregas);
    }
}
