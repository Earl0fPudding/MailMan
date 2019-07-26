<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alias extends Model
{
    protected $table = 'aliases';

    public function user(){
	return $this->belongsTo('App\User');
    }

    public function domain(){
	return $this->belongsTo('App\Domain', 'source_domain_id');
    }
}
