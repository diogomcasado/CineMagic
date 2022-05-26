<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    public function sessao()
    {
        return $this->hasMany("App\Models\Sessao");
    }

    public function genero()
    {
        return $this->belongsTo("App\Models\Genero");
    }
}
