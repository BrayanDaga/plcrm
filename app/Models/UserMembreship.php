<?php


namespace App\Models;

use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Traits\Pointable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserMembreship extends Authenticatable
{
    use HasFactory, Notifiable, Pointable;

    protected $table = "user_membreships";
    protected $primaryKey = 'id';
    protected $fillabel = [
        'id',
        'user',
        'password',
        'name',
        'last_name',
        'phone',
        'date_birth',
        'email',
        'id_referrer_sponsor',
        'id_country',
        'id_document_type',
        'id_account_type'
    ];

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
        
        //Si el usuario lleva mas de 30 dias creado es activo  
        // $now = Carbon::parse(now());
        // $f2 = Carbon::parse($this->created_at);
        // $resto=$f2->diffInDays($now);
        // return $resto >= 30 ? true : false;
    }
    

    public function getQualifiedAttribute() : bool
    {
        $qualified = false;
        
        $left = $this->classifiedSponsor()->where('status_position_left',1)->with('userMembreship')->get()->filter(function($key){  return $key->userMembreship->active  == true;  })->count();
        $right = $this->classifiedSponsor()->where('status_position_right',1)->with('userMembreship')->get()->filter(function($key){  return $key->userMembreship->active  == true;  })->count();

        if($left >= 0 && $right >= 0){
            $qualified = true;
        }        
        return $qualified; 
    }


     public function scopeIsActive($query)
     {
         return $query->where('expiration_date', '>' , now())->where('request',2);
     }

    
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'id_country');
    }

    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(UserMembreship::class, 'id_referrer_sponsor');
    }


    public function payments(): HasOne
    {
        return $this->hasOne(Payment::class, 'id_user_membreship');
    }


    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'id_account_type');
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'id_document_type');
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class,'id_user_membreship');
    }


    public function classifiedSponsor(): HasMany
    {
          return $this->hasMany(Classified::class, 'id_user_sponsor','id');
    }

    public function classifiedClients(): HasMany
    {
          return $this->hasMany(Classified::class, 'id_user_membreship','id');
    }
    
    public function scopeMyClients($query)
    {
        return $query->where('id_referrer_sponsor', $this->id);
    }



}
