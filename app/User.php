<?php

namespace App;

use TCG\Voyager\Traits\HasRelationships;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;
    use VoyagerUser;
    use HasRelationships;

    protected $guarded = [];

    protected $casts = [
        'settings' => 'array',
    ];

    public $additional_attributes = ['full_name'];

    protected $slackChannels = [
        'default' => 'https://hooks.slack.com/services/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',
        'denonce' => 'https://hooks.slack.com/services/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',
        'contact' => 'https://hooks.slack.com/services/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',
        'call' => 'https://hooks.slack.com/services/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'
    ];

    protected $slack_url = null;

    /**setSlackChannel
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'civilite', 'firstname', 'lastname', 'full_name', 'email', 'phone', 'password', 'role_id', 'username', 'address', 'zipcode', 'city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatarAttribute($value)
    {
        if (is_null($value)) {
            return config('voyager.user.default_avatar', 'users/default.png');
        }

        return $value;
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setLocaleAttribute($value)
    {
        $this->attributes['settings'] = collect($this->settings)->merge(['locale' => $value]);
    }

    public function getLocaleAttribute()
    {
        return $this->settings['locale'];
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    /**
     * Get all of favorite posts for the user.
     */
    public function favorites()
    {
        return $this->belongsToMany(Programme::class, 'favorites', 'user_id', 'programme_id')->withTimeStamps();
    }

    /**
     * Get all of favorite posts for the user.
     */
    public function favoritesLots()
    {
        return $this->belongsToMany(Lot::class, 'favorite_lots', 'user_id', 'lot_id')->withTimeStamps();
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

    public function getId()
    {
        return $this->id;
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
