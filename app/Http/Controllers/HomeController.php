<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
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