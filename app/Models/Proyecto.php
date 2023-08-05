<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Object_;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'imagen_url',
        'presupuesto',
    ];

    protected $appends = ['gastado', 'restante', 'chart', 'user_chart'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etiquetas()
    {
        return $this->hasMany(ProyectoEtiqueta::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function usuarios()
    {
        return $this->hasMany(ProyectoUsuario::class);
    }

    public function getGastadoAttribute()
    {
        $gastado = $this->etiquetas->sum('cantidad');
        return $gastado;
    }

    public function getRestanteAttribute()
    {
        $gastado = $this->etiquetas->sum('cantidad');
        $restante = $this->presupuesto - $gastado;
        return $restante;
    }

    public function getChartAttribute()
    {
        $info = [['Daily Routine', 'Hours per Day']];
    
        foreach($this->etiquetas as $etiqueta){
            $new_value = [$etiqueta->etiqueta, $etiqueta->cantidad];
            array_push($info, $new_value);
        }

        $new_value = ['Restante', $this->restante];
        array_push($info, $new_value);

        return $info;
    }

    public function getUserChartAttribute()
    {
        $info = [['Daily Routine', 'Dinero gastado']];


        $usuarios = $this->usuarios;
        $users = collect();
        foreach ($usuarios as $usuario) {
            $new_value = $usuario->user;
            $users->push($new_value);
        }
        
        $usuario_creador = $this->user;
        Log::info($usuario_creador);

        $concatenated = $users->concat([$usuario_creador]); // Wrap $usuario_creador in an array

    
        foreach($concatenated as $user){

            $movimientos = Movimiento::where('proyecto_id', $this->id)->where('user_id', $user->id)->where('valor', 'LIKE', '%añadido%')->get();
            $suma = 0;
            foreach ($movimientos as $movimiento) {
                // Use regular expression to extract the numeric value from the column
                preg_match('/(\d+)\$/', $movimiento->valor, $matches);
                
                if (isset($matches[1])) {
                    $suma += (int)$matches[1]; // Convert to integer and add to amounts array
                }
            }

            $new_value = [$user->name, $suma];
            array_push($info, $new_value);
        }



        return $info;
    }
    
}
