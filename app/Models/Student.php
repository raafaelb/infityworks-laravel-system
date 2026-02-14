<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'birth_date',
        'user_id',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    protected $appends = [
        'age',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getAgeAttribute(): ?int
    {
        if (!$this->birth_date) {
            return null;
        }

        return Carbon::parse($this->birth_date)->age;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['name'] ?? null, function ($q, $name) {
                $q->whereHas('user', function ($uq) use ($name) {
                    $uq->where('name', 'like', "%{$name}%");
                });
            })
            ->when($filters['email'] ?? null, function ($q, $email) {
                $q->whereHas('user', function ($uq) use ($email) {
                    $uq->where('email', 'like', "%{$email}%");
                });
            });
    }

}
