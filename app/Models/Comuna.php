<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table= 'comuna';

    public function proyecto(){

	return $this->hasMany('App\Models\Proyecto', 'id_comuna', 'id');
	}	


}
