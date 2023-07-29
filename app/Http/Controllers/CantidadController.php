<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ProyectoCantidad;
use App\Models\ProyectoEtiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CantidadController extends Controller
{
    public function edit(Request $request, $id)
    {

        Log::info($request);
        $proyecto = Proyecto::with('etiquetas')->find($id);

        return Inertia::render('Proyecto/Cantidades/Edit', [
            'proyecto' => $proyecto,
        ]);
    }

    public function save(Request $request, $id)
    {
        Log::info($request);

        $request->validate([
            'etiqueta' => ['required'],
        ]);

        $etiqueta = ProyectoEtiqueta::create([
            'proyecto_id' => $id,
            'etiqueta' => $request->etiqueta,
        ]);

        $cantidad = ProyectoCantidad::create([
            'proyecto_id' => $id,
            'etiqueta_id' => $etiqueta->id,
            'cantidad' => 0.0
        ]);

        return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
    }

    public function destroyEtiquetaCantidad(Request $request, $id, ProyectoEtiqueta $etiqueta)
    {
        DB::beginTransaction();

        try {
            $proyectoCantidad = ProyectoCantidad::where('proyecto_id', $id)
                ->where('etiqueta_id', $etiqueta->id)
                ->first();
            print($proyectoCantidad);
            if ($proyectoCantidad) {
                // Si existe un registro en proyecto_cantidad para esta etiqueta, lo eliminamos primero
                $proyectoCantidad->delete();
            }

            // Luego, eliminamos la etiqueta
            $etiqueta->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Manejar cualquier error si es necesario
            // Por ejemplo, puedes registrar el error en los logs o devolver una respuesta de error personalizada
            Log::error('Error al eliminar etiqueta: ' . $e->getMessage());
            return response()->json(['error' => 'Hubo un error al eliminar la etiqueta.'], 500);
        }

        return Inertia::location(route('proyecto.etiquetas.edit', ['id' => $id]));
    }
}
