<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
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
        $proyecto = Proyecto::with('etiquetas')->find($id);

        return Inertia::render('Proyecto/Cantidades/Edit', [
            'proyecto' => $proyecto,
        ]);
    }

    public function save(Request $request, $id)
    {

        if($request->form == 'transferencia'){

            Log::info($request);

            $request->validate([
                'from' => ['required', 'numeric'],
                'to' => ['required', 'numeric'],
                'cantidad' => ['required','numeric'],
            ]);

            $proyecto = Proyecto::find($id);

            $etiqueta_from = ProyectoEtiqueta::findOrFail($request->from);
            $etiqueta_to = ProyectoEtiqueta::findOrFail($request->to);

            $usuario = auth()->user();

            if($request->cantidad  > $etiqueta_from->cantidad){
                session()->flash('error', 'No hay cantidad suficiente en '. $etiqueta_from->etiqueta .' para realizar la operación.');
                return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
            }else{

                $etiqueta_from->cantidad = $etiqueta_from->cantidad - $request->cantidad;
                $etiqueta_from->save();
                
                $etiqueta_to->cantidad = $etiqueta_to->cantidad + $request->cantidad;
                $etiqueta_to->save();

                $movimiento = Movimiento::create([
                    'proyecto_id' => $proyecto->id,
                    'user_id' => $usuario->id,
                    'valor' => 'Transfirió ' . $request->cantidad . '$ de ' . $etiqueta_from->etiqueta .' a ' . $etiqueta_to->etiqueta . '.',
                ]);

                session()->flash('success', 'Transferencia realizada correctamente');
                    
                return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));

            }
            
        }elseif($request->form == 'cambio'){

            $request->validate([
                'etiqueta' => ['required', 'numeric'],
                'accion' => ['required', 'string'],
                'cantidad' => ['required','numeric'],
            ]);

            $proyecto = Proyecto::find($id);

            $etiqueta = ProyectoEtiqueta::findOrFail($request->etiqueta);

            $usuario = auth()->user();

            if($request->accion == 'suma'){

                //Comprobar si en el presupuesto restante hay suficiente candidad para sumar
                if($proyecto->restante < $request->cantidad){
                    session()->flash('error', 'No hay suficiente presupuesto restante para realizar la operación.');
                    return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
                }else{
                    $nueva_cantidad = $etiqueta->cantidad + $request->cantidad;
                    
                    $etiqueta->cantidad = $nueva_cantidad;
                    $etiqueta->save();

                    $movimiento = Movimiento::create([
                        'proyecto_id' => $proyecto->id,
                        'user_id' => $usuario->id,
                        'valor' => 'Ha añadido ' . $request->cantidad . '$ a ' . $etiqueta->etiqueta .'.',
                    ]);
                    
                    session()->flash('success', 'Suma realizada correctamente');
                    
                    return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
                }

            }elseif($request->accion == 'resta'){

                //Comprobar si en la etiqueta hay suficiente cantidad para restar
                if($etiqueta->cantidad < $request->cantidad){ 

                    session()->flash('error', 'No hay suficiente cantidad para realizar la operación.');
                    return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));

                }else{

                    //Actualiza etiqueta y añade movimiento

                    $nueva_cantidad = $etiqueta->cantidad - $request->cantidad;
                    
                    $etiqueta->cantidad = $nueva_cantidad;
                    $etiqueta->save();

                    $movimiento = Movimiento::create([
                        'proyecto_id' => $proyecto->id,
                        'user_id' => $usuario->id,
                        'valor' => 'Ha quitado ' . $request->cantidad . '$ a ' . $etiqueta->etiqueta.'.',
                    ]);
                    
                    session()->flash('success', 'Resta realizada correctamente');
                    
                    return Inertia::location(route('proyecto.cantidades.edit', ['id' => $id]));
                    
                }
            }
        }
    }
}
