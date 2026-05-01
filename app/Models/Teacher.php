<?php

namespace App\Models;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'address',
        'specialization',
        'hire_date',
        'salary',
        'status',
        'branch_id',
        'code',
        'national_id',
    ];

    public function branch(){ 
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    
    public function isActive() {
        return $this->status === 'active';
    }
}
