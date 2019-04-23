<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dispositif;

class DispositifController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dispositifs = Dispositif::all();
        //return view('programmes.index', compact('programmes'));
        return response()->json($dispositifs);

    }
}
