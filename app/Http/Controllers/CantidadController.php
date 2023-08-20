<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Movimiento;
use App\Models\Proyecto;
use App\Models\ProyectoCantidad;
use App\Models\ProyectoEtiqueta;
use App\Models\User;
use App\Models\UsuarioGasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CantidadController extends Controller
{
    public function edit(Request $request, $id)
    {

        $user = auth()->user();

        if (!$user->proyectos_admin()->contains('id', $id)) {
            abort(403, 'Unauthorized action.');
        }

        $proyecto = Proyecto::with('gastos', 'usuarios.user', 'user')->find($id);

        return Inertia::render('Proyecto/Cantidades/Edit', [
            'proyecto' => $proyecto,
        ]);
    }

    public function save(Request $request, $id)
    {

        $user = auth()->user();
        if (!$user->proyectos_admin()->contains('id', $id)) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'factura_id' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'observacion' => ['required', 'string'],
            'anadir_iva' => ['required', 'boolean'],
            'cantidad' => ['required', 'numeric'],
            'quien' => ['required', 'array'],
        ]);

        $proyecto = Proyecto::find($id);

        $usuario = auth()->user();


        //Comprobar si en el presupuesto restante hay suficiente candidad para sumar
        if ($proyecto->restante < $request->cantidad) {
            session()->flash('error', 'No hay suficiente presupuesto restante para añadir este gasto.');
            return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
        } else {

            $autor = User::find($request->quien);

            $gasto = Gasto::create([
                'proyecto_id' => $proyecto->id,
                'id_factura' => $request->factura_id,
                'nombre' => $request->nombre,
                'observacion' => $request->observacion,
                'anadir_iva' => $request->anadir_iva,
                'cantidad' => $request->cantidad,
                'cantidad_iva' => ($request->anadir_iva == True ? $request->cantidad*1.21 : 0),
            ]);

            foreach($request->quien as $quien_id){
/*                 $user = User::find($id);
 */
                UsuarioGasto::create([
                    'gasto_id' => $gasto->id,
                    'usuario_id' => $quien_id,
                    'cantidad' => $request->cantidad / count($request->quien),
                ]);

            }

            $movimiento = Movimiento::create([
                'proyecto_id' => $proyecto->id,
                'user_id' => 1,
                'valor' => 'Ha gastado ' . $request->cantidad . '$ a ',
            ]);

            session()->flash('success', 'Gasto añadido correctamente');

            return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
        }
    }
}
