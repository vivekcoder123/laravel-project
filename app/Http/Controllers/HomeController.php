<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Error;
use App\Operation;
use Charts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $posts=Post::orderBy('id','desc')->get();
        return view('welcome',compact('posts'));
        
    }

    public function admin(){

        $users_count=User::all()->count();
        $posts_count=Post::all()->count();

        return view('admin.index',compact('users_count','posts_count'));
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

    public function licenseHistory(){

        $licenseHistory  =  Charts::create('bar', 'highcharts')
                    ->title('License History')
                    ->labels(['2018-19', '2017-18', '2016-17','2015-16'])
                    ->values([100,150,200,400])
                    ->elementLabel('Starting And Ending Date')
                    ->yAxisTitle("# Of Licenses")
                    ->dimensions(1000,500)
                    ->responsive(true);

        return view('admin.license_history.index',compact('licenseHistory'));

    }

}