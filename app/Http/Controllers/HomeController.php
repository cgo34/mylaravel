<?php

namespace App\Http\Controllers;

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
        $this->middleware(['auth'])->except('app', 'contactmail');
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

    public function contactmail()
    {
        $contact = ['nom' => 'Krunal', 'email' => 'test@gmail.com', 'message' => 'test' ];
        Mail::to('capdevillegeoffroy@gmail.com')->send(new EmailContact($contact));

        return 'Email was sent';
    }
}
