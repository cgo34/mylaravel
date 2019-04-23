<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Programme;
use App\Dispositif;

class SearchController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('search.index');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request,  Programme $programme)
    {
        //

        $search = $request->get('city');
        $search = $request->input('city');

        $programmes = $programme->newQuery();

        // Search for a user based on their name.
        if ($request->has('city')) {

            echo 'city request exist';
            echo $request->input('city');
            //$programmes->where('ville', $request->input('city'))->get();
            $programmes->where('ville', $request->input('city'));
        }else{
            echo 'city request not exist';

        }

        // Search for a user based on their company.
        /*if ($request->has('dispositifs')) {
            //$programme->with('dispositif', $request->input('dispositifs'));
            $programme->whereHas('dispositifs', function ($query, $request) {
                $query->where('dispositif', '=', $request->input('dispositifs'));
            })->get();
        }

        // Search for a user based on their city.
        if ($request->has('price')) {
            //$programme->where('price', $request->input('price'));
            $programme->whereHas('lot', function ($query, $request) {
                $query->where('price', '>', $request->input('price'));
            })->get();
        }*/

        // Continue for all of the filters.
        //$dispositifs = Dispositif::all();
        //dd($dispositifs);
        //$programmes = $programmes->where('ville', $request->input('city'));
        //return response()->json($programmes);
        // Get the results and return them.
        return view('search.index', compact('programmes'));

        $prog = Programme::all()->where('ville', $request->input('city'));

        return response()->json($prog);
        return $programmes->tojson();

    }
}
