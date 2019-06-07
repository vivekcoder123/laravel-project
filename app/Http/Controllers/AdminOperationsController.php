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

        $allErrors=Error::all();
        $failed=Error::where('type','Failed')->count();
        $system_error=Error::where('type','System Error')->count();
        $space_not_available=Error::where('type','Space not available')->count();

        $pie =  Charts::create('pie', 'highcharts')
                    ->title('Operations')
                    ->labels(['Run Successfully', 'Errors', 'Did Not Run'])
                    ->values([$successful,$errors,$didNotRun])
                    ->dimensions(1000,500)
                    ->colors(['green','orange', 'red'])
                    ->responsive(true);

        $pieE  =  Charts::create('pie', 'highcharts')
                    ->title('Errors')
                    ->labels(['Failed', 'System Error', 'Space not available'])
                    ->values([$failed,$system_error,$space_not_available])
                    ->dimensions(1000,500)
                    ->colors(['yellow','blue', 'purple'])
                    ->responsive(true);

        return view('admin.operations.index',compact('pie','pieE','allErrors','allOperations'));

    }
}
