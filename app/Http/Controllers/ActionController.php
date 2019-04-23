<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 18/03/2019
 * Time: 16:18
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewDenonce;
use App\Mail\EmailContact;
use App\Mail\Prospect;
use App\Denonce;
use App\User;
use App\Programme;
use App\Lot;


class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendProspect(Request $request)
    {

        if(Auth::user()){
            $user = Auth::user();
            $idPro = $user->id;
            $prenompro = $user->firstname;
            $nompro = $user->lastname;
            $emailpro = $user->email;
            $phonepro = $user->phone;
        }else{
            $idPro = 1;
            $prenompro = 'Alexandre';
            $nompro = 'Bourrel';
            $emailpro = 'alex.bourrel@efficience-groupe.com';
            $phonepro = '0622334455';
        }

        $civilite = $request->prospect['civilite'];
        $prenom = $request->prospect['firstname'];
        $nom = $request->prospect['lastname'];
        $email = $request->prospect['email'];
        $phone = $request->prospect['phone'];
        $adresse = $request->prospect['adresse'];
        $cp = $request->prospect['cp'];
        $ville = $request->prospect['ville'];

        $programmeId = $request->programme['id'];
        $programmeName = $request->programme['name'];

        $lotId = $request->lot['id'];
        $lotNumero = $request->lot['numero'];

        $prospect = [
            'idpro' => $idPro,
            'prenompro' => $prenompro,
            'nompro' => $nompro,
            'emailpro' => $emailpro,
            'phonepro' => $phonepro,
            'civilite' => $civilite,
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'phone' => $phone,
            'adresse' => $adresse,
            'cp' => $cp,
            'ville' => $ville,
            'programmeid' => $programmeId,
            'programmename' => $programmeName,
            'lotid' => $lotId,
            'lotnumero' => $lotNumero,
        ];
        //Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new Prospect($prospect));

        $data = [
            'civilite' => $civilite,
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone' => $phone,
            'adresse' => $adresse,
            'code_postal' => $cp,
            'ville' => $ville,
            'user_id' => $idPro,
            'programme_id' => $programmeId,
            'lot_id' => $lotId,
        ];

        $denonce = new Denonce($data);
        $denonce->save();

        echo '<br>';
        echo $prenom;
        echo '<br>';
        echo $nom;
        echo '<br>';
        echo '<br>';


        $denonces = Denonce::create([
            'civilite' => $civilite,
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone' => $phone,
            'adresse' => $adresse,
            'code_postal' => $cp,
            'ville' => $ville,
            'user_id' => $idPro,
            'programme_id' => $programmeId,
            'lot_id' => $lotId,
        ]);

        $user = User::find(1);
        $user->notify(new NewDenonce($denonces));

        // Add denonce to denonce list
        return response()->json([ $request->all()]);
        return 'Email Denonce was sent';
    }

    public function sendContact(Request $request)
    {
        $civilite = $request->client['civilite'];
        $prenom = $request->client['firstname'];
        $nom = $request->client['lastname'];
        $email = $request->client['email'];
        $phone = $request->client['phone'];
        $message = $request->client['message'];

        $programmeId = $request->programme['id'];
        $programmeName = $request->programme['nom'];

        $lotId = $request->lot['id'];
        $lotNumero = $request->lot['numero'];

        $contact = [
            'civilite' => $civilite,
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
            'programmeid' => $programmeId,
            'programmename' => $programmeName,
            'lotid' => $lotId,
            'lotnumero' => $lotNumero,
        ];
        Mail::to(['capdevillegeoffroy@gmail.com', 'lucien.r@efficience-groupe.com'])->send(new EmailContact($contact));

        $data = [
            'civilite' => $civilite,
            'prenom' => $prenom,
            'nom' => $nom,
            'email' => $email,
            'telephone' => $phone,
        ];

        $contact = new EmailContact($data);
        $contact->save();


        // Add denonce to denonce list
        return response()->json([ $request->all()]);
        return 'Email Denonce was sent';
    }
}