<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'department_id',
        'country_id',
    ];

    public function departments(){
        $this->hasMany(Department::class);
    }

    public function countries(){
        $this->belongsTo(Country::class);
    }
}
