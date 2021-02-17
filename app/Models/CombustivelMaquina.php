<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combustivel extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'combustiveis_maquinas';

    protected $fillable = [
        'id_combustivel',
        'id_maquina',
    ];
}
