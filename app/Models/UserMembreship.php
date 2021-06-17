<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserMembreship extends Model
{
    use HasFactory;
    protected $table = "user_membreships";

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }

    public function accountType(): HasOne
    {
        return $this->hasOne(AccountType::class);
    }

    public function documentType(): HasOne
    {
        return $this->hasOne(DocumentType::class);
    }

}