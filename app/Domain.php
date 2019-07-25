<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';

    public function users(){
	return $this->hasMany('App\User');
    }

    public function invites(){
	return $this->hasMany('App\Invite');
    }

    public function aliases(){
	return $this->hasMany('App\Alias');
    }
}
