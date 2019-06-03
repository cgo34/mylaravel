<?php

namespace App\Http\Controllers;

use App\Dispositif;
use Doctrine\DBAL\Query\QueryBuilder;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Programme;
use App\Lot;
use Illuminate\Support\Facades\DB;

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
    public function filter(Request $request, Programme $programmes, Lot $lots, Dispositif $dispo)
    {

        //dd($request);
        $programmes = Programme::query()
            ->when($request->city, function ($query, $city) {
                return $query->where('city', 'like', $city);
            })
            ->when($request->price, function ($query, $price) {
                $priceConstraint = function ($q) use ($price) {
                    return $q->where('prix', '<=', $price);
                };
                return $query->whereHas('lots', $priceConstraint)
                    ->with(['lots' => $priceConstraint]);
            })
            ->when($request->dispositif, function ($query, $dispositif) {
                $dispositifConstraint = function ($q) use ($dispositif) {
                    return $q->where('id', "=", $dispositif);
                };
                return $query->whereHas('dispositifs', $dispositifConstraint)
                    ->with(['dispositifs' => $dispositifConstraint]);
            })->orderBy('id', 'DESC');

        if ($request->filled('dispositif')) {
            $dispositifSearch = Dispositif::findOrFail($request->dispositif);
            $dispositifSearch = $dispositifSearch->name;
        }else{
            $dispositifSearch = null;
        }


        //dd($dispositifSearch);

        return view('search.index', [
            'programmes' => $programmes->get(),
            'dispo' => $dispositifSearch,
        ]);
    }
}
