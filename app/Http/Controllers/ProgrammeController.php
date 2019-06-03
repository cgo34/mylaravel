<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Programme;
use App\Lot;
use App\Dispositif;
use App\OptionRequests;

class ProgrammeController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{


    public function app()
    {
        //$programmes = Programme::all();
        //return view('programmes.index', compact('programmes'));
        return view('programmes.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProg(Request $request)
    {
        //
        $programmes = Programme::with('dispositifs', 'lots.optionRequests')->orderBy('id', 'DESC')->get();
        $myOptionRequests = Auth::user()->optionRequests;
        $dispositifs = Dispositif::all();
        return view('programmes.index', compact('programmes', 'dispositifs', 'myOptionRequests'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        //
        $programme = Programme::find($id);
        $lots = Lot::where('programme_id', $id);
        $lots = Lot::with('programmes')->get();
        $lots = Lot::where('programme_id', '=', $id)->get();
        return view('programmes.programme', compact('programme', 'lots'));
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProgrammes()
    {
        //
        $programmes = Programme::with('dispositifs')->get();
        return response()->json($programmes);
        return view('programmes.index', compact('lots'));
        return view('lots.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLot(Response $response, $idProgramme, $idLot)
    {
        //
        $programme = Programme::find($idProgramme);
        $programme = Programme::with('dispositifs')->where('id', $idProgramme)->first();
        $lot = Lot::find($idLot);
        $user = Auth::user();
        return view('lots.lot', compact('programme', 'lot', 'user'));
    }

    public function getLotMinPrice($idProgramme)
    {
        $lots = Lot::where('programme_id', '=', $idProgramme)->get();
        $lots->min('prix');
        return response()->json($lots);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLots($id)
    {
        //
        $lots = Lot::where('programme_id', $id);
        $lots = Lot::with('programmes')->get();
        $lots = Lot::with('bookLot')->where('programme_id', '=', $id)->get();
        return response()->json($lots);
        return view('programmes.index', compact('lots'));
        return view('lots.index');
    }


    /**
     * Favorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function favoriteProgramme(Programme $programme)
    {
        Auth::user()->favorites()->attach($programme->id);

        return back();
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function unFavoriteProgramme(Programme $programme)
    {
        Auth::user()->favorites()->detach($programme->id);

        return back();
    }

    /**
     * Favorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function bookProgramme(Programme $programme)
    {
        Auth::user()->books()->attach($programme->id);

        return back();
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function unBookProgramme(Programme $programme)
    {
        Auth::user()->books()->detach($programme->id);

        return back();
    }
}
