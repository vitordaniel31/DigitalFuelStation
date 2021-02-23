<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CombustivelBomba extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'combustiveis_bombas';

    protected $fillable = [
        'id_combustivel',
        'id_bomba',
        'status',
    ];
}
