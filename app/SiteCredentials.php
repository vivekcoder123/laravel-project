<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteCredentials extends Model
{
    protected $fillable=[
		'type',
	    'site_url',
	    'site_port',
	    'login',
	    'password',
	    'remarks',
	    'user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
