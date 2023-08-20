<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'id_factura',
        'nombre',
        'observacion',
        'cantidad',
        'cantidad_iva',
        'anadir_iva',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function usuarios()
    {
        return $this->hasMany(UsuarioGasto::class);
    }
}
