<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    public function sessao()
    {
        return $this->hasMany("App\Models\Sessao");
    }

    public function lugar()
    {
        return $this->hasMany("App\Models\Lugar");
    }
}
