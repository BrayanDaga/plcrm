<?php
namespace App\Models\Traits;

use App\Models\Point;
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
        return $this->hasMany(Point::class);
    }
    
    public function getLeftPointsAttribute()
    {
        return $this->points()->where('leg','left')->sum('user_points') ;
    }

    public function getRightPointsAttribute()
    {
        return $this->points()->where('leg','right')->sum('user_points') ;
    }
}