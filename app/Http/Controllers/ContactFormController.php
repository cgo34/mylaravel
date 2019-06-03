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

class ContactFormController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $contactForm = [
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
        ];




        $data = [
            'genre' => $contactForm['genre'],
            'firstname' => $contactForm['firstname'],
            'lastname' => $contactForm['lastname'],
            'email' => $contactForm['email'],
            'phone' => $contactForm['phone'],
            'message' => $contactForm['message'],
            'address' => $contactForm['address'],
            'zipcode' => $contactForm['zipcode'],
            'city' => $contactForm['city'],
            'user_id' => $contactForm['id'],
            'programme_id' => $contactForm['programme_id'],
            'lot_id' => $contactForm['lot_id'],
        ];

        $newcontact = new ContactForm($data);
        $newcontact->save();


        $newcontact = ContactForm::create($data);

        Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new EmailContact($contactForm));

        $user = User::find(1);
        $user->setSlackChannel('contact');
        $user->notify(new ContactFormNotification($newcontact));

        return response()->json([ $request->all()]);
        return 'Email Contact was sent';


    }
}
