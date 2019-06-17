<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable=['service_type','server','start_time','end_time','size','status','duration','last_success_on','policy','license_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
