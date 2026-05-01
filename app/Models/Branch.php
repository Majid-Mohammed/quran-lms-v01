<?php

namespace App\Models;

use App\Models\Fee;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 
        'city', 
        'address', 
        'phone', 
        'capacity', 
        'is_active'
    ];
    // public function getRouteKeyName()
    // {
    //     return 'slug'; // الآن Laravel سيستخدم الـ slug تلقائياً في الروابط
    // }
    public function student(){
        return $this->hasMany(Student::class);
    }
    public function fee(){
        return $this->hasMany(Fee::class);
    } 
    public function users(){
        return $this->hasMany(User::class);
    }
    public function teacher(){
        return $this->hasMany(Teacher::class);
    }
    
    
}
