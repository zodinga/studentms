<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';

    public function students()
    {
    	return $this->hasMany('App\Student');
    }
}
