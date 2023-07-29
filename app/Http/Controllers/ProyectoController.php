<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Proyecto;
use App\Models\ProyectoCantidad;
use App\Models\ProyectoEtiqueta;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProyectoController extends Controller
{

    public function index(Request $request): Response
    {
        $proyectos = Proyecto::get(); 

        return Inertia::render('Dashboard', [
            'proyectos' => $proyectos,
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Proyecto/Create');
    }

    public function save(Request $request)
    {
        Log::info($request);

        $request->validate([
            'nombre' => ['required'],
            'descripcion' => ['required'],
            'imagen_url' => ['required'],
        ]);

        $user = auth()->user();

        $proyecto = Proyecto::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen_url' => $request->imagen_url,
        ]);

        $etiqueta_total = ProyectoEtiqueta::create([
            'proyecto_id' => $proyecto->id,
            'etiqueta' => 'TOTAL',
        ]);

        $etiqueta_gastado = ProyectoEtiqueta::create([
            'proyecto_id' => $proyecto->id,
            'etiqueta' => 'GASTADO',
        ]);

        $total_cantidad = ProyectoCantidad::create([
            'proyecto_id' => $proyecto->id,
            'etiqueta_id' => $etiqueta_total->id,
            'cantidad' => 0.0
        ]);

        $gastado_cantidad = ProyectoCantidad::create([
            'proyecto_id' => $proyecto->id,
            'etiqueta_id' => $etiqueta_gastado->id,
            'cantidad' => 0.0
        ]);

        return Redirect::route('dashboard');
    }

    public function show(Request $request, $id)
    {
        $proyecto = Proyecto::find($id);

        return Inertia::render('Proyecto/Show', [
            'proyecto' => $proyecto,
        ]);
    }


}
