<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected $appends = ['gastado', 'restante', 'chart'];

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
    
}
