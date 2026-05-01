<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;

use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Register\RegisterController;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Login/Logout routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/add-user', [UserController::class, 'register'])->name('add-user');
Route::post('/register', [UserController::class, 'store'])->name('register');
Route::redirect('/users/login', '/login');

// in routes/web.php Search route
Route::middleware(['auth'])->group(function () {
    Route::get('/student/search', [SearchController::class, 'ajaxSearch']);
});

// test page Route
Route::get('/student/pro-test', [StudentController::class, 'getStudentStats']);

// Teacher Routes
Route::middleware(['auth', 'role:Teacher|Admin'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
});

// Register-specific routes
Route::middleware(['auth', 'role:Register|Manager|Admin'])->prefix('/register')->group(function () { 
    Route::get('/dashboard', [RegisterController::class, 'index'])->name('register.dashboard');
    
    Route::get('/student/students', [StudentController::class, 'index'])->name('student.students');
    Route::get('/student/add-student', [StudentController::class, 'add'])->name('student.add-student');
    Route::post('/student/add-student', [StudentController::class, 'store'])->name('student.add-student');
    Route::get('/student/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');
    Route::get('/student/edit-student/{id}', [StudentController::class, 'show'])->name('student.edit-student');
    Route::put('/student/edit-student/{id}', [StudentController::class, 'update'])->name('student.students');        Route::get('/student/profile/{id}', [StudentController::class, 'profile'])->name('student.profile');
    // Route::get('student/profile/{id}', [FeeController::class, 'feelist'])->name('student.profile');
    Route::get('/student/admition', [StudentController::class, 'admition'])->name('student.admition');
        
    Route::get('/fee/payment/{student}', [FeeController::class, 'show'])->name('fee.payment');
    Route::put('/fee/payment/{student}', [FeeController::class, 'store'])->name('fee.payment');
    Route::get('/fee/edit-payment/{id}', [FeeController::class, 'edit'])->name('fee.edit-payment');
    Route::put('/fee/edit-payment/{id}', [FeeController::class, 'update'])->name('fee.edit-payment');
    Route::get('/fee/payment/{student}/delete', [FeeController::class, 'destroy'])->name('fee.payment.delete');   
    Route::get('/fee/receipt/{student}', [FeeController::class, 'showreceipt'])->name('fee.receipt');
    Route::get('/fee/payments-list', [FeeController::class, 'paymentsList'])->name('fee.payments-list');
    Route::get('/fee/finance', [FeeController::class, 'finance'])->name('fee.finance');
    Route::get('/report/year', [FeeController::class, 'yearReport'])->name('report.year');
    Route::get('/report/month', [FeeController::class, 'monthReport'])->name('report.month');

    Route::get('/users/reset-password/{id}', [UserController::class, 'resetPasswordForm'])->name('users.reset-password');
    Route::post('/users/reset-password/{id}', [UserController::class, 'resetUserPassword'])->name('users.reset-password');

});

Route::middleware(['auth', 'role:Manager|Admin'])->prefix('/manager')->group(function () {
    // Manager-specific routes
    Route::get('/dashboard', [ManagerController::class, 'index'])->name('dashboard');
    
    Route::redirect('/users', 'users/users-list');

    Route::get('/users/users-list', [UserController::class, 'getUsers'])->name('users.users-list');
    Route::get('/users/add-user', [UserController::class, 'register'])->name('users.add-user');
    Route::post('/users/add-user', [UserController::class, 'store'])->name('users.add-user');
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/edit-user/{id}', [UserController::class, 'show'])->name('users.edit-user');
    Route::put('/users/edit-user/{id}', [UserController::class, 'update'])->name('users.edit-user');
    Route::get('/users/user-profile/{id}', [UserController::class, 'profile'])->name('users.user-profile');
    Route::post('/users/users-list/{id}', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('/users/reset-password/{id}', [UserController::class, 'resetPassword'])->name('users.reset-password');

    Route::get('teacher/teachers', [TeacherController::class, 'getTeachers'])->name('teacher.teachers');
    Route::get('teacher/add-teacher', [TeacherController::class, 'register'])->name('teacher.add-teacher');
    Route::post('teacher/add-teacher', [TeacherController::class, 'store'])->name('teacher.add-teacher');
    Route::get('teacher/delete/{id}', [TeacherController::class, 'destroy'])->name('teacher.delete');
    Route::get('teacher/edit-teacher/{id}', [TeacherController::class, 'show'])->name('teacher.edit-teacher');
    Route::put('teacher/edit-teacher/{id}', [TeacherController::class, 'update'])->name('teacher.edit-teacher');
    Route::get('teacher/profile/{id}', [TeacherController::class, 'profile'])->name('teacher.profile');
    
        
});


    // Admin routes with role-based access control
Route::middleware(['auth', 'role:Admin'])->prefix('/admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
    // Dummy routes for Users and Reports (replace with real controllers later)
    Route::get('/users', function() { return 'Users list'; })->name('users.index');
    Route::get('/users/create', function() { return 'Add user form'; })->name('users.create');
    Route::get('/reports', function() { return 'Reports page'; })->name('reports.index');

    Route::get('/branch/branch-dashboard/{id}', [BranchController::class, 'show'])->name('branch.dashboard');
    Route::put('/branch/update/{id}', [BranchController::class, 'update'])->name('branch.update');
    Route::get('/branch/destroy/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
        
    //Students Routes
        
        
    // Add more routes for managers, teachers as needed
    //Route::get('/branch/branch-dashboard/{id}', [BranchController::class, 'show'])->name('branch.show{id}');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
    Route::get('/admin/register/dashboard', [RegisterController::class, 'index'])->name('register.dashboard');
    Route::get('/admin/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');

        
    
});

