<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function ajaxSearch(Request $request)
    {
        $query = $request->get('q');
        $userBranchId = auth()->user()->branch_id; // جلب رقم فرع المستخدم المسجل
        $queryBuilder = Student::query();

        // إذا لم يكن أدمن، نحدد له فرعه فقط
        if (auth()->user()->role !== 'Admin') {
            $queryBuilder->where('branch_id', $userBranchId);
        }
        // التحقق من وجود قيمة للبحث لمنع جلب بيانات عشوائية
        if (!$query) {
            return response()->json([]);
        }

        $students = $queryBuilder->where(function($q) use ($query) {
                // مجموعة شروط البحث (أو) داخل نطاق الفرع
                $q->where('full_name', 'LIKE', "%$query%")
                ->orWhere('phone', 'LIKE', "%$query%")
                ->orWhere('student_code', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%");
            })
            ->take(8)
            ->get(['id', 'full_name', 'phone', 'branch_id']); // جلب الأعمدة المحتاجة فقط لزيادة السرعة

        return response()->json($students);
    }


    // public function ajaxSearch(Request $request)
    // {
    //     $query = $request->get('q');
        
    //     // تأكد من وجود get() في النهاية
    //     $students = Student::where('full_name', 'LIKE', "%$query%")
    //                 ->orWhere('phone', 'LIKE', "%$query%")
    //                 ->orWhere('email', 'LIKE', "%$query%")
    //                 ->take(8)
    //                 ->get(); 

    //     // إرجاع مصفوفة صريحة
    //     return response()->json($students); 
    // }

 
}
