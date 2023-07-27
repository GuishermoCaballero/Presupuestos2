<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Proyecto;
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
        /* $usuarios = User::get(); */

        return Inertia::render('Proyecto/Create'/* , [
            'usuarios' => $usuarios,
        ] */);
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

        return Redirect::route('dashboard');
    }

    public function show(Request $request, $id)
    {
        $proyecto = Proyecto::find($id);

        return Inertia::render('Proyecto/Show', [
            'proyecto' => $proyecto,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $proyecto = Proyecto::find($id);

        return Inertia::render('Proyecto/Edit', [
            'proyecto' => $proyecto,
        ]);
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::find($id);

        

        return Inertia::render('Proyecto/Edit', [
            'proyecto' => $proyecto,
        ]);
    }
}
