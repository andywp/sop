<?php

namespace App\Http\Controllers;

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
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/dashboard');
    }

    public function Login(Request $request){
        $config = [
            'client_id' => env('sso_key_public'),
            'client_secret' => env('sso_key_secret'),
            'redirect' => env('sso_url'),
        ];
        return view('admin/login',['config' => $config ]);
       
    }



}
