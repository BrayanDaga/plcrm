<?php


namespace App\Models;


use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserMembreship extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected $appends = ['fullNameAttribute'];

    public function getfullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
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

    public function classified(): HasOne
    {
        return $this->hasOne(Classified::class, 'id_user_membreship');
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

    public function classifiedJoin()
    {
        return $this->belongsTo('App\Models\Classified');
    }
}
