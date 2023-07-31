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
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProyectoController extends Controller
{

    public function index(Request $request): Response
    {
        $proyectos = Proyecto::get(); 

        $base_url = 'http://presupuestos2.test/';

        // Loop through the $proyectos array and update the image_url parameter
        foreach ($proyectos as $proyecto) {
            // Concatenate the base URL with the existing image_url
            $proyecto['imagen_url'] = $base_url . urlencode($proyecto['imagen_url']);
            Log::info($proyecto['imagen_url']);
        }

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
            'nombre' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            /* 'imagen_url' => ['required'], */
            'presupuesto' => ['numeric'],
        ]);
        
        $path = '';

        if($request->hasFile('imagen_url')){
            $file = $request->file('imagen_url');
            $fileName = $file->getClientOriginalName();
            $path = 'storage/files/'. $fileName;

            Storage::disk('local')->put($path, file_get_contents($file));
        }
        //$imagePath = $request->file('imagen_url')->store('imagen_url', 'public');

        $user = auth()->user();

        $proyecto = Proyecto::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen_url' => $path,
            'presupuesto' => $request->presupuesto,
        ]);

        return Redirect::route('dashboard');
    }

    public function show(Request $request, $id)
    {
        $proyecto = Proyecto::with('etiquetas')->find($id);

        return Inertia::render('Proyecto/Show', [
            'proyecto' => $proyecto,
        ]);
    }


}
