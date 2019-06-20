<?php

namespace App\Http\Controllers;

use App\File;
use App\Property;
use App\PropertyFeature;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdvert(Request $request)
    {
        return view('adverts.add');
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
     * Store a new advert.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAdvertLocation(Request $request)
    {
        $userId = Auth::user()->id;

        $files = $request->file('images');
        $features = $request->input('features');

        $property = Property::create([
            'name' => $request->input('property_type'),
            'description' => $request->input('description'),
            'rent_price' => $request->input('rent_price'),
            'typology' => 'T' . $request->input('room'),
            'living_space' => $request->input('living_space'),
            'address' => $request->input('address'),
            'town_zipcode' => $request->input('zipcode'),
            'property_type_id' => $request->input('property_type'),
            'advert_type_id' => 'Location',
            'guarantee' => $request->input('guarantee'),
            'user_id' => $userId,
        ]);

        $property = Property::find($property->id);
        $propertyId = $property->id;

        foreach ($features as $feature) {
            $property_feature = PropertyFeature::create([
                'property_id' => $propertyId,
                'feature_id' => $feature,
            ]);
        }

        for ($i = 0; $i < count($files); $i++) {
            $explodedName = explode('.', $files[$i]->getClientOriginalName());

            $name = $explodedName[0];
            $extension = $explodedName[1];
            $extension = strtolower($extension);

            if ($i === 0) {
                $path = 'public/ANNONCE_LOCATION/' . $userId . '/' . $propertyId . '/THUMBNAIL';
            } else {
                $path = 'public/ANNONCE_LOCATION/' . $userId . '/' . $propertyId . '/IMAGES';
            }

            $path = str_replace('//', '/', $path);

            if (FileUtils::saveFile($path, $name, $extension, file_get_contents($files[$i]->getPathName()), FileUtils::PICTURE_COMPRESSOR)) {
                if ($i === 0) {
                    $path = '/ANNONCE_LOCATION/' . $userId . '/' . $propertyId . '/THUMBNAIL';
                    $category_key = 'THUMBNAIL';
                } else {
                    $path = '/ANNONCE_LOCATION/' . $userId . '/' . $propertyId . '/IMAGES';
                    $category_key = 'IMAGES';
                }
                $file = File::create([
                    'name' => $name,
                    'type' => $files[$i]->getMimeType(),
                    'path' => $path . '/' . $name . '.' . $extension,
                    'extension' => $extension,
                    'property_id' => $property->id,
                    'user_id' => $userId,
                    'category_key' => $category_key,
                ]);
            }
        }

        if($property && $file){
            return redirect()->route( 'addLocationSuccess');
        }else{
            return redirect()->back();
        }

    }

    public function addLocationSuccess()
    {
        $property = Property::where('user_id', '=', Auth::user()->id)->first();
        return view('adverts.location.success', compact('property'));
    }
}
