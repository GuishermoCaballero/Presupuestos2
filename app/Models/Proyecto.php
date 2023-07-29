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
    ];

    protected $appends = ['totales'];

    public function etiquetas()
    {
        return $this->hasMany(ProyectoEtiqueta::class);
    }

    public function getTotalesAttribute()
{
    $etiquetas = $this->etiquetas;

    // Initialize an empty collection to hold the Etiquetas and their quantities
    $etiquetasWithCantidad = collect();

    foreach ($etiquetas as $etiqueta) {
        $etiquetaData = [
            'etiqueta' =>  $etiqueta->etiqueta,
            'cantidad' => $etiqueta->cantidad->cantidad,
        ];

        // Add the Etiqueta data to the collection
        $etiquetasWithCantidad->push($etiquetaData);
    }

    return $etiquetasWithCantidad;
}
}
