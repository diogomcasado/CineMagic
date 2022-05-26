<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    public function filme()
    {
        return $this->belongsTo('App\Models\Filme', 'filme_id');
    }
}
