<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassroomCartDetail extends Model
{
    use HasFactory;
    protected $table = 'classroom_cart_detail';
    protected $fillable = ['classroom_cart_id','courses_id'];
    protected $guarded = ['id'];

    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class)->select(array('courses.id','courses.title','courses.price','courses.image'));
    }
    public function scopeSltData($query){
        return $query->select('classroom_cart_detail.id','classroom_cart_detail.classroom_cart_id','classroom_cart_detail.courses_id');
    }
}
