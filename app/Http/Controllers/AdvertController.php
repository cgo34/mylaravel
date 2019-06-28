<?php

namespace App\Http\Controllers;

use App\Advert;
use App\AdvertsType;
use App\File;
use App\Property;
use App\PropertyFeature;
use App\AdvertFeature;
use App\Feature;
use App\Image;
use App\PropertiesType;
use App\Utils\FileUtils;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdvertController extends Controller
{
    public function getAdvertTypes(Request $request)
    {
        $advert_types = AdvertsType::All();
        Log::info('advert types');
        Log::info($advert_types);
        return response()->json($advert_types);
    }

    /**
     * Display a listing of locations in JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLocations(Request $request)
    {
        $adverts = Advert::with( 'advert_type', 'user', 'property', 'property.files')
            ->where('advert_type_id', '=', 3)
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json($adverts);
    }

    /**
     * Display a listing of buyers in JSON.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBuyers(Request $request)
    {
        $adverts = Advert::with( 'advert_type', 'user')
            ->whereIn('advert_type_id', [1, 3])
            ->where('search', '=', 'true')
            ->orderBy('id', 'DESC')
            ->get();
        return response()->json($adverts);
    }

    /**
     * Display a listing of locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllLocations(Request $request)
    {
        return view('adverts.locations');
    }

    /**
     * Display a listing of buyers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllBuyers(Request $request)
    {
        return view('adverts.buyers');
    }

    /**
     * Display a single location.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLocation(Request $request, $idLocation)
    {
        $location = Advert::with(  'advert_type', 'user', 'property', 'property.files')
            ->where('id', '=', $idLocation)
            ->first();
        //dd($locations);
        return view('adverts.single', compact('location'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdvert(Request $request)
    {
        return view('adverts.advertChoice');
    }

    /**
     * Display a form to add advert seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdvertSeller(Request $request)
    {
        $propertiesType = PropertiesType::with('features')->get();
        //dd($propertiesType);
        return view('adverts.seller.add', compact('propertiesType'));
    }

    /**
     * Display a form to add advert location.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdvertLocation(Request $request)
    {
        $propertiesType = PropertiesType::with('features')->get();
        //dd($propertiesType);
        return view('adverts.location.add', compact('propertiesType'));
    }

    /**
     * Display a form to add advert buyer.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdvertBuyer(Request $request)
    {
        $propertiesType = PropertiesType::with('features')->get();
        //dd($propertiesType);
        return view('adverts.buyer.add', compact('propertiesType'));
    }

    /**
     * Store a new advert.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAdvert(Request $request)
    {
        $user = Auth::user();
        Log::info('user');
        Log::info($user);
        Log::info($user->id);

        $type = $request->input('type');
        Log::info('advert type');
        Log::info($type);

        if($type === 'Vente'){

        }

        if($type === 'Location'){
            Log::info('store Advert Location');
            Log::info($request);

            $property = Property::create([
                'name' => $request->input('property_type'),
                'description' => $request->input('description'),
                'rent_price' => $request->input('rent_price'),
                'typology' => 'T' . $request->input('room'),
                'living_space' => $request->input('living_space'),
                'address' => $request->input('address'),
                'town_zipcode' => $request->input('zipcode'),
                'property_type_id' => $request->input('property_type'),
                'advert_type_id' => $request->input('advert_type'),
                'guarantee' => $request->input('guarantee'),
                'user_id' => $user->id,
            ]);

            Log::info('property id');
            Log::info($property->id);

            /* CREATE FEATURES PROPERTY */
            $features = $request->input('property_features');
            foreach ($features as $feature) {
                $property_feature = PropertyFeature::create([
                    'property_id' => $property->id,
                    'feature_id' => $feature,
                ]);
            }

            /* CREATE IMAGES FILES PROPERTY */
            $files = $request->input('images');
            for ($i = 0; $i < count($files); $i++) {
                Log::info('file');
                Log::info($files[$i]);
                Log::info($files[$i]['name']);
                Log::info($files[$i]['type']);
                $explodedName = explode('.', $files[$i]['name']);

                $name = $explodedName[0];
                $extension = $explodedName[1];
                $extension = strtolower($extension);

                if ($i === 0) {
                    $path = 'public/ADVERT/' . $type . '/' . $user->id . '/' . $property->id . '/THUMBNAIL';
                } else {
                    $path = 'public/ADVERT/' . $type . '/' . $user->id . '/' . $property->id . '/IMAGES';
                }

                $path = str_replace('//', '/', $path);

                if (FileUtils::saveFile($path, $name, $extension, file_get_contents($files[$i]['url']), FileUtils::PICTURE_COMPRESSOR)) {
                    if ($i === 0) {
                        $path = '/ADVERT/' . $type . '/' . $user->id . '/' . $property->id . '/THUMBNAIL';
                        $category_key = 'THUMBNAIL';
                    } else {
                        $path = '/ADVERT/' . $type . '/' . $user->id . '/' . $property->id . '/IMAGES';
                        $category_key = 'IMAGES';
                    }
                    $file = File::create([
                        'name' => $name,
                        'type' => $files[$i]['type'],
                        'path' => $path . '/' . $name . '.' . $extension,
                        'extension' => $extension,
                        'property_id' => $property->id,
                        'user_id' => $user->id,
                        'category_key' => $category_key,
                    ]);
                }
            }

            /* GET ADVERT TYPE ID */
            $advert_type = AdvertsType::where('name', '=', $request->input('type'))->first();
            Log::info('advert type id');
            Log::info($advert_type);

            /* CREATE ADVERT */
            $advert = Advert::create([
                'user_id' => $user->id,
                'property_id' => $property->id,
                'advert_type_id' => $advert_type->id,
            ]);

            if($advert){
                return response()->json($advert);
            }else{
                return response()->json($request);
            }
        }

        if($type === 'Recherche'){
            Log::info('store Advert Achat');
            Log::info($request);

            /* GET ADVERT TYPE ID */
            $advert_type = AdvertsType::where('name', '=', $request->input('advert_type'))->first();
            Log::info('advert type id');
            Log::info($advert_type);

            $city = $request->input('city');

            /* CREATE ADVERT */
            $advert = Advert::create([
                'user_id' => $user->id,
                'property_id' => NULL,
                'advert_type_id' => $advert_type->id,
                'description' => $request->input('description'),
                'living_space_min' => $request->input('living_space_min'),
                'living_space_max' => $request->input('living_space_max'),
                'price_min' => $request->input('price_min'),
                'price_max' => $request->input('price_max'),
                'room' => $request->input('room'),
                'bedroom' => $request->input('bedroom'),
                'bathroom' => $request->input('bathroom'),
                'address' => '',
                'zipcode' => '',
                'city' => $city['value'],
                'property_type' => $request->input('property_type'),
                'search' => 'true',
            ]);

            /* CREATE FEATURES ADVERT */
            $features = $request->input('property_features');
            foreach ($features as $feature) {
                $advert_feature = AdvertFeature::create([
                    'advert_id' => $advert->id,
                    'feature_id' => $feature,
                ]);
            }

            if($advert){
                return response()->json($advert);
            }else{
                return response()->json($request);
            }
        }

    }

    public function addLocationSuccess()
    {
        $property = Property::where('user_id', '=', Auth::user()->id)->first();
        return view('adverts.location.success', compact('property'));
    }
}
