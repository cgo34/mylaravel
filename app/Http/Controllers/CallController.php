<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Call;
use App\Notifications\NewCall;
use App\Mail\EmailCall;
use App\User;

class CallController extends Controller
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

            $programmeId = $request->programme['id'];
            $programmeName = $request->programme['name'];

            $lotId = $request->lot['id'];
            $lotNumero = $request->lot['number'];

            $call = [
                'id' => $request->client['id'],
                'genre' => $request->client['genre'],
                'prenom' => $request->client['firstname'],
                'nom' => $request->client['lastname'],
                'email' => $request->client['email'],
                'phone' => $request->client['phone'],
                'address' => $request->client['address'],
                'zipcode' => $request->client['zipcode'],
                'city' => $request->client['city'],
                'programmeid' => $programmeId,
                'programmename' => $programmeName,
                'lotid' => $lotId,
                'lotnumero' => $lotNumero,
            ];


        Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new EmailCall($call));

        $data = [
            'genre' => $call['genre'],
            'firstname' => $call['prenom'],
            'lastname' => $call['nom'],
            'email' => $call['email'],
            'phone' => $call['phone'],
            'address' => $call['address'],
            'zipcode' => $call['zipcode'],
            'city' => $call['city'],
            'user_id' => $call['id'],
            'programme_id' => $call['programmeid'],
            'lot_id' => $call['lotid'],
        ];

        $call = new Call($data);
        $call->save();


        //$call = Call::create($data);

        $user = User::find(1);
        $user->setSlackChannel('call');
        $user->notify(new NewCall($call));

        return response()->json([ $request->all()]);
        return 'Email Contact was sent';


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
