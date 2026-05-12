<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestora extends Model
{
    protected $table = 'gestoras';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'comision',
    ];

    protected $hidden = ['password'];

    public function comunidades()
    {
        return $this->hasMany(Comunidad::class, 'gestora_id');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'gestora_id');
    }


    public function totalComisionesMes(int $mes = null, int $anyo = null): float
    {
        $mes  = $mes  ?? now()->month;
        $anyo = $anyo ?? now()->year;

        return $this->incidencias()
            ->where('estado', 'Finalizada')
            ->whereMonth('fecha_servicio', $mes)
            ->whereYear('fecha_servicio', $anyo)
            ->get()
            ->sum(function ($incidencia) {
                return $incidencia->precio_base * ($this->comision / 100);
            });
    }
}
