<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserMembreship extends Model
{
    use HasFactory;
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
        'referrer_sponsor',
        'id_country',
        'id_document_type',
        'id_account_type'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class,'id_country');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class,'id_account_type');
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class,'id_document_type');
    }

    public function classifiedJoin()
    {
        return $this->belongsTo('App\Models\Classified');
    }

}