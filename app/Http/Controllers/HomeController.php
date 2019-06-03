<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Programme;
use App\Lot;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailContact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except('index', 'app');
    }

    public function app()
    {
        $programmes = Programme::count();
        $lots = Lot::count();
        return view('home', compact('programmes', 'lots'));
        return view('welcome', compact('programmes', 'lots'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::count();
        $lots = Lot::count();
        $posts = Post::orderBy('created_at', 'asc')->take(3)->get();
        return view('home', compact('programmes', 'lots', 'posts'));
    }
}
