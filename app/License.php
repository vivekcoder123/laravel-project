<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable=[
    	'license_id',
    	'start_date',
    	'end_date',
    	'number_of_licenses',
    	'software_name',
    	'type_of_license',
    	'user_id',
        'operation_type'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
