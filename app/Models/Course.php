<?php

namespace App\Models;

use App\Models\Clas;
use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $guarded = [];

     protected $appends = [
       'urlImage',
    ];

    public function getUrlImageAttribute()
    {
        return asset('storage/'.$this->image);
    }
    /**
     * Get all of the modules for the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'id_courses');
    }

    /**
     * Get the category that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_categories');
    }

    /**
     * Get all of the lessons for the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Clas::class, Module::class, 'id_courses','id_modules');
    }
    /**
     * Get the user that owns the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The payments that belong to the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(Payment::class, 'courses_payments', 'course_id', 'payment_id');
    }
}
