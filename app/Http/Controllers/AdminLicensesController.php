<?php

namespace App\Http\Controllers;
use DB;
use Charts;
use App\License;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminLicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses=License::orderBy('id','desc')->get();
        return view('admin.licenses.index',compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.licenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'license_id'=>'required|unique:licenses',
            'start_date'=>'required',
            'end_date'=>'required',
            'number_of_licenses'=>'required|integer',
            'software_name'=>'required',
            'type_of_license'=>'required',
        ]);
        $input=$request->all();
        $user_id=Auth::User()->id;
        $input['operation_type']='sucessful'; 
        $input['user_id']=$user_id;
        License::Create($input);
        $request->session()->flash('created_license','Saved successfully');
        return redirect('admin/licenses');
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

    public function graph(){

    $used_licenses = License::where('end_date','<',now())->groupBy('end_date');
    var_dump($used_licenses);
    $valid_licenses = License::where('end_date','>=',now())->get();
    $line1 = Charts::database($valid_licenses,'line', 'highcharts')  
    ->title("Valid Licenses")
    ->dimensions(1000, 500)
    ->responsive(true);

    $line2 = Charts::database($used_licenses,'line', 'highcharts')
    ->title("Used Licenses")
    ->colors(["red"])
    ->dimensions(1000, 500)
    ->responsive(true);

    return view('admin.licenses.graphs',compact('line1','line2'));

    }
}
