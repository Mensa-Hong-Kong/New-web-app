<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User\Gender;
use App\Models\User\Email;
use App\Models\User\Mobile;
use App\Models\User\Address;
use App\Models\Shop\Cart;
use App\Models\Shop\Order;
use App\Models\User\Award;
use App\Models\User\HasAward;
use App\Models\User\School;
use App\Models\User\HasSchool;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "username",
        "passport",
        "password",
        "nickname",
        "given_name",
        "middle_name",
        "family_name",
        "date_of_birth",
        "gender_id",
        "default_email_id",
        "default_mobile_id",
        "default_address_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function gender() {
        return $this->belongsTo( Gender::class );
    }
    public function email() {
        return $this->belongsTo( Email::class, 'default_email_id' );
    }
    public function emails() {
        return $this->hasMany( Email::class );
    }
    public function mobile() {
        return $this->belongsTo( Mobile::class, 'default_mobile_id' );
    }
    public function mobiles() {
        return $this->hasMany( Mobile::class );
    }
    public function address() {
        return $this->belongsTo( Address::class, 'default_address_id' );
    }
    public function addresses() {
        return $this->hasMany( Address::class );
    }
    public function subscriptEmailChannels() {
        return $this->morphToMany(EmailChannel::class, 'user_subscription_channels');
    }
    public function subscriptMobileChannels() {
        return $this->morphToMany(MobileChannel::class, 'user_subscription_channels');
    }
    public function member(){
        return $this->hasOne( Member::class );
    }
    public function events(){
        return $this->belongsToMany( Event::class, RegisteredEvent::class );
    }
    public function cart(){
        return $this->hasMany( Cart::class );
    }
    public function orders(){
        return $this->hasMany( Order::class );
    }
    public function awards(){
        return $this->belongsToMany( Award::class, HasAward::class );
    }
    public function schools(){
        return $this->belongsToMany( School::class, HasSchool::class );
    }
    public function canJoinTest(){
        return !($this->member && $this->tests->count() >= 2);
    }
}
