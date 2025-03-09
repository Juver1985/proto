<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_registro',
        'nombre',
        'marca',
        'tipo',
        'valor_unitario',
        'cantidad',
        'disponible',
    ];
}