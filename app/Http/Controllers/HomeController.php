<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicion;
use Charts;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $db = Medicion::all();

        if(Auth::User()->admin == 1) {
          return view('panel/admin');
        }

        elseif(Auth::User()->admin == 0) {
          return view('panel/home');
        }

    }
}
