<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ProyectoCantidad;
use App\Models\ProyectoEtiqueta;
use Illuminate\Http\Request;
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
}
