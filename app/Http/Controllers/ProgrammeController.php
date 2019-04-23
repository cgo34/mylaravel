<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Programme;
use App\Lot;
use App\Dispositif;

class ProgrammeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
    public function index(Request $request)
    {
        //
        $programmes = Programme::with('dispositifs')->get();
        $dispositifs = Dispositif::all();
        return view('programmes.index', compact('programmes', 'dispositifs'));
        //return response()->json($programmes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listProg(Request $request)
    {
        //
        $programmes = Programme::with('dispositifs')->get();
        return response()->json($programmes);
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
        $programme = Programme::find($id);
        $lots = Lot::where('programme_id', $id);
        $lots = Lot::with('programmes')->get();
        $lots = Lot::where('programme_id', '=', $id)->get();
        return view('programmes.programme', compact('programme', 'lots'));
    }

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
    public function showLot($idProgramme, $idLot)
    {
        //
        $programme = Programme::where('programme_id', $idProgramme);
        $programme = Programme::find($idProgramme);
        $lot = Lot::where([
                ['programme_id', '=', $idProgramme],
                ['id', '=', $idLot],
            ])->get();
        $lot = Lot::find($idLot);
        return view('lots.lot', compact('programme', 'lot'));
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
        $lots = Lot::where('programme_id', '=', $id)->get();
        return response()->json($lots);
        return view('programmes.index', compact('lots'));
        return view('lots.index');
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
}
