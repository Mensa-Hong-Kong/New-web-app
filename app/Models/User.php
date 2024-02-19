<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        "notification_email_id",
        "notification_mobile_id",
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
    /**
     * A model may have multiple roles.
     */
    public function roles(): BelongsToMany
    {
        $relation = $this->morphToMany(
            Role::class,
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            PermissionRegistrar::$pivotRole
        );

        if (! PermissionRegistrar::$teams) {
            return $relation;
        }

        return $relation->wherePivot(PermissionRegistrar::$teamsKey, getPermissionsTeamId())
            ->where(function ($q) {
                $teamField = config('permission.table_names.roles').'.'.PermissionRegistrar::$teamsKey;
                $q->whereNull($teamField)->orWhere($teamField, getPermissionsTeamId());
            });
    }
    public function gender() {
        return $this->belongsTo( Gender::class );
    }
    public function email() {
        return $this->belongsTo( Email::class );
    }
    public function notificationEmail() {
        return $this->hasOne( Email::class, "notification_email_id" );
    }
    public function mobile() {
        return $this->belongsTo( Mobile::class );
    }
    public function notificationMobile() {
        return $this->hasOne( Mobile::class, "notification_email_id" );
    }
    public function subscriptChannels() {
        return $this->belongsToMany( Channel::class, "user_subscription_channels" );
    }
    public function testingFee() {
        return $this->hasOne( AdmissionTestOrder::class );
    }
    public function testing() {
        return $this->hasMany( UserAdmissionTest::class );
    }
    public function subscriptions() {
        return $this->belongsToMany( Subscription::class, MemberHasSubscription::class, "subscription_id" );
    }
    public function member(){
        return $this->hasOne( Member::class );
    }
    public function registeredEvents(){
        return $this->hasMany( Member::class );
    }
    public function cart(){
        return $this->hasMany( Cart::class );
    }
    public function orders(){
        return $this->hasMany( Order::class );
    }
}
