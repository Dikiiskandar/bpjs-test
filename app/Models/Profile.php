<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'wantedJobTitle',
        'firstName',
        'lastName',
        'email',
        'phone',
        'country',
        'city',
        'address',
        'postalCode',
        'drivingLicense',
        'nationality',
        'placeOfBirth',
        'dateOfBirth',
        'workingExperience',
        'photoUrl',
    ];

    public function employements()
    {
        return $this->hasMany(Employement::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
