<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Bomba extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'bombas';

    protected $fillable = [
        'codigo',
        'password',
    ];
}
