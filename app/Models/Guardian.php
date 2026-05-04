<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'full_name', 
        'national_id', 
        'phone_number', 
        'job', 
        'relation_type', 
        'address'
    ];

    // علاقة ولي الأمر بالأبناء (واحد إلى متعدد)
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}