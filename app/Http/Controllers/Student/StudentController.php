<?php

namespace App\Http\Controllers\Student;
 
use App\Models\Fee;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * عرض قائمة الطلاب بناءً على صلاحية المستخدم
     */
    public function index()
    {
        $user = Auth::user();

        // إذا كان مدير عام يرى كل الطلاب، إذا كان موظف فرع يرى طلاب فرعه فقط
        if ($user->role === 'Admin') {
            $students = Student::with(['branch','guardian'])->latest()->paginate(50);
        } else {
            $students = Student::with(['branch','guardian'])->where('branch_id', $user->branch_id)->latest()->paginate(50);
        }
        return view('student.students', compact('students'));
    }

    // عرض نموذج تعديل بيانات الطالب
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit-student', compact('student'));
    }
    
    // عرض ملف الطالب
    public function profile($id){
        $student = Student::findOrFail($id);
        $fees = Fee::where('student_id', $student->id)->orderBy('fee_year', 'desc')->orderBy('fee_month', 'desc')->get();
        return view('student.profile', compact('student', 'fees'));
    }

    /**
     * حفظ طالب جديد في القاعدة
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'full_name'  => 'required|string|max:255',
            'email'      => 'nullable|email|unique:students,email',
            'phone'      => 'required|string',
            'birth_date' => 'required|date',
            'gender'     => 'required|in:male,female',
            'address'    => 'nullable|string',
            'student_code' => 'required|unique:students,student_code',
            //'level' => 'nullable|in:first,second,third',
            'national_id'=> 'nullable|string|max:255|unique:students,national_id',
            //'guardian_id' => 'required|exists:guardians,id',
            // إذا كان مدير عام يختار الفرع، وإلا يؤخذ فرع الموظف تلقائياً
            // 'branch_id'  => Auth::user()->role === 'Admin' ? 'required|exists:branches,id' : '',
            'branch_id'  => Auth::user()->role === 'Admin' ? 'required|exists:branches,id' : '',
            //'status'     => 'required|in:active,graduated,inactive',
            //Guadian Data
            'g_name'     => 'required|string|max:255',
            'g_phone'    => 'required|string',
            'g_address'  => 'nullable|string',
            'relation'   => 'required|in:father,uncle,grandfather,mother,brother,sister,other',
            'g_occupation' => 'nullable|string|max:255',
            'g_national_id' => 'nullable|string|max:255|unique:guardians,national_id',
        ]);

        $request->validate([
            // 'unique:table_name,column_name' يمنع التكرار ويعرض رسالة خطأ تلقائية
            'student_code' => 'required|unique:students,student_code',
            'national_id'  => 'required|unique:students,national_id',
        ], [
            // رسائل مخصصة باللغة العربية
            'student_code.unique' => 'عذراً، رقم الطالب هذا مسجل مسبقاً في النظام.',
            'national_id.unique'  => 'الرقم الوطني الذي أدخلته موجود بالفعل لسجل آخر.',
        ]);
        // تحديد الفرع تلقائياً للموظف العادي
        if (Auth::user()->role !== 'Admin') { $validated['branch_id'] = Auth::user()->branch_id; }
        
        try {
            // 2. بدء الـ Transaction
            return DB::transaction(function () use ($validated) {
                // أ- تخزين ولي الأمر
                $guardian = Guardian::create([
                    'full_name' => $validated['g_name'],
                    'phone_number' => $validated['g_phone'],
                    'address' => $validated['g_address'],
                    'relation_type' => $validated['relation'],
                    'job' => $validated['g_occupation'],
                    'national_id' => $validated['g_national_id'],
                ]);
                // ب- تخزين الطالب وربطه بـ ID ولي الأمر تلقائياً
                $student = Student::create([
                    'full_name' => $validated['full_name'],
                    'birth_date' => $validated['birth_date'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'national_id' => $validated['national_id'],
                    'address' => $validated['address'],
                    'student_code' => $validated['student_code'],
                    //'level' => $validated['level'],
                    //'status' => $validated['status'],
                    'branch_id' => $validated['branch_id'],
                    'gender' => $validated['gender'],
                    'guardian_id' => $guardian->id, // هنا تم الربط
                ]);
                return redirect()->route('fee.payment', $student->id);
            });
        } catch (\Exception $e) { 
            return back()->withErrors('حدث خطأ أثناء التسجيل: ' . $e->getMessage());
        }

    }

public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    // التحقق من الصلاحيات قبل المعالجة
    if (Auth::user()->role !== 'Admin' && Auth::user()->branch_id !== $student->branch_id) {
        abort(403);
    }

    $validated = $request->validate([
        'full_name'     => 'required|string|max:255',
        'email'         => 'nullable|email|unique:students,email,'.$id,
        'phone'         => 'required|string',
        'birth_date'    => 'required|date',
        'gender'        => 'required|in:male,female',
        'address'       => 'nullable|string',
        'national_id'   => 'nullable|string|max:255|unique:students,national_id,'.$id,
        'student_code'  => 'required|unique:students,student_code,'.$id,
        'status'        => 'required|in:active,graduated,inactive',
        'branch_id'     => Auth::user()->role === 'Admin' ? 'required|exists:branches,id' : '',
        
        // بيانات ولي الأمر
        'g_name'        => 'required|string|max:255',
        'g_phone'       => 'required|string',
        'g_address'     => 'nullable|string',
        'relation'      => 'required|in:father,uncle,grandfather,mother,brother,sister,other',
        'g_occupation'  => 'nullable|string|max:255',
        'g_national_id' => 'nullable|string|max:255|unique:guardians,national_id,'.$student->guardian_id,
    ]);

    try {
        DB::transaction(function () use ($student, $validated) {
            // 1. تحديث بيانات ولي الأمر
            $student->guardian->update([
                'full_name'     => $validated['g_name'],
                'phone_number'  => $validated['g_phone'],
                'address'       => $validated['g_address'],
                'relation_type' => $validated['relation'],
                'job'           => $validated['g_occupation'],
                'national_id'   => $validated['g_national_id'],
            ]);

            // 2. تحديث بيانات الطالب
            $student->update([
                'full_name'    => $validated['full_name'],
                'birth_date'   => $validated['birth_date'],
                'email'        => $validated['email'],
                'phone'        => $validated['phone'],
                'national_id'  => $validated['national_id'],
                'address'      => $validated['address'],
                'student_code' => $validated['student_code'],
                'status'       => $validated['status'],
                'gender'       => $validated['gender'],
                // إذا كان أدمن يستخدم القيمة المدخلة، وإلا يحافظ على فرعه الحالي
                'branch_id'    => Auth::user()->role === 'Admin' ? $validated['branch_id'] : $student->branch_id,
            ]);
        });

        return redirect()->route('student.students')->with('success', 'تم تحديث البيانات بنجاح.');

    } catch (\Exception $e) {
        return back()->withInput()->withErrors('حدث خطأ أثناء التحديث: ' . $e->getMessage());
    }
}

    public function transfer(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'new_branch_id' => 'required|exists:branches,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        
        // تسجيل عملية النقل في الملاحظات قبل التحديث
        $oldBranch = $student->branch->name;
        $student->branch_id = $request->new_branch_id;
        $student->notes .= "\n تم نقل الطالب من فرع ($oldBranch) بتاريخ " . now()->format('Y-m-d');
        $student->save();

        return back()->with('success', 'تم نقل الطالب بنجاح إلى الفرع الجديد.');
    }


     /**
     * تحديث حالة الطالب (تخرج، نقل، نشط)
     */
    public function updateStatus(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        // التحقق من أن الموظف يتبع لنفس فرع الطالب (حماية أمنية)
        if (Auth::user()->role !== 'Admin' && Auth::user()->branch_id !== $student->branch_id) { abort(403); }

        $request->validate(['status' => 'required|in:active,graduated,transferred']);

        $student->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطالب بنجاح.');
    }

    public function add()
    {
        return view('student.add-student');
    }
    public function admition()
    {
        return view('student.admition');
    }

    /**
     * حذف طالب من القاعدة
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);    
        $student->delete();
        return redirect()->route('student.students')->with('success', 'تم حذف الطالب بنجاح.');
    }




    public function getStudentStats()
    {
        

        return view('student.pro-test',);
    }
}