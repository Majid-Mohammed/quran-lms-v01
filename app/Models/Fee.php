<?php

namespace App\Models;

use App\Models\User;
use App\Models\Branch;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //


    protected $fillable = [
        'student_id',
        'branch_id',
        'user_id',
        'fee_month',
        'fee_year',
        'amount_due',
        'amount_paid',
        'discount',
        'payment_status',
        'payment_method',
        'bank_name',
        'transaction_id',
        'payment_date',
        'notes'
    ];

    // العلاقة بين الرسوم والطالب
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    // العلاقة بين الرسوم والفرع
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    // العلاقة بين الرسوم والمستخدم (الموظف المستلم)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // حساب المبلغ المتبقي بعد الدفع والخصم
    public function getRemainingAmountAttribute()
    {
        return $this->amount_due - ($this->amount_paid + $this->discount);
    }
    // تحديث حالة الدفع بناءً على المبلغ المدفوع والمتبقي
    public function updatePaymentStatus()
    {        
        if ($this->amount_paid >= $this->amount_due) {
            $this->payment_status = 'paid';
        } elseif ($this->amount_paid > 0 && $this->amount_paid < $this->amount_due) {
            $this->payment_status = 'partial';
        } elseif ($this->amount_paid == 0 && $this->payment_method == 'Exempt') {
            $this->payment_status = 'exempt';
        } elseif ($this->amount_paid == 0 && $this->payment_method != 'Exempt') {
            $this->payment_status = 'pending';
        }
    
        $this->save();
    }
}