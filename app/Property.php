<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Property extends Model
{
    protected $table = 'properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thumbnail',
        'name',
        'description',
        'images',
        'plan',
        'brochure',

        'rent_price',
        'sell_price',
        'square_meter_price',
        'typology',
        'floor',
        'exposure',
        'living_space',
        'ground_surface',

        'features',

        'rentability',
        'delivery',
        'actability',

        'limit',
        'active',

        'department',
        'town_code',
        'town_name',
        'town_zipcode',
        'address',
        'region_id',

        'energetic_class_id',
        'property_type_id',
        'parent',

        'user_id',
        'booked_user_id',
    ];

    public function files()
    {
        return $this->hasMany("App\File", 'property_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the region that owns the ad.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function advert()
    {
        return $this->belongsTo(Advert::class, 'property_id', 'id');
    }

    public function propertiestype(){
        return $this->belongsTo(PropertiesType::class);
    }

    public function dispositifs(){
        $pivotTable = 'property_dispositif';
        return $this->belongsToMany(Dispositif::class, $pivotTable, 'property_id', 'dispositif_id');
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function features(){
        return $this->belongsToMany(Feature::class, 'property_feature', 'property_id', 'feature_id');
    }

    public function parent(){
        return $this->hasOne(Property::class,'parent', 'id');
    }

    public function properties(){
        return $this->hasMany(Property::class,'parent', 'id');
    }

    public function optionrequests(){
        return $this->hasMany(OptionRequests::class, 'lot_id', 'id');
    }

    public function favorites(){
        //return $this->hasMany(FavoriteLot::class, 'lot_id', 'id');
        return $this->hasMany(FavoriteProperty::class, 'property_id', 'id');
    }

    public function bookLots(){
        return $this->hasOne(BookLot::class, 'lot_id', 'id');
    }

    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) FavoriteProperty::where('user_id', Auth::id())
            ->where('property_id', $this->id)
            ->first();
    }

    /**
     * Determine whether a post has been marked as booked by a user.
     *
     * @return boolean
     */
    public function myBooked()
    {
        return (bool) BookProperty::where('user_id', Auth::id())
            ->where('property_id', $this->id)
            ->first();
    }

    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function isBooked()
    {
        $property = Property::where('id', $this->id)->first();
        return $property->booked;
    }
}
