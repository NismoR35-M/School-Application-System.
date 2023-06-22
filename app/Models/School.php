<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;  //for generating fake data 

    protected $table = 'schools';

    protected $fillable = [ //attributes can be assigned
        'name',
        'county',
        'category',
        'gender',
        'capacity',
        'boarding_status',
        'is_active',
    ];

    //users belong to school
    public function users()
    {
        return $this->belongsToMany(User::class, 'student_school', 'school_id', 'user_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }
}
