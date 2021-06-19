<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classified extends Model
{
    protected $table = 'classified';
    protected $primaryKey = 'id';
    protected $fillabel = [
        'id',
        'id_user_membreship',
        'id_user_sponsor',
        'binary_sponsor',
        'position',
        'classification',
        'status',
        'authorized',
        'status_position_left',
        'status_position_right'
    ];


    public function userMembreshipJoin()
    {
        return $this->hasOne('App\Models\UserMembreship', 'id', 'id_user_membreship');
    }
}
