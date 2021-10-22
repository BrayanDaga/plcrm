<?php

namespace App\Models;

use App\Models\Traits\Pointable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Pointable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'expiration_date' => 'datetime',

    ];

    protected $appends = [
        'fullName',
        'LeftPoints',
        'RightPoints',
        'active',
        'Photo',
        'qualified',
    ];

    public function  getPhotoAttribute()
    {
        return 'https://i.pravatar.cc/150?u=' . $this->email;
    }

    public function getfullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function getActiveAttribute()
    {
        //Si la fecha de expiracion es mayor a la fecha actual
        $expiro = $this->expiration_date > now() ? true : false;
        $aceptado = $this->request == 2 ? true : false;

        return ($expiro && $aceptado) ? true : false;
    }


    public function getQualifiedAttribute(): bool
    {
        $qualified = false;

        $left = $this->classifiedSponsor()->where('status_position_left', 1)->with('user')->get()->filter(function ($key) {
            return $key->user->active  == true;
        })->count();
        $right = $this->classifiedSponsor()->where('status_position_right', 1)->with('user')->get()->filter(function ($key) {
            return $key->user->active  == true;
        })->count();

        if ($left > 0 && $right > 0) {
            $qualified = true;
        }
        return $qualified;
    }


    public function scopeIsActive($query)
    {
        return $query->where('expiration_date', '>', now())->where('request', 2);
    }


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'id_country');
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_referrer_sponsor');
    }


    public function paymentsClient(): HasOne
    {
        return $this->hasOne(Payment::class, 'user_id');
    }

    public function paymentsSponsor(): HasMany
    {
        return $this->hasMany(Payment::class, 'id_user_sponsor');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'id_account_type');
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'id_document_type');
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class, 'user_id');
    }


    public function classifiedSponsor(): HasMany
    {
        return $this->hasMany(Classified::class, 'id_user_sponsor', 'id');
    }

    public function classifiedClients(): HasMany
    {
        return $this->hasMany(Classified::class, 'user_id', 'id');
    }

    public function scopeMyClients($query)
    {
        return $query->where('id_referrer_sponsor', $this->id);
    }


    public function scopeQualifiedsAndActive($query)
    {
        return $query->with('accountType')->where('id_account_type', '!=', 5)->get()->filter(function ($key) {
            return $key->qualified == true && $key->active == true;
        });
    }
}
