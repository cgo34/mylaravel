<?php

namespace App\Http\Controllers;

use App\Property;
use App\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $properties = Property::with('dispositifs', 'properties', 'services', 'features', 'favorites')
            ->where('parent', '=', 0)
            ->where('property_type_id', '=', 'Programme')
            ->orderBy('id', 'DESC')
            ->get();
        //dd($properties);
        return view('properties.index', compact('properties'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllLocation(Request $request)
    {
   /*     $locations = Advert::with( 'property', 'property.propertiestype')
            //->where('advert_type_id','=', 3)
            ->whereHas('property', function ($query) {
                $query->where('advert_id', '=', 3);
            })
            ->get();*/

        $locations = Property::with( 'favorites', 'user', 'files', 'features')
            ->where('advert_type_id', '=', 'Location')
            ->orderBy('id', 'DESC')
            ->get();

        //dd($locations);
        return view('adverts.location', compact('locations'));
    }

    public function getLocations(Request $request)
    {
        $locations = Property::with( 'favorites', 'user', 'files', 'features')
            ->where('advert_type_id', '=', 'Location')
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json($locations);
        //dd($locations);
    }

    /**
     * Display a single resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idLocation)
    {
        /*     $locations = Advert::with( 'property', 'property.propertiestype')
                 //->where('advert_type_id','=', 3)
                 ->whereHas('property', function ($query) {
                     $query->where('advert_id', '=', 3);
                 })
                 ->get();*/

        $location = Property::with( 'favorites', 'user', 'files', 'features')
            ->where('id', '=', $idLocation)
            ->first();
        //dd($locations);
        return view('adverts.single', compact('location'));
    }

    /**
     * Favorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function favoriteProperty(Property $property)
    {
        Auth::user()->favoritesProperties()->attach($property->id);

        return back();
    }

    /**
     * Unfavorite a particular post
     *
     * @param  Post $post
     * @return Response
     */
    public function unFavoriteProperty(Property $property)
    {
        Auth::user()->favoritesProperties()->detach($property->id);

        return back();
    }
}
