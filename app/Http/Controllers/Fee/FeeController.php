<?php

namespace App\Http\Controllers\Fee;
use App\Models\Fee;

use App\Models\User;
use NumberFormatter;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    //
    public function index()
    {
        return view('fee.index');
    }
    public function create()
    {
        return view('fee.create');
    }
    public function store(Request $request)
    {        // Validate the request data
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'branch_id' => 'required|exists:branches,id',
            'fee_month' => 'required|integer|min:1|max:12',
            'fee_year' => 'required|integer|min:2000|max:2100',
            'amount_due' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            //'payment_status' => updateFeeStatus($validatedData['amount_paid'], $validatedData['amount_due']),
            //'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|in:Cash,Bank Transfer,Exempt',
            'bank_name' => 'nullable|in:BOK,O-Cash,Fawry,Mashreg',
            'transaction_id' => 'nullable|string|max:255',
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        //$validatedData['payment_status'] = updatePaymentStatus($validatedData['amount_paid'], $validatedData['amount_due']);
        // $student = Student::findOrFail($student_id);
        // $branch = Branch::findOrFail($branch_id);
        $user = User::findOrFail(Auth::user()->id);
    
        // check if the payment is not duplicated
        $fee = Fee::where('student_id', $validatedData['student_id'])
            ->where('branch_id', $validatedData['branch_id'])
            ->where('fee_month', $validatedData['fee_month'])
            ->where('fee_year', $validatedData['fee_year'])
            ->first();
        if ($fee) {
            return redirect()->route('fee.payment', $validatedData['student_id'])->with('error', 'تم الكشف على سند قبض رسوم موجود لنفس الشهر بالفعل');
        }
        // Create a new Fee record
        $fee = Fee::create([
            'student_id' => $validatedData['student_id'],
            'branch_id' => $validatedData['branch_id'],
            'user_id' => $user->id, // لا يمكن التحقق من هو مستلم أو موظف للرسوم
            'fee_month' => $validatedData['fee_month'],
            'fee_year' => $validatedData['fee_year'],
            'amount_due' => $validatedData['amount_due'],
            'amount_paid' => $validatedData['amount_paid'],
           // 'payment_status' => $validatedData['payment_status'],
            //'discount' => $validatedData['discount'],
            'payment_method' => $validatedData['payment_method'],
            'bank_name' => $validatedData['bank_name'],
            'transaction_id' => $validatedData['transaction_id'],
            'payment_date' => $validatedData['payment_date'],
            'notes' => $validatedData['notes'],
        ]);
        $fee->UpdatePaymentStatus();
        // $student = Student::findOrFail($validatedData['student_id']);
        $student = $fee->id;
        return redirect()->route('fee.receipt', $student)->with('success', 'تم إنشاء سند قبض رسوم جديد بنجاح');
    }
    public function show($student)
    {
        $students = Student::findOrFail($student);
        return view('fee.payment', compact('student', 'students'));
    }
    public function showreceipt($id)
    {
        $fees = Fee::findOrFail($id);
        //$students = Student::findOrFail($student);
        //$fees = Fee::where('student_id', $student)->get();
        return view('fee.receipt', compact('fees'));
    }
    // 
    public function edit($id)
    {
       // $student = Student::findOrFail($student);
       // $student= $student->id;
        $f = new NumberFormatter("ar", NumberFormatter::SPELLOUT);
        $amountText = $f->format(5000);
        // $fees = Fee::where('id', $id)->get();
        $fees = Fee::findOrFail($id);
        return view('fee.edit-payment', compact( 'fees','amountText'));
    }
    // 
    public function update(Request $request, $id)
    {
        $fee = Fee::findOrFail($id);
        $validatedData = $request->validate([ 
            'amount_paid' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|in:Cash,Bank Transfer,Exempt',
            'bank_name' => 'nullable|in:BOK,O-Cash,Fawry,Mashreg',
            'transaction_id' => 'nullable|string|max:255',
            'payment_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        if ($fee)
        {
            $fee->update([
                'amount_paid' => $validatedData['amount_paid'],
                'payment_method' => $validatedData['payment_method'],
                'bank_name' => $validatedData['bank_name'],
                'transaction_id' => $validatedData['transaction_id'],
                'payment_date' => $validatedData['payment_date'],
                'notes' => $validatedData['notes'],
            ]);
            $fee->UpdatePaymentStatus();
            return redirect()->route('student.profile', $fee->student->id)->with('success', 'تم تحديث السداد رسوم بنجاح');
        }
        else
        {
            return redirect()->route('student.profile', $fee->student->id)->with('error', 'تعذر تحديث السداد رسوم بسبب الخطأ');
        }
    }

    // public function paymentsList(Request $request)
    // {
    //     $user = Auth::user();
    //     if ($user->role === 'Admin') {
    //         //$fee = Fee::all()->unique('student_id'); 
    //         $query = Fee::with(['student', 'branch'])->latest()->get()->unique('student_id');
           
    //     } else {
    //         // $fee = Fee::all()->unique('student_id')->where('branch_id', auth()->user()->branch_id);
    //         $query = Fee::with(['student', 'branch'])->latest()->get()->unique('student_id')->where('branch_id', auth()->user()->branch_id);
    //     }

    //     // $query = Fee::with(['student', 'branch']);

    //     // تطبيق الفلاتر
    //     if ($request->branch_id) {
    //         $query->where('branch_id', $request->branch_id);
    //     }
        
    //     if ($request->payment_year) {
    //         $query->where('fee_year', $request->payment_year); // افترضنا اسم الحقل fee_year
    //         // echo $request->payment_year;
    //     }

    //     if ($request->payment_month) {
    //         $query->where('fee_month', $request->payment_month);
    //     }

    //     if ($request->status) {
    //         $query->where('payment_status', $request->status);
    //     }

    // $fee = $query;

    // // إذا كان الطلب AJAX، أعد فقط أسطر الجدول
    // if ($request->ajax()) {
    //     return view('fee.payments-list', compact('fee'))->render();
    // }
    //     return view('fee.payments-list' , compact('fee'));
    // }

public function paymentsList(Request $request)
{
    $user = Auth::user();
    $latestIds = Fee::selectRaw('MAX(id)')->groupBy('student_id');
 
    $query = Fee::with(['student', 'branch'])
        ->whereIn('id', $latestIds);

    if ($user->role !== 'Admin') {
        $query->where('branch_id', $user->branch_id);
    }
 
    if ($request->branch_id) {
        $query->where('branch_id', $request->branch_id);
    }
    
    if ($request->payment_year) {
        $query->where('fee_year', $request->payment_year);
    }

    if ($request->payment_month) {
        $query->where('fee_month', $request->payment_month);
    }

    if ($request->status) {
        $query->where('payment_status', $request->status);
    }

    // 4. الترتيب والترقيم (بدلاً من get)
    // ملاحظة: unique('student_id') تصعب الأمور مع الترقيم، يفضل استخدام groupBy إذا كنت تريد آخر سند لكل طالب
    $fee = $query->latest()->paginate(20)->withQueryString()->appends(request()->except('page')); 

    // 5. إذا كان الطلب AJAX، أعد فقط محتوى الجدول
    if ($request->ajax()) {
        // نرسل الـ view الذي يحتوي على <tbody> فقط أو الجدول كاملاً حسب إعداد الـ JS لديك
        return view('fee.payments-list', compact('fee'))->render();
    }

    return view('fee.payments-list', compact('fee'));
}

    public function finance()
    { 
        return view('fee.finance');
    }

    public function yearReport()
    { 
        return view('fee.year-report');
    }

    public function monthReport()
    { 
        return view('fee.month-report');
    }

}
