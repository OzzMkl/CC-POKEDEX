<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'name',
        'height',
        'weight',
        'order',
        'base_experience', // Agregamos este atributo
        'types',
        'abilities',
        'stats',
        'sprites'
    ];

    // Atributos que deben ser convertidos a arrays
    protected $casts = [
        'types' => 'array',
        'abilities' => 'array',
        'stats' => 'array',
        'sprites' => 'array'
    ];
}
