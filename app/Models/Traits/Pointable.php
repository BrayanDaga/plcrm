<?php
namespace App\Models\Traits;

use App\Models\UserMembreship;
use App\Models\UserMembreshipsPoints;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Pointable
{
     /**
     * Get all of the points for the UserMembreship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points(): HasMany
    {
        return $this->hasMany(UserMembreshipsPoints::class,'id_user_sponsor','id');
    

    }
    
    public function getLeftPointsAttribute()
    {
        return $this->points()->where('side',0)->where('status',1)->sum('points');
    }

    public function getRightPointsAttribute()
    {
        return $this->points()->where('side',1)->where('status',1)->sum('points');
    }
}