<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
