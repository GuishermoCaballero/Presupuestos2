<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Movimiento;
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

        $user = auth()->user();

        $proyectos = $user->proyectos_asignados();

        // Loop through the $proyectos array and update the image_url parameter
        foreach ($proyectos as $proyecto) {
            // Concatenate the base URL with the existing image_url
            $proyecto->imagen_url = env('APP_URL'). $proyecto->imagen_url;

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
            $path = 'public/files/'. $fileName;

            Storage::disk('local')->put($path, file_get_contents($file));
        }

        $user = auth()->user();

        $proyecto = Proyecto::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen_url' => 'storage/files/'.$fileName,
            'presupuesto' => $request->presupuesto,
        ]);

        return Redirect::route('dashboard');
    }

    public function show(Request $request, $id)
    {
        $user = auth()->user();
        
        if (!$user->proyectos_asignados()->contains('id',$id)) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->proyectos_admin()->contains('id',$id)) {
            $user->is_admin = true;
        }else{
            $user->is_admin = false;
        }

        $proyecto = Proyecto::with('etiquetas','usuarios.user','user')->find($id);

        $movimientos = Movimiento::where('proyecto_id', $id)->with('user')->orderBy('created_at', 'desc')->get();

        $proyecto->imagen_url = env('APP_URL'). $proyecto->imagen_url;

        return Inertia::render('Proyecto/Show', [
            'proyecto' => $proyecto,
            'usuario' => $user,
            'movimientos' => $movimientos,
        ]);
    }

    public function delete(Request $request, $id)
    {
        $user = auth()->user();
        
        $proyecto = Proyecto::with('etiquetas')->find($id);

        // Check if the proyecto exists and belongs to the logged-in user
        if (!$proyecto || $proyecto->user_id !== $user->id) {
            abort(404); // Or handle the unauthorized action as needed
        }

        // Perform the deletion
        $proyecto->delete();

        return redirect()->route('dashboard'); // Redirect to the dashboard after deletion
    }



}
