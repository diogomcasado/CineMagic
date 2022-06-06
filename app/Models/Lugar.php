<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    public function sala()
    {
        return $this->belongsTo('App\Models\Sala', 'sala_id');
    }
}
