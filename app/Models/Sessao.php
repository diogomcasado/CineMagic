<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    protected $table = 'sessoes';

    public function filme()
    {
        return $this->belongsTo('App\Models\Filme', 'filme_id');
    }

    public function sala()
    {
        return $this->belongsTo('App\Models\Sala', 'sala_id');
    }
}
