<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // View::composer('*') means this runs for all views. 
        // You can change '*' to 'layouts.sidebar' to be more efficient.
        View::composer('*', function ($view) {
            
            if (Auth::check() && Auth::user()->role === 'Admin') {
                $menuItems = [
                    [
                        'label' => 'الرئيسية',
                        'icon' => 'bi bi-house-fill',
                        'route' => 'admin.dashboard',
                    ],
                    [
                        'label' => 'الشؤون الادارية',
                        'icon' => 'bi bi-receipt',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => ' الطلاب الجدد', 'route' => 'users.index'],
                            ['label' => 'قبول ونقل الطلاب ', 'route' => 'student.admition'],
                            ['label' => 'ادارة الرسوم والسجلات المالية', 'route' => 'fee.finance'],
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
                        'icon' => 'bi bi-person-workspace',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'كل المدرسين', 'route' => 'teacher.teachers'],
                            ['label' => 'اضافة مدرس', 'route' => 'teacher.add-teacher'],
                        ],
                    ],
                    [
                        'label' => 'الطلاب',
                        'icon' => 'bi bi-people',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'كل الطلاب', 'route' => 'student.students'],
                            ['label' => 'اضافة طالب', 'route' => 'student.add-student'],
                        ],
                    ],
                    [
                        'label' => 'المستخدمين',
                        'icon' => 'bi bi-people',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'كل المستخدمين', 'route' => 'users.users-list'],
                            ['label' => 'اضافة مستخدم', 'route' => 'users.add-user'],
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
                        'icon' => 'bi bi-graph-up',
                        'route' => 'reports.index',
                    ],
                ];

                $view->with('menuItems', $menuItems);
                
            } elseif (Auth::check() && Auth::user()->role === 'Teacher') {
                $menuItems = [
                    [
                        'label' => 'الرئيسية',
                        'icon' => 'bi bi-house',
                        'route' => 'teacher.dashboard',
                    ],
                    [
                        'label' => 'الشؤون الفنية',
                        'icon' => 'bi bi-cpu',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'تحديد مستويات الطلاب', 'route' => 'users.index'],
                            ['label' => 'ضبط الحلقات', 'route' => 'users.index'],
                            ['label' => 'متابعة اداء المعلمين', 'route' => 'users.create'],
                        ]
                    ],[
                        'label' => 'الشؤون التعليمية',
                        'icon' => 'bi bi-journal-text',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'توزيع الطلاب على المعلمين', 'route' => 'users.index'],
                            ['label' => 'متابعة الحضور والغياب', 'route' => 'users.index'],
                            ['label' => 'تقييم الطلاب والمعلمين', 'route' => 'users.create'],
                        ]
                    ]
                ];

                $view->with('menuItems', $menuItems);
            }elseif(Auth::check() && Auth::user()->role === 'Manager'){
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
                            ['label' => ' الطلاب الجدد', 'route' => 'users.index'],
                            ['label' => 'قبول ونقل الطلاب ', 'route' => 'student.admition'],
                            ['label' => 'ادارة الرسوم والسجلات المالية', 'route' => 'fee.finance'],
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
                            ['label' => 'كل المدرسين', 'route' => 'teacher.teachers'],
                            ['label' => 'اضافة مدرس', 'route' => 'teacher.add-teacher'],
                        ],
                    ],
                    [
                        'label' => 'الطلاب',
                        'icon' => 'bi bi-people',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'كل الطلاب', 'route' => 'student.students'],
                            ['label' => 'اضافة طالب', 'route' => 'student.add-student'],
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
                            ['label' => 'كل المستخدمين', 'route' => 'users.users-list'],
                            ['label' => 'اضافة مستخدم', 'route' => 'users.add-user'],
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
                    ]
                ];
                $view->with('menuItems', $menuItems);
            }elseif (Auth::check() && Auth::user()->role === 'Register'){
                $menuItems = [
                    [
                        'label' => 'الرئيسية',
                        'icon' => 'bi bi-house',
                        'route' => 'register.dashboard',
                    ],
                    [
                        'label' => 'الشؤون الادارية',
                        'icon' => 'bi bi-receipt',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => ' الطلاب الجدد', 'route' => 'users.index'],
                            ['label' => 'قبول ونقل الطلاب ', 'route' => 'student.admition'],
                            ['label' => 'ادارة الرسوم والسجلات المالية', 'route' => 'fee.finance']
                        ]
                    ],
                    [
                        'label' => 'الطلاب',
                        'icon' => 'bi bi-people',
                        'route' => 'users.index',
                        'children' => [
                            ['label' => 'كل الطلاب', 'route' => 'student.students'],
                            ['label' => 'اضافة طالب', 'route' => 'student.add-student'],
                        ],
                    ]
                ];
                $view->with('menuItems', $menuItems);
            }else {
                // Share an empty array for non-admins to prevent "Undefined variable" errors
                $view->with('menuItems', []);
            }
        });
    }



}
