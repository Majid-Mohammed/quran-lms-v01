<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function index()
    {
        $menuItems = [
            [
                'label' => 'الرئيسية',
                'icon' => 'bi bi-house',
                'route' => 'manager.dashboard',
            ],
            [
                'label' => 'الشؤون الادارية',
                'icon' => 'bi bi-receipt',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'قبول ونقل الطلاب ', 'route' => 'users.index'],
                    ['label' => ' الطلاب الجدد', 'route' => 'users.index'],
                    ['label' => 'ادارة الرسوم والسجلات المالية', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'الشؤون الفنية',
                'icon' => 'bi bi-cpu',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'تحديد مستويات الطلاب', 'route' => 'users.index'],
                    ['label' => 'ضبط الحلقات', 'route' => 'users.index'],
                    ['label' => 'متابعة اداء المعلمين', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'المدرسين',
                'icon' => 'bi bi-person-lines-fill',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'كل المدرسين', 'route' => 'users.index'],
                    ['label' => 'اضافة مدرس', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'الطلاب',
                'icon' => 'bi bi-people',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'كل الطلاب', 'route' => 'users.index'],
                    ['label' => 'اضافة طالب', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'المستخدمين',
                'icon' => 'bi bi-people',
                // Assuming you have a route for managing users
                // You can replace this with the actual route name
                // For example, if you have a UserController with an index method, it might be:
                // Route::get('/manager/users', [UserController::class, index])->name('manager.users.index');
                // For now, I'll just use 'users.index' as a placeholder
                'route' => 'users.index',
                'children' => [
                    ['label' => 'كل المستخدمين', 'route' => 'users.index'],
                    ['label' => 'اضافة مستخدم', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'التقييم والامتحانات',
                'icon' => 'bi bi-book',
                'route' => 'users.index',
                'children' => [
                    ['label' => 'كل الامتحانات', 'route' => 'users.index'],
                    ['label' => 'اضافة امتحان', 'route' => 'users.create'],
                ],
            ],
            [
                'label' => 'الإحصائيات والتقارير',
                'icon' => 'bi bi-bar-chart',
                 // Assuming you have a route for reports
                // You can replace this with the actual route name
                // For example, if you have a ReportController with an index method, it might be:
                // Route::get('/manager/reports', [ReportController::class, index])->name('manager.reports.index');
                // For now, I'll just use 'reports.index' as a placeholder
                'route' => 'reports.index',
            ]];
            return view('manager.dashboard', compact('menuItems'));
    }
            
}