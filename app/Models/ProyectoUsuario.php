<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoUsuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'proyecto_id',
        'user_id',
        'puede_ver',
        'puede_editar_etiquetas',
        'puede_editar_cantidades',
        'puede_editar_usuarios',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
