<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        // 
        return view('teacher.dashboard', compact('menuItems'));

    }

    public function getTeachers(Request $request)
    {
        // 
        $user = Auth::user();
        $teacher = Teacher::with('branch');

        if($user->role !== 'Admin'){
            $teacher->where('branch_id', $user->branch_id);
        }
        if($request->branch_id){
            $teacher->where('branch_id', $request->branch_id);
        }
        if($request->status){
            $teacher->where('status', $request->status);
        }   
        $teacher = $teacher->latest()->paginate(20)->withQueryString()->appends(request()->except('page'));

        if ($request->ajax()) {
            return view('teacher.teachers', compact('teacher'))->render();
        }
        return view('teacher.teachers', compact('teacher'));

    }

    public function register()
    {
        // 
        return view('teacher.add-teacher');

    }

    public function store(Request $request)
    {
        // 
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'national_id' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
        ]);
        $teacher = Teacher::create([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'birth_date' => $validatedData['birth_date'],
            'gender' => $validatedData['gender'],
            'address' => $validatedData['address'],
            'specialization' => $validatedData['specialization'],
            'branch_id' => $validatedData['branch_id'],
            'code' => $validatedData['code'],
            'national_id' => $validatedData['national_id'],
        ]);
        return redirect()->route('teacher.teachers')->with('status', 'تم إضافة المدرس بنجاح');
    }

    public function show($id)
    {
        // 
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit-teacher', compact('teacher'));

    }

    public function update(Request $request, $id)
    {
        //
        $teacher = Teacher::findOrFail($id);
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:teachers,email,'.$id,
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'specialization' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'national_id' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
        ]);
        $teacher->update([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'birth_date' => $validatedData['birth_date'],
            'gender' => $validatedData['gender'],
            'address' => $validatedData['address'],
            'specialization' => $validatedData['specialization'],
            'branch_id' => $validatedData['branch_id'],
            'code' => $validatedData['code'],
            'national_id' => $validatedData['national_id'],
        ]);
        return redirect()->route('teacher.teachers')->with('status', 'تم تحديث المدرس بنجاح');

    }

    public function profile($id)
    {
        // 
        $teacher = Teacher::findOrFail($id);
        return view('teacher.profile', compact('teacher'));

    }

    public function destroy($id)
    {
        // 
        return view('teacher.teachers');

    }

    
}
