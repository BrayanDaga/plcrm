<?php


namespace App\Models;

use App\Models\Wallet;
use App\Models\Traits\Pointable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User
{
    use HasFactory, Pointable;

    protected $table = "users";
    // protected $fillable = [
    //     'id',
    //     'user',
    //     'password',
    //     'name',
    //     'last_name',
    //     'phone',
    //     'date_birth',
    //     'email',
    //     'id_referrer_sponsor',
    //     'id_country',
    //     'id_document_type',
    //     'id_account_type'
    // ];

    protected $appends = [
        'fullName',
         'LeftPoints',
         'RightPoints',
        'active',
        'Photo',
        'qualified',
    ];

    protected $casts = [
        'expiration_date' => 'datetime',
    ];

    public function  getPhotoAttribute()
    {
        return 'https://i.pravatar.cc/150?u='. $this->email;
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
    

  1


     public function scopeIsActive($query)
     {
         return $query->where('expiration_date', '>' , now())->where('request',2);
     }

    
    // public function country(): BelongsTo
    // {
    //     return $this->belongsTo(Country::class, 'id_country');
    // }

    // public function sponsor(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'id_referrer_sponsor');
    // }


    // public function paymentsClient(): HasOne
    // {
    //     return $this->hasOne(Payment::class, 'user_id');
    // }

    // public function paymentsSponsor(): HasMany
    // {
    //     return $this->hasMany(Payment::class, 'id_user_sponsor');
    // }


    // public function accountType(): BelongsTo
    // {
    //     return $this->belongsTo(AccountType::class, 'id_account_type');
    // }

    // public function documentType(): BelongsTo
    // {
    //     return $this->belongsTo(DocumentType::class, 'id_document_type');
    // }

    // public function wallets(): HasMany
    // {
    //     return $this->hasMany(Wallet::class,'user_id');
    // }


    // public function classifiedSponsor(): HasMany
    // {
    //       return $this->hasMany(Classified::class, 'id_user_sponsor','id');
    // }

    // public function classifiedClients(): HasMany
    // {
    //       return $this->hasMany(Classified::class, 'user_id','id');
    // }
    
    public function scopeMyClients($query)
    {
        return $query->where('id_referrer_sponsor', $this->id);
    }


    public function scopeQualifiedsAndActive($query)
    {
        return $query->with('accountType')->where('id_account_type','!=', 5)->get()->filter(function ($key) {
            return $key->qualified == true && $key->active == true;
        });
    }

}
