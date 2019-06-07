<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    protected $fillable=['type','details','description','server_id','user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

}