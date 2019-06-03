<?php

namespace App\Http\Controllers;

use App\Lot;
use App\Mail\EmailOptionRequestsValidated;
use App\Mail\EmailOptionRequestsRefused;
use App\Notifications\OptionRequests as NotificationOptionRequests;
use App\Notifications\OptionRequestsValidated as NotificationOptionRequestsValidated;
use App\Notifications\OptionRequestsRefused as NotificationOptionRequestsRefused;
use App\OptionRequests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController as VoyagerBaseController;

class OptionRequestsController extends VoyagerBaseController
{

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
        if($request->input('state') === 'validated'){
            $lot = Lot::find($request->input('lot_id'));
            $user = User::find($request->input('user_id'));

            $optionRequest = OptionRequests::find($id);
            $optionRequest->state = $request->input('state');
            $optionRequest->save();

            $lot->booked = 'true';
            $lot->booked_user_id = $user->id;
            $lot->save();

            $user->booksLots()->attach($lot->id);

            $user = User::find($user->id);
            $user->notify(new NotificationOptionRequestsValidated($lot, $user->id));

            $optionRequestsValidated = array();
            $optionRequestsValidated['lot'] = $lot;
            $optionRequestsValidated['user'] = $user;
            Mail::to([$user->email])->send(new EmailOptionRequestsValidated($optionRequestsValidated));
            return back();
        }else if($request->input('state') === 'refused'){
            $lot = Lot::find($request->input('lot_id'));
            $user = User::find($request->input('user_id'));

            $optionRequest = OptionRequests::find($id);
            $optionRequest->state = $request->input('state');
            $optionRequest->save();

            $user = User::find($user->id);
            $user->notify(new NotificationOptionRequestsRefused($lot, $user->id));

            $optionRequestsValidated = array();
            $optionRequestsValidated['lot'] = $lot;
            $optionRequestsValidated['user'] = $user;
            Mail::to([$user->email])->send(new EmailOptionRequestsRefused($optionRequestsValidated));
            return back();
        }
    }

}
