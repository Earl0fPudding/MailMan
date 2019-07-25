<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $hidden = ['password'];

    public function domain(){
	return $this->belongsTo('App\Domain');
    }

    public function aliases(){
	return $this->hasMany('App\Alias');
    }
}
