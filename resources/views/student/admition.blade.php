@extends('layouts.app')

@section('title', 'إدارة قبول ونقل الطلاب')

@section('content')


<div class="container-fluid px-0 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">
        
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper">
            <div class="card border-0 shadow-sm rounded-3 p-0 bg-body-tertiary text-start">
               <div class="container-fluid p-0">
                    <div class="header-section mb-4 p-2 bg-dark rounded-top-3">
                        <h3 class="fw-bold text-light"><i class="bi bi-person-check-fill me-2 text-primary"></i> إدارة قبول ونقل الطلاب</h3>
                        <p class="text-light">نظام معالجة طلبات الالتحاق وتعديل المسارات الأكاديمية</p>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 m-2">
                        <div class="card-header bg-white border-0 p-4 pb-0">
                            <ul class="nav nav-tabs custom-tabs border-0" id="admissionTabs" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active fw-bold px-4 py-3" id="accept-tab" data-bs-toggle="tab" data-bs-target="#accept">
                                        <i class="bi bi-plus-circle me-1"></i> قبول الطلاب جديد
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link fw-bold px-4 py-3" id="transfer-tab" data-bs-toggle="tab" data-bs-target="#transfer">
                                        <i class="bi bi-arrow-left-right me-1"></i> نقل بين الفروع
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content" id="admissionTabsContent">
                                
                                {{-- قسم قبول طالب جديد --}}
                                <div class="tab-pane fade show active" id="accept">
                                    <table class="table project-list-table table-nowrap align-middle table-border border" >
                                        <thead>
                                            <tr class="tr" style="background-color: #aaa;">
                                                
                                                <th scope="col" style="width: 10px;border-left: 1px solid #bbb;background-color: #ddd">#</th>
                                                <th scope="col"style="border-left: 1px solid #bbb;background-color: #ddd">الاسم</th>
                                                <th scope="col"style="border-left: 1px solid #bbb;background-color: #ddd">الفرع</th>
                                                <th scope="col" style="width: 100px;background-color: #ddd" class="edit">الحالة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @forelse ($students as $student) --}}
                                                <tr class="tr mb-0">
                                                    <td style="width: 10px;border-left: 1px solid #dee2e6;">1</td>
                                                    <td style="border-left: 1px solid #dee2e6;"><a href="" class="text-body">ماجد محمد اسماعيل</a></td>
                                                    <td style="border-left: 1px solid #dee2e6;">كوستي</td>
                                                    <td class="edit">
                                                        {{-- <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                <a href="{{ route('student.edit-student', $student->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="تعديل البيانات" class="px-2 text-primary"><i class="bi bi-pencil-square font-size-18"></i></a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <a href="{{ route('student.delete', $student) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف الطالب" class="px-2 text-danger"><i class="bi bi-trash font-size-18"></i></a>
                                                            </li>
                                                            
                                                        </ul> --}}
                                                        قيد الانتظار
                                                    </td>
                                                </tr>
                                            {{-- @empty
                                                <tr class="tr mb-0">
                                                    <td colspan="3" class="text-center">لا يوجد طلاب لعرضهم.</td>
                                                </tr>
                                            @endforelse --}}
                                            
                                        </tbody>
                                    </table>
                                </div>

                                {{-- قسم نقل الطلاب --}}
                                <div class="tab-pane fade" id="transfer">
                                    <div class="alert alert-info border-0 rounded-4 bg-primary-subtle text-primary mb-4">
                                        <i class="bi bi-info-circle-fill me-2"></i> اختر الطالب ثم حدد الفرع الوجهة لإتمام عملية النقل الفوري.
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table project-list-table table-nowrap align-middle table-border border" >
                                            <thead>
                                                <tr class="tr" style="background-color: #aaa;">
                                                    
                                                    <th scope="col" style="width: 10px;border-left: 1px solid #bbb;background-color: #ddd">#</th>
                                                    <th scope="col"style="border-left: 1px solid #bbb;background-color: #ddd">الاسم</th>
                                                    <th scope="col"style="border-left: 1px solid #bbb;background-color: #ddd">من فرع</th>
                                                    <th scope="col"style="border-left: 1px solid #bbb;background-color: #ddd">الي فرع</th>
                                                    <th scope="col" style="width: 100px;background-color: #ddd" class="edit">الحالة</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @forelse ($students as $student) --}}
                                                    <tr class="tr mb-0">
                                                        <td style="width: 10px;border-left: 1px solid #dee2e6;">1</td>
                                                        <td style="border-left: 1px solid #dee2e6;"><a href="" class="text-body ">ماجد محمد اسماعيل</a></td>
                                                        <td style="border-left: 1px solid #dee2e6;">مدني</td>
                                                        <td style="border-left: 1px solid #dee2e6;">كوستي</td>
                                                        <td class="edit">
                                                            {{-- <ul class="list-inline mb-0">
                                                                <li class="list-inline-item">
                                                                    <a href="{{ route('student.edit-student', $student->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="تعديل البيانات" class="px-2 text-primary"><i class="bi bi-pencil-square font-size-18"></i></a>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <a href="{{ route('student.delete', $student) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف الطالب" class="px-2 text-danger"><i class="bi bi-trash font-size-18"></i></a>
                                                                </li>
                                                                
                                                            </ul> --}}
                                                            قيد الانتظار
                                                        </td>
                                                    </tr>
                                                {{-- @empty
                                                    <tr class="tr mb-0">
                                                        <td colspan="3" class="text-center">لا يوجد طلاب لعرضهم.</td>
                                                    </tr>
                                                @endforelse --}}
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


<style>
    /* تنسيق التبويبات المخصص */
    .custom-tabs .nav-link {
        color: #6c757d;
        border: none;
        border-bottom: 3px solid transparent;
        transition: 0.3s;
    }
    .custom-tabs .nav-link.active {
        color: #0d6efd !important;
        background: transparent !important;
        border-bottom: 3px solid #0d6efd !important;
    }
    .custom-tabs .nav-link:hover {
        background-color: #f8f9fa;
        border-radius: 8px 8px 0 0;
    }

    /* تحسين شكل المدخلات */
    .form-control, .form-select {
        border: 1px solid #e9ecef;
        padding: 0.75rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05);
    }
/* table style */

</style>
@endsection