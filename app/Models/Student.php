<?php

namespace App\Models;
use App\Models\Fee;

use App\Models\Branch;
use App\Models\Guardian;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'address',
        'branch_id',
        'status',
        'student_code',
        'national_id',
        'level',
        'guardian_id'
    ];
    // the connection between student and branch
    public function branch()
    { 
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // the connection between student and guardian
    public function guardian()
    { 
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }
    public function fee(){
        return $this->hasMany(Fee::class);
    }
    

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            // إنشاء slug من الاسم الأول ورقم عشوائي لضمان الفرادة
            $student->slug = Str::slug($student->first_name) . '-' . rand(1000, 9999);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}