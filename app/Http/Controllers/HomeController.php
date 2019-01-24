<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programme;
use App\Lot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('app', 'index');
    }

    public function app()
    {
        $programmes = Programme::all();
        $lots = Lot::all();
        return view('welcome', compact('programmes', 'lots'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::all();
        return view('home', compact('programmes'));
        return view('home');
    }
}
