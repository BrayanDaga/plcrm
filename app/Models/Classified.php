<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classified extends Model
{
    use HasFactory;
    protected $table = 'classified';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function userMembreship(): BelongsTo
    {
        return $this->belongsTo(UserMembreship::class, 'id_user_membreship');
    }

    public function userMembreshipSponsor(): BelongsTo
    {
        return $this->belongsTo(UserMembreship::class, 'id_user_sponsor');
    }

}
