<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recolecta extends Model
{
    use HasFactory;
    protected $fillable = ['cultivo_id', 'fecha_recolecta', 'cantidad', 'unidad', 'observaciones'];

    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}
