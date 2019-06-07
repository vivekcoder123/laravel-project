<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable=['type','server_id','user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
