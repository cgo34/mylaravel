<?php

namespace App\Http\Controllers;

use App\Mail\EmailSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newSubscriber(Request $request)
    {
        $subscriber = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ];

        Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new EmailSubscriber($subscriber));

        return response()->json([ $request->all()]);
    }
}
