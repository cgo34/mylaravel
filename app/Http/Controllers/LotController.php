<?php
/**
 * Created by PhpStorm.
 * User: geoffroy
 * Date: 12/12/2018
 * Time: 11:25
 */

namespace App\Http\Controllers;

use App\OptionRequests;
use App\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OptionRequests as NotificationOptionRequests;
use App\Notifications\OptionRequestsPending as NotificationOptionRequestsPending;
use App\Notifications\LotBooked;
use App\Notifications\LotUnBooked;
use App\Mail\LotBooked as EmailLotBooked;
use App\Mail\LotUnBooked as EmailLotUnBooked;
use App\Mail\EmailOptionRequests;
use App\Mail\EmailOptionRequestsPending;
use App\User;
use App\Lot;

class LotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('app', 'index');
    }

    public function app()
    {
        return view('lots.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lots = Lot::all();
        $lots = Lot::with( 'option_requests')->get();
        return response()->json($lots);
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
        //
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
        $lot = Lot::where('id', '=', $id)->get();
        return view('lots.index', compact('lot'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAdditionalLots($id, $city, $price)
    {
        //
        $programmes = Programme::query()
            ->when($city, function ($query, $city) {
                return $query->where('city', 'like', $city);
            })
            ->when($price, function ($query, $price) {
                $priceConstraint = function ($q) use ($price) {
                    return $q->where('prix', '<=', $price);
                };
                return $query->whereHas('lots', $priceConstraint)
                    ->with(['lots' => $priceConstraint]);
            })->when($id, function ($query, $id) {
                $idConstraint = function ($q) use ($id) {
                    return $q->where('id', '!=', $id);
                };
                return $query->whereHas('lots', $idConstraint)
                    ->with(['lots' => $idConstraint]);
            })->with('dispositifs')
            ->orderBy('id', 'DESC')->get();


        return response()->json($programmes);
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

    /**
     * Favorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function favoriteLot(Lot $lot)
    {
        Auth::user()->favoritesLots()->attach($lot->id);

        return back();
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function unFavoriteLot(Lot $lot)
    {
        Auth::user()->favoritesLots()->detach($lot->id);

        return back();
    }

    /**
     * Book a particular lot
     *
     * @param  Post $post
     * @return Response
     */
    public function isBooked(Lot $lot)
    {

        return $lot->booked;
    }

    public function makeOptionRequest(Lot $lot, $accompaniment)
    {

        $optionRequest = new OptionRequests();
        $optionRequest->state = 'pending';
        $optionRequest->lot_id = $lot->id;
        $optionRequest->user_id = Auth::user()->id;
        $optionRequest->accompaniment = $accompaniment;
        $optionRequest->save();

        $user = User::find(1);
        $user->notify(new NotificationOptionRequests($lot, Auth::user()->id));

        $optionRequests = array();
        $optionRequests['lot'] = $lot;
        $optionRequests['user'] = Auth::user();
        $optionRequests['accompaniment'] = $accompaniment;

        $userDemand = User::find(Auth::user()->id);
        $userDemand->notify(new NotificationOptionRequestsPending($lot, Auth::user()->id));

        Mail::to([$userDemand->email])->send(new EmailOptionRequestsPending($optionRequests));
        Mail::to(['capdevillegeoffroy@gmail.com'])->send(new EmailOptionRequests($optionRequests));

        /*$lotBooked = array();
        $lotBooked['lot'] = $lot;
        $lotBooked['user'] = Auth::user();
        Mail::to(['capdevillegeoffroy@gmail.com'])->send(new EmailLotBooked($lotBooked));*/

        return back();
    }

    public function unMakeOptionRequest(Lot $lot)
    {

        $optionRequest = OptionRequests::where([
            'lot_id' => $lot->id,
            'user_id' => Auth::user()->id,
        ])->delete();
        //$optionRequest->save();

        //$user = User::find(1);
        //$user->notify(new NotificationOptionRequests($lot, Auth::user()->id));

        /*$lotBooked = array();
        $lotBooked['lot'] = $lot;
        $lotBooked['user'] = Auth::user();
        Mail::to(['capdevillegeoffroy@gmail.com'])->send(new EmailLotBooked($lotBooked));*/

        return back();
    }

    public function bookLot(Lot $lot)
    {

        $lot = Lot::find($lot->id);
        //dd($lot);
        $lot->booked = 'true';
        $lot->booked_user_id = Auth::user()->id;
        $lot->save();
        Auth::user()->booksLots()->attach($lot->id);
        $user = User::find(1);
        $user->notify(new LotBooked($lot, Auth::user()->id));

        $lotBooked = array();
        $lotBooked['lot'] = $lot;
        $lotBooked['user'] = Auth::user();
        Mail::to(['capdevillegeoffroy@gmail.com'])->send(new EmailLotBooked($lotBooked));

        return back();
    }

    /**
     * Unbook a particular lot
     *
     * @param  Post $post
     * @return Response
     */
    public function unBookLot(Lot $lot)
    {

        $lot = Lot::find($lot->id);
        $lot->booked = 'false';
        $lot->booked_user_id = NULL;
        $lot->save();
        Auth::user()->booksLots()->detach($lot->id);
        $user = User::find(1);
        $user->notify(new LotUnBooked($lot, Auth::user()->id));

        $lotBooked = array();
        $lotBooked['lot'] = $lot;
        $lotBooked['user'] = Auth::user();
        Mail::to(['capdevillegeoffroy@gmail.com'])->send(new EmailLotUnBooked($lotBooked));

        //Auth::user()->booksLots()->detach($lot->id);

        return back();
    }
}
