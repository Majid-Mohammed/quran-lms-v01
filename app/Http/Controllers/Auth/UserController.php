<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function index()
    {
        return view('users.users-list');
    }

    public function showLoginForm()
    {
        // إذا كان المستخدم مسجل دخوله بالفعل، وجهه مباشرة للوحة التحكم الخاصة به
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ], [
            'email.exists' => 'هذا البريد الإلكتروني غير مسجل لدينا.',
        ]);
        $credentials['status'] = 'Active'; // تأكد أن المستخدم نشط فقط يمكنه تسجيل الدخول   
        // محاولة تسجيل الدخول مع تفعيل خاصية "تذكرني" إذا رغبت
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            // 1. إعادة توليد الجلسة لمنع هجمات Session Fixation
            $request->session()->regenerate();
            if($credentials['password'] == '12345678'){
                return redirect()->route('users.reset-password', Auth::user()->id)->with('status', 'تم تسجيل الدخول بنجاح. يرجى تغيير كلمة المرور الافتراضية الخاصة بك.');
            }
            // 2. تخزين بيانات أساسية في الجلسة لسرعة الوصول (اختياري)
            $request->session()->put('login_time', now());
            $request->session()->put('user_role', Auth::user()->role);

            // 3. التوجيه بناءً على الدور
            return $this->redirectBasedOnRole(Auth::user());
        }

        // تسجيل محاولة فاشلة (لأغراض أمنية إذا أردت لاحقاً)
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'userId' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $code = $validatedData['userId'];
        $user = Teacher::findOrFail($code);
        if($user->userId == $code){
            $validatedData['name'] = $user->full_name;
            $validatedData['branch_id'] = $user->branch_id;
            $users = User::create([
                'userId' => $validatedData['userId'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'name' => $user->full_name, 
                'branch_id' => $user->branch_id,
            ]);
            //return redirect()->intended('login')->with('status', 'تم إنشاء الحساب بنجاح. يمكنك الآن تسجيل الدخول.');
        }else{
            //return redirect()->back()->withErrors(['userId' => 'الكود الذي أدخلته غير صحيح. يرجى التحقق والمحاولة مرة أخرى.']);
        }
    }
    
    public function show($id){
        $user = User::findOrFail($id);
        return view('users.edit-user', compact('user'));
    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'userId' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        $user->update($validatedData);
        return redirect()->intended('login')->with('status', 'تم تحديث الحساب بنجاح. يمكنك الآن تسجيل الدخول.');
    }

    public function getUsers(Request $request)
    {
        $user = Auth::user();
        $users = User::with('branch');
        // تطبيق الفلاتر
        if ($user->role !== 'Admin') {
            $users->where('branch_id', $user->branch_id);
        }
    
        if ($request->branch_id) {
            $users->where('branch_id', $request->branch_id);
        }
        
        if ($request->status) {
            $users->where('status', $request->status);
        }

        if ($request->role) {
            $users->where('role', $request->role);
        }

        $users = $users->latest()->paginate(20)->withQueryString()->appends(request()->except('page')); 
        if ($request->ajax()) {
            return view('users.users-list', compact('users'))->render();
        }
        return view('users.users-list', compact('users'));
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('users.user-profile', compact('user'));
    }
    /**
     * منطق التوجيه الموحد - يمنع التكرار ويحمي من أخطاء الـ null
     */
    protected function redirectBasedOnRole($user)
    {
        // استخدام match (متوفر في PHP 8) لجعل الكود أنظف وأسرع
        $url = match ($user->role) {
            'Admin'    => route('admin.dashboard'),
            'Manager'  => route('manager.dashboard'),
            'Register' => route('register.dashboard'),
            'Teacher'  => route('teacher.dashboard'),
            'Student'  => route('student.dashboard'),
            default    => null,
        };

        if ($url) {
            return redirect()->intended($url);
        }

        // في حال عدم وجود دور صالح، يتم تسجيل الخروج فوراً وتدمير الجلسة
        Auth::logout();
        session()->flash('error', 'حسابك لا يمتلك صلاحيات وصول صالحة.');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'تم تسجيل الخروج بنجاح.');
    }

    public function toggleStatus($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // تبديل الحالة
        $user->status = ($user->status === 'Active') ? 'Not Active' : 'Active';
        $user->save();

        return response()->json([
            'success' => true,
            'new_status' => $user->status,
            'message' => 'تم تحديث حالة المستخدم بنجاح'
        ]);
    }

    public function resetPassword($userId)
    {
        $user = User::findOrFail($userId);
            $newPassword = '12345678';
        $user->password = bcrypt($newPassword);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'تم تعيين كلمة المرور الجديد بنجاح'
        ]);
    }

    public function resetPasswordForm($userId)
    {
        $user = User::findOrFail($userId);
        return view('users.reset-password', compact('user'));
    }
    public function resetUserPassword(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $validatedData = $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed'
        ]);
        $validatedData['current_password'] = trim($validatedData['current_password']);
         if (!\Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة.']);
        }
        $user->password = bcrypt($validatedData['new_password']);
        $user->save();
        return redirect()->route('login')->with('status', 'تم تعيين كلمة المرور الجديد بنجاح');
    }

}