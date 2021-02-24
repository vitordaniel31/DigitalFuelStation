<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venda extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'vendas';

    protected $fillable = [
        'id_combustivel_bomba',
        'litros_comprados',
        'valor',
    ];
}
