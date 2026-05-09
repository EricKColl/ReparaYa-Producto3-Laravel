<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table = 'comunidades';

    protected $fillable = [
        'gestora_id',
        'nombre',
        'direccion',
        'zona',
    ];

    // Una comunidad pertenece a una gestora
    public function gestora()
    {
        return $this->belongsTo(Gestora::class, 'gestora_id');
    }

    // Una comunidad tiene muchas incidencias
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'comunidad_id');
    }
}
