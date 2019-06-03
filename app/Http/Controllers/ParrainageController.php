<?php

namespace App\Http\Controllers;


use App\Mail\EmailParrainage;
use App\Notifications\NotificationParrainage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ParrainageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            $parrain = array(
                'genre' => $user->genre,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'zipcode' => $user->zipcode,
                'city' => $user->city,
            );
        }else{
            $parrain = array(
                'genre' => '',
                'firstname' => $request->parrain['firstname'],
                'lastname' => $request->parrain['lastname'],
                'email' => $request->parrain['email'],
                'phone' => $request->parrain['phone'],
                'address' => '',
                'zipcode' => '',
                'city' => '',
            );
        }

        $parrainage = [
            'filleul' => [
                'firstname' => $request->filleul['firstname'],
                'lastname' => $request->filleul['lastname'],
                'email' => $request->filleul['email'],
                'phone' => $request->filleul['phone'],
            ],
            'parrain' => $parrain
        ];

        Mail::to(['capdevillegeoffroy@gmail.com'])->send(new EmailParrainage($parrainage));
        //$parrainage = new Parrainage($data);
        //$parrainage->save();

        //$user = User::find(1);
        //$user->setSlackChannel('call');
        //$user->notify(new NotificationParrainage($data));

        return response()->json([ $request->all()]);
        return 'Email Contact was sent';
    }
}
