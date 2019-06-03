<?php

namespace App;

use TCG\Voyager\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array',
    ];

    protected $slackChannels = [
        'contact'   => 'https://hooks.slack.com/services/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',
        'call'      => 'https://hooks.slack.com/services/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',
        'denonces'   => 'https://hooks.slack.com/services/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',
        'default'   => 'https://hooks.slack.com/services/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',
    ];

    public $additional_attributes = ['full_name', 'locale'];

    protected $slack_url = null;

    /**setSlackChannel
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'genre',
        'firstname',
        'lastname',
        'full_name',
        'email',
        'phone',
        'password',
        'address',
        'zipcode',
        'city',
        'company',
        'holder',
        'card',
        'settings',
        'role_id',
        'locale',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roleId(){
        return $this->belongsTo(Role::class);
    }

    public function roleIdList(){
        return Role::where('active', 1)->orderBy('created_at')->get();
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function optionRequests(){
        return $this->belongsToMany(Lot::class, 'option_requests', 'user_id', 'lot_id')->withPivot('state');
    }

    /**
     * Get all of favorite posts for the user.
     */
    public function favorites()
    {
        return $this->belongsToMany(Programme::class, 'favorites', 'user_id', 'programme_id')->withTimeStamps();
    }

    /**
     * Get all of favorite lots for the user.
     */
    public function favoritesLots()
    {
        return $this->belongsToMany(Lot::class, 'favorite_lots', 'user_id', 'lot_id')->withTimeStamps();
    }

    public function favorite($lotId)
    {
        $this->favoritesLots()->attach($lotId);
        return $this;
    }

    public function unfavorite($lotId)
    {
        $this->favoritesLots()->detach($lotId);
        return $this;
    }

    public function isFavorite($lotId)
    {
        return (boolean) $this->favoritesLots()->where('lot_id', $lotId)->first(['id']);
    }

    /**
     * Get all of booking lots for the user.
     */
    public function books()
    {
        return $this->belongsToMany(Programme::class, 'books', 'user_id', 'programme_id')->withTimeStamps();
    }

    public function booksLots()
    {
        return $this->belongsToMany(Lot::class, 'book_lots', 'user_id', 'lot_id')->withTimeStamps();
    }

    public function book($lotId)
    {
        $this->booksLots()->attach($lotId);
        return $this;
    }

    public function unbook($lotId)
    {
        $this->booksLots()->detach($lotId);
        return $this;
    }

    public function isBook($lotId)
    {
        return (boolean) $this->booksLots()->where('lot_id', $lotId)->first(['id']);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function routeNotificationForSlack(){
        if($this->slack_url === null){
            return $this->slackChannels['default'];
        }

        return $this->slack_url;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setSlackChannel($name){
        if(isset($this->slackChannels[$name])){
            $this->setSlackUrl($this->slackChannels[$name]);
        }

        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setSlackUrl($url){
        $this->slack_url = $url;

        return $this;
    }



}
