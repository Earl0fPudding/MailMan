<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
