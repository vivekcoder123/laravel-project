<?php

namespace App\Http\Controllers;
use App\License;
use Charts;
use App\Operation;
use Illuminate\Http\Request;

class AdminMainStatusController extends Controller
{
    public function mainStatus(){
        $total_liceses=License::all()->sum('number_of_licenses');
    	$used_licenses=round($total_liceses*0.4);
    	$unused_licenses=round($total_liceses*0.6);
    	$pie=Charts::create('pie', 'highcharts')
                    ->title('Licenses')
                    ->labels(['Used', 'Unused'])
                    ->values([$used_licenses,$unused_licenses])
                    ->dimensions(1000,500)
                    ->colors(['#5cb85c','#d9534f'])
                    ->responsive(true);
        $successful=Operation::where('status','successful')->count();
        $failed=Operation::where('status','failed')->count();
        $errors=Operation::where('status','errors')->count();
        $missed=Operation::where('status','missed')->count();
        $pieU=Charts::create('pie', 'highcharts')
                    ->title('Used Licenses')
                    ->labels(['Successful', 'Failed','Errors','Missed'])
                    ->values([$successful,$failed,$errors,$missed])
                    ->dimensions(1000,500)
                    ->colors(['green','red','orange','yellow'])
                    ->responsive(true);
        $operations=Operation::all();
    	return view('admin.main-status.index',compact('pie','pieU','operations'));
    }

    public function typeData($type){
    	$operations=Operation::where('status',$type)->get();
    	$result=<<<DELIMETER
    	<h4 class="alert alert-info text-center my-4 text-capitalize">$type Operations</h4>
    	<table class="table table-bordered table-striped" id="operationTable">
            <thead>
                <tr>
                <th>Server</th>
                <th>Service Type Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Size</th>
                <th>Status</th>
                <th>Duration</th>
                <th>Last Success On</th>
                <th>Policy</th>
                </tr>
            </thead>
            <tbody>
DELIMETER;
                foreach($operations as $operation){
            $result.=<<<DELIMETER
            		<tr>
                    <td>{$operation->server}</td>
                    <td>{$operation->service_type}</td>
                    <td>{$operation->start_time}</td>
                    <td>{$operation->end_time}</td>
                    <td>{$operation->size}</td>
                    <td class="text-capitalize">{$operation->status}</td>
                    <td>{$operation->duration}</td>
                    <td>{$operation->last_success_on}</td>
                    <td>{$operation->policy}</td>
                </tr>
DELIMETER;
                }
	        $result.=<<<DELIMETER
	        </tbody>
	        </table>
DELIMETER;
			return $result;
    }
}