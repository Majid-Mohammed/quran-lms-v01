@extends('layouts.app')

@section('title', 'الطلاب')

@section('content')

<div class="container-fluid px-4 text-start" dir="rtl">
        <div class="row flex-column flex-lg-row">
            @include('partials.calender')
            <div class="col-12 col-lg-8 main-content-wrapper">
                <div class="d-flex sticky-top justify-content-start mb-3 d-print-none" style="top: 75px; z-index: 1020;">
                    <div id="viewModeButtons">
                        <button type="button" onclick="window.print()" class="btn btn-primary shadow-sm">
                            <i class="bi bi-printer-fill me-2"></i> طباعة
                        </button>
                    </div>
                    <div id="viewModeButtons" class="ms-2">
                        <button type="button" onclick="window.location.href='{{ route('student.add-student') }}'" class="btn btn-primary shadow-sm ">
                            <i class="bi bi-plus-circle me-2"></i> اضافة طالب
                        </button>
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-3 p-0 bg-body-tertiary text-start report-card print-container">
                    
                    <div class="report-header p-3 text-white rounded-top-3 bg-dark d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-0">قائمة الطلاب </h4>
                            <small class="opacity-75">إدارة حلقات التحفيظ</small>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-0 fw-bold view-field"> التاريخ</h5>
                            <small class="opacity-75">{{ date('Y/m/d') }}</small>
                        </div>
                    </div>
                    <div class="table-responsive m-3">
                        <table class="table project-list-table table-nowrap align-middle table-borderless">
                            <thead >
                                <tr class="tr" style="background-color: #aaa;"> 
                                    <th scope="col" style="width: 10px;border-left: 1px solid #ccc; background-color: #ddd">No</th>
                                    <th scope="col"style="border-left: 1px solid #ccc; background-color: #ddd">الاسم</th>
                                    <th scope="col"style="border-left: 1px solid #ccc; background-color: #ddd">الفرع</th>
                                    <th scope="col" style="width: 100px;background-color: #ddd" class="edit">الاجراء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                    <tr class="tr mb-0 p-0 student-row-link" style="">
                                        <td style="width: 10px;border-left: 1px solid #dee2e6;">{{ $loop->iteration }}</td>
                                        <td style="border-left: 1px solid #dee2e6; cursor: pointer; " class="student-row-link" onclick="window.location.href='{{ route('student.profile', $student->id) }}'">
                                            {{ $student->full_name }}</td>
                                        <td style="border-left: 1px solid #dee2e6;">{{ $student->branch->name }}</td>
                                        <td class="edit">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ route('fee.payment', $student->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="سداد الرسوم" class="px-2 text-primary"><i class="bi bi-bank font-size-18"></i></a>
                                                    <a href="{{ route('student.edit-student', $student->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="تعديل البيانات" class="px-2 text-primary"><i class="bi bi-pencil-square font-size-18"></i></a>
                                                
                                                    @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Manager')
                                                        <a href="{{ route('student.delete', $student) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف الطالب" class="px-2 text-danger"><i class="bi bi-trash font-size-18"></i></a>
                                               
                                                    @endif
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="tr mb-0">
                                        <td colspan="3" class="text-center">لا يوجد طلاب لعرضهم.</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                        <div class="d-none d-print-flex justify-content-between p-4 border-top mt-auto">
                            <span class="small text-muted">توقيع المسؤول: ....................</span>
                            <span class="small text-muted">ختم الفرع .................:</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>



<style>
    .student-row-link:hover {
        background-color: #f8f9fa;
    }
    .project-list-table {
        border-collapse:collapse;
        border-spacing: 0 12px;

    }

    .project-list-table tr {
        background-color: #fff;
    }
    .project-list-table thead tr {
        background-color: #ddd;
    }

    .table-nowrap td, .table-nowrap th {
        white-space: nowrap;
    }
    .table-borderless>:not(caption)>*>* {
        border-bottom-width: 0;
    }
    .table>:not(caption)>*>* {
        padding: 0.75rem 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .avatar-sm {
        height: 2rem;
        width: 2rem;
    }
    .rounded-circle {
        border-radius: 50%!important;
    }
    .me-2 {
        margin-right: 0.5rem!important;
    }
    img, svg {
        vertical-align: middle;
    }

    a {
        color: #3b76e1;
        text-decoration: none;
    }

    .badge-soft-danger {
        color: #f56e6e !important;
        background-color: rgba(245,110,110,.1);
    }
    .badge-soft-success {
        color: #63ad6f !important;
        background-color: rgba(99,173,111,.1);
    }

    .badge-soft-primary {
        color: #3b76e1 !important;
        background-color: rgba(59,118,225,.1);
    }

    .badge-soft-info {
        color: #57c9eb !important;
        background-color: rgba(87,201,235,.1);
    }

    .avatar-title {
        align-items: center;
        background-color: #3b76e1;
        color: #fff;
        display: flex;
        font-weight: 500;
        height: 100%;
        justify-content: center;
        width: 100%;
    }
    .bg-soft-primary {
        background-color: rgba(59,118,225,.25)!important;
    }
    .tr{
        border-radius: 10px;
        border: 1px solid #e3e3e3;
        margin: 0;
        padding: 0;
        background-color: #ddd;
    }
    .tr td {
        border: 1px solid #e3e3e3;
        background-color: #fff;
        padding: 0.05rem 0.50rem;
    }

       /* تحسينات العرض على الشاشة */
    .report-card {
        transition: transform 0.3s ease;
        
    }

    .min-vh-25 { min-height: 150px; }

    .details-section {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .text-ltr { direction: ltr; }
    .edit { width: auto; }

    /* إعدادات الطباعة */
    @media print {
        /* إخفاء كل العناصر غير الضرورية */
        body * { visibility: hidden; }
        .print-container, .print-container * { visibility: visible; }
        
        .print-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            margin: 0 !important;
            padding: 10px
        }
        .edit {
            display: none !important;
        }
        /* ضبط مقاس الصفحة A4 */
        @page {
            size: A4;
            margin: 5px;
        }

        /* إزالة الظلال والخلفيات الملونة غير المناسبة للطباعة */
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .report-header { 
            background-color: #000 !important; 
            color: #fff !important; 
            -webkit-print-color-adjust: exact; 
        }
        .details-section { 
            background-color: #fff !important; 
            border: 1px solid #eee !important;
            -webkit-print-color-adjust: exact;
        }
        .badge { border: 1px solid #ccc !important; color: #000 !important; }
        
        /* إخفاء الأزرار */
        .d-print-none { display: none !important; }
        /* تقليل الالوان لعدم استهلاك الحبر */
        .report-header { background-color: gray !important; color: #fff !important; }
        
    }
</style>



@endsection