<?php

namespace App\Http\Controllers;
use App\Error;
use App\ErrorsCategory;
use App\User;
use Illuminate\Http\Request;

class AdminErrorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

    public function errors(){
        $errors=Error::all();
        $errorsCategory=ErrorsCategory::all();
        return view('admin.errors.index',compact('errors','errorsCategory'));
    }

    public function errorDetail($type){
        $errors=Error::where('type',$type)->get();
        $result=<<<DELIMETER
        <h4 class="text-center alert alert-info">$type</h4>
                <table class="table table-bordered table-striped" id="errorTable">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Server</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
DELIMETER;
        foreach($errors as $error){
        $result.=<<<DELIMETER
        <tr>
            <td>{$error->type}</td>
            <td>{$error->name}</td>
            <td>{$error->server}</td>
            <td>{$error->description}</td>
            <td>{$error->user->name}</td>
            <td>{$error->created_at->diffForHumans()}</td>
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
