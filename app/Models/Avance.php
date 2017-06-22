<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    protected $table = 'avance';


	 public function partida()
        {

                return $this->belongsTo('App\Models\Partida', 'partida_id', 'id');

        }



}

