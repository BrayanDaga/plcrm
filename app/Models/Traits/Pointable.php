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
        $id = $this->id;
 
        $consulta = UserMembreship::whereRaw("FIND_IN_SET(id, GET_CHILD_NODE(${id}))")->with(['points' => function($q){
            $q->where('side',0);
       }])->get()->pluck('points')->collapse()->unique('id')->values();

       $points = $consulta->sum('points');

       return $points;
    }

    public function getRightPointsAttribute()
    {
        $id = $this->id;
 
        $consulta = UserMembreship::whereRaw("FIND_IN_SET(id, GET_CHILD_NODE(${id}))")->with(['points' => function($q){
            $q->where('side',1);
       }])->get()->pluck('points')->collapse()->unique('id')->values();

       $points = $consulta->sum('points');

       return $points; 
    }
}