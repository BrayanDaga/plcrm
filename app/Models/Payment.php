<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(paymentMethod::class, 'id_payment_method');
    }
}
