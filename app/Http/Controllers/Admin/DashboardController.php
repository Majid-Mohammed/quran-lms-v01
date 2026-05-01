<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // $menuItems = [
        //     [
        //         'label' => 'الرئيسية',
        //         'icon' => 'bi bi-house',
        //         'route' => 'admin/dashboard',
        //     ],
        //     [
        //         'label' => 'الشؤون الادارية',
        //         'icon' => 'bi bi-receipt',
        //         'route' => 'users.index',
        //         'children' => [
        //             ['label' => 'قبول ونقل الطلاب ', 'route' => 'users.index'],
        //             ['label' => ' الطلاب الجدد', 'route' => 'users.index'],
        //             ['label' => 'ادارة الرسوم والسجلات المالية', 'route' => 'users.create'],
        //         ],
        //     ],
        //     [
        //         'label' => 'الشؤون الفنية',
        //         'icon' => 'bi bi-cpu',
        //         'route' => 'users.index',
        //         'children' => [
        //             ['label' => 'تحديد مستويات الطلاب', 'route' => 'users.index'],
        //             ['label' => 'ضبط الحلقات', 'route' => 'users.index'],
        //             ['label' => 'متابعة اداء المعلمين', 'route' => 'users.create'],
        //         ],
        //     ],
        //     [
        //         'label' => 'المدرسين',
        //         'icon' => 'bi bi-person-lines-fill',
        //         'route' => 'users.index',
        //         'children' => [
        //             ['label' => 'كل المدرسين', 'route' => 'users.index'],
        //             ['label' => 'اضافة مدرس', 'route' => 'users.create'],
        //         ],
        //     ],
        //     [
        //         'label' => 'الطلاب',
        //         'icon' => 'bi bi-people',
        //         'route' => 'users.index',
        //         'children' => [
        //             ['label' => 'كل الطلاب', 'route' => 'users.index'],
        //             ['label' => 'اضافة طالب', 'route' => 'users.create'],
        //         ],
        //     ],
        //     [
        //         'label' => 'المستخدمين',
        //         'icon' => 'bi bi-people',
        //         'route' => 'users.index',
        //         'children' => [
        //             ['label' => 'كل المستخدمين', 'route' => 'users.index'],
        //             ['label' => 'اضافة مستخدم', 'route' => 'users.create'],
        //         ],
        //     ],
        //     [
        //         'label' => 'التقييم والامتحانات',
        //         'icon' => 'bi bi-book',
        //         'route' => 'users.index',
        //         'children' => [
        //             ['label' => 'كل الامتحانات', 'route' => 'users.index'],
        //             ['label' => 'اضافة امتحان', 'route' => 'users.create'],
        //         ],
        //     ],
        //     [
        //         'label' => 'الإحصائيات والتقارير',
        //         'icon' => 'bi bi-graph-up',
        //         'route' => 'reports.index',
        //     ],
        // ];

        // return view('admin/dashboard', compact('menuItems'));
    }
}