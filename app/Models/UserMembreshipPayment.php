<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMembreshipPayment extends Model
{
    use HasFactory;

    protected $table = "user_membreship_payment";
    protected $primaryKey = 'id';
    protected $fillabel = [
        'id',
        'user_id',
        'id_payment',
        'authorizationCode',
        'errorCode',
        'idCommerce',
        'shippingCity',
        'txDateTime',
        'purchaseOperationNumber',
        'shippingAddress',
        'card_account_type',
        'answerMessage',
        'bank_description',
        'cuota',
        'paymentReferenceCode',
        'brand',
        'purchaseVerification',
        'IDTransaction',
        'errorMessage',
        'authorizationResult',
    ];
}
