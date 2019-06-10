<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\SiteCredentials;
use Illuminate\Http\Request;

class AdminSiteCredentialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteCredentials=SiteCredentials::all();
        return view('admin.site-credentials.index',compact('siteCredentials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.site-credentials.create');
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
            'type'=>'required',
            'site_url'=>'required',
            'site_port'=>'required',
            'login'=>'required',
            'password'=>'required',
            'remarks'=>'required'
        ]);
        $input=$request->all();
        $user_id=Auth::User()->id;
        $input['user_id']=$user_id;
        SiteCredentials::Create($input);
        $request->session()->flash('created_credential','New site credentials created successfully');
        return redirect('admin/site-credentials');
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
        $credential=SiteCredentials::findOrFail($id);
        return view('admin.site-credentials.edit',compact('credential'));
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
        $siteCredentials=SiteCredentials::findOrFail($id);
        $input=$request->all();
        $siteCredentials->update($input);
        $request->session()->flash('updated_credential','Site credentials updated successfully');
        return redirect('admin/site-credentials');
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
}
