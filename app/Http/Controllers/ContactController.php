<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ContactNotification;
use App\Contact;
use App\Mail\EmailContact;
use App\User;

class ContactController extends Controller
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

            $contact = [
                'id' => $request->client['id'],
                'genre' => $request->client['genre'],
                'firstname' => $request->client['firstname'],
                'lastname' => $request->client['lastname'],
                'email' => $request->client['email'],
                'phone' => $request->client['phone'],
                'address' => $request->client['address'],
                'zipcode' => $request->client['zipcode'],
                'city' => $request->client['city'],
                'message' => $request->client['message'],
                'programme_id' => $programmeId,
                'programme_name' => $programmeName,
                'lot_id' => $lotId,
                'lot_number' => $lotNumero,
            ];


        $data = [
            'genre' => $contact['genre'],
            'firstname' => $contact['firstname'],
            'lastname' => $contact['lastname'],
            'email' => $contact['email'],
            'phone' => $contact['phone'],
            'message' => $contact['message'],
            'address' => $contact['address'],
            'zipcode' => $contact['zipcode'],
            'city' => $contact['city'],
            'user_id' => $contact['id'],
            'programme_id' => $contact['programme_id'],
            'lot_id' => $contact['lot_id'],
        ];


        Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new EmailContact($contact));
        $contact = new Contact($data);
        $contact->save();


        //$newcontact = Contact::create($data);



        $user = User::find(1);
        $user->setSlackChannel('call');
        $user->notify(new ContactNotification($contact));

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
