<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $table = 'incidencias';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'tecnico_id',
        'especialidad_id',
        'titulo',
        'descripcion',
        'direccion',
        'fecha_servicio',
        'franja_horaria',
        'urgencia',
        'estado',
        'precio_base',
        'localizador',
        'created_at'
    ];

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cliente_id', 'id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'tecnico_id', 'id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id', 'id');
    }
}