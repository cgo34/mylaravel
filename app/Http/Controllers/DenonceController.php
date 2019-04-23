<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewDenonce;
use App\Denonce;
use App\User;
use App\Mail\Prospect;

class DenonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        if(Auth::user()){

            $user = auth()->user();
            $denonce = [
                'pro' => [
                    'id' => $user->id,
                    'genre' => $user->genre,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'zipcode' => $user->code_postal,
                    'city' => $user->city,
                ],
                'client' => [
                    'genre' => $request->client['genre'],
                    'firstname' => $request->client['firstname'],
                    'lastname' => $request->client['lastname'],
                    'email' => $request->client['email'],
                    'phone' => $request->client['phone'],
                    'address' => $request->client['address'],
                    'zipcode' => $request->client['zipcode'],
                    'city' => $request->client['city'],
                    'programme_id' => $request->programme['id'],
                    'programme_name' => $request->programme['name'],
                    'lot_id' => $request->lot['id'],
                    'lot_number' => $request->lot['number'],
                ]
            ];

        }else{
            $user = auth()->user();
            $denonce = [
                'pro' => [
                    'id' => $user->id,
                    'genre' => $user->genre,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                    'zipcode' => $user->code_postal,
                    'city' => $user->city,
                ],
                'client' => [
                    'genre' => $request->client['genre'],
                    'firstname' => $request->client['firstname'],
                    'lastname' => $request->client['lastname'],
                    'email' => $request->client['email'],
                    'phone' => $request->client['phone'],
                    'address' => $request->client['address'],
                    'zipcode' => $request->client['zipcode'],
                    'city' => $request->client['city'],
                    'programme_id' => $request->programme['id'],
                    'programme_name' => $request->programme['name'],
                    'lot_id' => $request->lot['id'],
                    'lot_number' => $request->lot['number'],
                ]
            ];
        }


        $data = [
            'genre' => $denonce['client']['genre'],
            'firstname_pro' => $denonce['pro']['firstname'],
            'lastname_pro' => $denonce['pro']['lastname'],
            'email_pro' => $denonce['pro']['email'],
            'phone_pro' => $denonce['pro']['phone'],
            'firstname' => $denonce['client']['firstname'],
            'lastname' => $denonce['client']['lastname'],
            'email' => $denonce['client']['email'],
            'phone' => $denonce['client']['phone'],
            'address' => $denonce['client']['address'],
            'zipcode' => $denonce['client']['zipcode'],
            'city' => $denonce['client']['city'],
            'user_id' => $denonce['pro']['id'],
            'programme_id' => $denonce['client']['programme_id'],
            'lot_id' => $denonce['client']['lot_id'],
        ];



        $newdenonce = new Denonce($data);
        $newdenonce->save();

        $newdenonce = Denonce::create($data);

        Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new Prospect($denonce));

        $user = User::find(1);
        $user->setSlackChannel('denonce');
        $user->notify(new NewDenonce($newdenonce));


        // Add denonce to denonce list
        return response()->json([ $request->all()]);
        return 'Email Denonce was sent';


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
        //
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
        //
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
