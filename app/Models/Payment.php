<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $guarded = [];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'id_payment_method');
    }

    public function userMembreship(): BelongsTo
    {
        return $this->belongsTo(UserMembreship::class, 'id_user_membreship');
    }

    public function scopeUnauthorized($query)
    {
        return $query->where('authorized', 0);
    }

    public function scopeAuthorized($query)
    {
        return $query->where('authorized', 1);
    }

    public function scopePaymentAuthSponsor($query)
    {
        return $query->where('id_user_sponsor', auth()->user()->id );
    }
}
