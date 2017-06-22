<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotosMantencion extends Model
{
    protected $fillable = ['id_mantencion', 'foto'];
    protected $table = 'fotos_mantencion';
	public $timestamps = false;
    public function mantencion()
	


	{
		return $this->belongsTo('App\Models\Mantencion');
	}
}
