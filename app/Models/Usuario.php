<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuario';

    protected $fillable = [
        'nome',
        'email',
        'status',
        'quantiaProjetos',
        'senha'
    ];

    protected $hidden = [
        'senha',
    ];

    public function getAuthPassword()
    {
        return $this->senha;
    }
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              