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

    protected $appends = ['gastado', 'restante'];

    public function etiquetas()
    {
        return $this->hasMany(ProyectoEtiqueta::class);
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
    
}
