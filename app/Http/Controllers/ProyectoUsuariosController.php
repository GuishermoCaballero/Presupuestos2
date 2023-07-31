<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\ProyectoEtiqueta;
use App\Models\ProyectoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProyectoUsuariosController extends Controller
{
    public function index(Request $request, $id)
    {
        $proyecto = Proyecto::with('usuarios.user')->find($id);

        return Inertia::render('Proyecto/Usuarios/Edit', [
            'proyecto' => $proyecto,
        ]);
    }

    public function save(Request $request, $id)
    {

        Log::info($request);

        $request->validate([
            'usuario' => ['required', 'email'],
        ]);

        $proyecto = Proyecto::find($id);

        $usuario_encontrado = User::where('email', $request->usuario)->first();

        if($usuario_encontrado){

            ProyectoUsuario::create([
                'proyecto_id' => $proyecto->id,
                'user_id' => $usuario_encontrado->id,
                'puede_ver' => false,
                'puede_editar_etiquetas' => false,
                'puede_editar_cantidades' => false,
                'puede_editar_usuarios' => false,
            ]);

            session()->flash('success', 'Usuario añadido correctamente');
            return Inertia::location(route('proyecto.usuarios.index', ['id' => $id]));

        }else{

            session()->flash('error', 'No se encontró ningún usuario registrado con ese correo');
            return Inertia::location(route('proyecto.usuarios.index', ['id' => $id]));

        }
        
        return Inertia::location(route('proyecto.usuarios.index', ['id' => $id]));
    }

    public function edit(Request $request, $id, $usuario)
    {
        $proyecto = Proyecto::find($id);

        $usuario = ProyectoUsuario::with('user')->find($usuario);

        $permissionColumns = [
            'puede_ver',
            'puede_editar_etiquetas',
            'puede_editar_cantidades',
            'puede_editar_usuarios',
        ];
        
        // Loop through the permission columns and convert the 1s and 0s to true and false
        foreach ($permissionColumns as $column) {
            // Convert the value from 1 to true, or 0 to false
            $usuario->$column = (bool) $usuario->$column;
        }

        return Inertia::render('Proyecto/Usuarios/Show', [
            'proyecto' => $proyecto,
            'usuario' => $usuario,
        ]);
    }

    public function save_permissions(Request $request, $id, $usuario)
    {
        Log::info($request);

        $proyecto = Proyecto::find($id);

        $usuario = ProyectoUsuario::with('user')->find($usuario);

        $request->validate([
            'puede_ver' => ['required', 'boolean'],
            'puede_editar_etiquetas' => ['required', 'boolean'],
            'puede_editar_cantidades' => ['required', 'boolean'],
            'puede_editar_usuarios' => ['required', 'boolean'],
        ]);

        $usuario->puede_ver = $request->puede_ver;
        $usuario->puede_editar_etiquetas = $request->puede_editar_etiquetas;
        $usuario->puede_editar_cantidades = $request->puede_editar_cantidades;
        $usuario->puede_editar_usuarios = $request->puede_editar_usuarios;
        $usuario->save();

        session()->flash('success', 'Permisos actualizados correctamente');

        return Redirect::route('proyecto.usuarios.edit', ['id' => $id, 'usuario' => $usuario->id]);
    }
}
