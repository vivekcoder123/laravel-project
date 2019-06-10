<?php

namespace App\Http\Controllers;
use App\Operation;
use App\Error;
use Charts;
use Illuminate\Http\Request;

class AdminOperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function operations(){

        $allOperations=Operation::all();
        $successful=Operation::where('type','Run Successfully')->count();
        $errors=Operation::where('type','Errors')->count();
        $didNotRun=Operation::where('type','Did Not Run')->count();

        

        $pie =  Charts::create('pie', 'highcharts')
                    ->title('Operations')
                    ->labels(['Run Successfully', 'Errors', 'Did Not Run'])
                    ->values([$successful,$errors,$didNotRun])
                    ->dimensions(600,350)
                    ->colors(['#5cb85c','#f1c40f', '#d9534f'])
                    ->responsive(false);

        $failed=Error::where('type','Failed')->count();
        $system_error=Error::where('type','System Error')->count();
        $space_not_available=Error::where('type','Space not available')->count();       
        $total=$failed+$system_error+$space_not_available;    
        $failed=($failed/$total)*100;
        $system_error=($system_error/$total)*100;
        $space_not_available=($space_not_available/$total)*100;

        return view('admin.operations.index',compact('pie','allOperations','failed','system_error','space_not_available'));

    }

    public function errors(){

        $allErrors=Error::all();
        $failed=Error::where('type','Failed')->count();
        $system_error=Error::where('type','System Error')->count();
        $space_not_available=Error::where('type','Space not available')->count();

        $pieE  =  Charts::create('pie', 'highcharts')
                    ->title('Errors')
                    ->labels(['Failed', 'System Error', 'Space not available'])
                    ->values([$failed,$system_error,$space_not_available])
                    ->dimensions(1000,500)
                    ->colors(['#ed5565','#5bc0de', '#8e44ad'])
                    ->responsive(true);

        return view('admin.errors.index',compact('pieE','allErrors'));

    }

    public function operationDetail($type){
        if($type=="run"){
        $allOperations=Operation::where('type','Run Successfully')->get();
        }else if($type=="dnrun"){
        $allOperations=Operation::where('type','Did Not Run')->get();
        }
        $result='
                <table class="table table-bordered table-striped" id="operationTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Server Id</th>
                            <th>User</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach($allOperations as $operation){
            $result.= '
                        <tr>
                            <td>'.$operation->id.'</td>
                            <td style="white-space:nowrap;">'.$operation->type.'</td>
                            <td>'.$operation->server_id.'</td>
                            <td>'.$operation->user->name.'</td>
                            <td>'.$operation->created_at->diffForHumans().'</td>
                            <td>'.$operation->updated_at->diffForHumans().'</td>
                        </tr>
                    
            ';
        }

        $result.='</tbody>
                </table>';
        
        return $result;
    }

    public function errorDetail($type){
        if($type=="fd"){
        $allErrors=Error::where('type','Failed')->get();
        }else if($type=="se"){
        $allErrors=Error::where('type','System Error')->get();
        }else if($type=="sna"){
        $allErrors=Error::where('type','Space Not Available')->get();    
        }
        $result='
                <table class="table table-bordered table-striped" id="operationTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Description</th>
                            <th>Server Id</th>
                            <th>User</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach($allErrors as $error){
            $result.= '
                        <tr>
                            <td>'.$error->id.'</td>
                            <td style="white-space:nowrap;">'.$error->type.'</td>
                            <td>'.$error->details.'</td>
                            <td>'.$error->description.'</td>
                            <td>'.$error->server_id.'</td>
                            <td>'.$error->user->name.'</td>
                            <td>'.$error->created_at->diffForHumans().'</td>
                            <td>'.$error->updated_at->diffForHumans().'</td>
                        </tr>
                    
            ';
        }

        $result.='</tbody>
                </table>';
        
        return $result;
    }
}
