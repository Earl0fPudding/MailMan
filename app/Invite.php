<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invites';

    public function domain(){
	return $this->belongsTo('App\Domain');
    }
}
