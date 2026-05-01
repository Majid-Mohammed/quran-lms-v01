@extends('layouts.app')

@section('title', 'ملف الطالب')

@section('content')


<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper">
            <div class="card border-0 shadow-sm rounded-3 p- bg-body-tertiary text-start">
                {{--  --}}
                <div class="d-flex justify-content-between bg-dark align-items-center m-0 p-2 mb-0 rounded-top-3 bg-dark">
                    <div class="main-header text-white">عرض بيانات الطلاب</div>
                    <div class="d-flex gap-1">
                        <button class="btn  border-1 btn-sm bg-light shadow-sm back-btn" onclick="window.history.back()"><i class="bi bi-arrow-left"></i> عودة</button>
                        <button class="btn btn-primary btn-sm shadow-sm me-2" onclick="window.location.href='{{ route('student.add-student') }}'"><i class="bi bi-plus-circle"></i> إضافة</button>
                        <button class="btn btn-primary btn-sm shadow-sm" onclick="window.location.href='{{ route('student.edit-student', $student->id) }}'"><i class="bi bi-pencil-square"></i> تعديل</button>
                    </div>
                </div>
                <div class="container-fluid py-0 text-start  pt-3">
                    <ul class="nav nav-tabs border-0 mb-3" id="studentTabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#basic">البيانات الاساسية</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#guardian">البيانات ولي الأمر</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#academic">البيانات الاكاديمية</a></li>
                        
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#payments">الدفعيات</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#notes">البطاقة والملاحظات</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#logs">سجل الحركات</a></li>
                    </ul>
                    <div class="tab-content">
                        {{-- basic --}}
                        <div class="tab-pane fade show active" id="basic">
                            <div class="table-header-dark">البيانات الأساسية</div>
                            <table class="student-table dir-rtl">
                                <tr class="row-striped">
                                    <td class="info-label">الاسم</td>
                                    <td class="info-value">{{ $student->full_name }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">الرقم التعريفي</td>
                                    <td class="info-value">{{ $student->student_code }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">الرقم الوطني</td>
                                    <td class="info-value">{{ $student->national_id }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">المستوي الدراسي</td>
                                    <td class="info-value">{{ $student->level=='first' ? 'الأول' : ($student->level=='second' ? 'الثاني' : 'الثالث') }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">الفرع</td>
                                    <td class="info-value">    {{ $student->branch->name }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">الهاتف</td>
                                    <td class="info-value"> {{ $student->phone }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">الايميل</td>
                                    <td class="info-value"> {{ $student->email }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">العنوان</td>
                                    <td class="info-value">{{ $student->address }}</td>
                                </tr> 
                                <tr class="row-striped">
                                    <td class="info-label">تاريخ الميلاد</td>
                                    <td class="info-value">{{ $student->birth_date }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">الحالة</td>
                                    <td class="info-value">{{ $student->status=='active' ? 'نشط' : ($student->status=='graduated' ? 'متخرج' : ($student->status=='Suspended' ? 'منقول' : '')) }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">تاريخ التسجيل</td>
                                    <td class="info-value">{{ $student->created_at }}</td>
                                </tr>
                            
                            </table>
                        </div>
                        {{-- بيانات ولي الأمر --}}
                        <div class="tab-pane fade " id="guardian">
                            <div class="table-header-dark">بيانات ولي الأمر</div>
                            <table class="student-table dir-rtl">
                                <tr class="row-striped">
                                    <td class="info-label">الاسم</td>
                                    <td class="info-value">{{ $student->guardian->full_name }}</td>
                                </tr> 
                                <tr>
                                    <td class="info-label">الرقم الوطني</td>
                                    <td class="info-value">{{ $student->guardian->national_id }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label"> الهاتف</td>
                                    <td class="info-value"> {{ $student->guardian->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">صلة القرابة</td>
                                    <td class="info-value">{{ $student->guardian->relation_type == 'father' ? 'أب' : ($student->guardian->relation_type == 'uncle' ? 'خال/عم' : ($student->guardian->relation_type == 'grandfather' ? 'جد' : ($student->guardian->relation_type == 'mother' ? 'أم' : ($student->guardian->relation_type == 'brother' ? 'أخ' : ($student->guardian->relation_type == 'sister' ? 'اخت' : ($student->guardian->relation_type == 'other' ? 'أخرى' : 'لا يوجد')))))) }}</td>
                                </tr>
                                <tr class="row-striped">
                                    <td class="info-label">العنوان</td>
                                    <td class="info-value">{{ $student->guardian->address }}</td>
                                </tr>
                                <tr>
                                    <td class="info-label">الوظيفة</td>
                                    <td class="info-value">{{ $student->guardian->job }}</td>
                                </tr> 
                            </table>
                        </div>
                        {{-- البيانات الاكاديمية --}}
                        <div class="tab-pane fade " id="academic">
                            <div class="table-header-dark">البيانات الاكاديمية</div>
                            <table class="student-table dir-rtl">
                                <tr>
                                    <td class="text-center">قريباً </td>
                                </tr>
                            
                            </table>
                        </div>
                        {{-- السجلات والحركات --}}
                        <div class="tab-pane fade " id="logs">
                            <div class="table-header-dark">السجلات والحركات</div>
                            <table class="student-table dir-rtl">
                                <tr>
                                    <td class="text-center">قريباً </td>
                                </tr>
                            
                            </table>
                        </div>
                        {{-- الملاحظات --}}
                        <div class="tab-pane fade " id="notes">
                            <div class="table-header-dark"> الملاحظات</div>
                            <table class="student-table dir-rtl">
                                <tr>
                                    <td class="text-center">قريباً </td>
                                </tr>
                            
                            </table>
                        </div>
                        {{-- البيانات المالية --}}
                        <div class="tab-pane fade table-responsive shadow-sm rounded-" id="payments">
                            <div class="table-header-dark d-flex justify-content-between align-items-center p-2">
                                <span class="fw-bod "> </span>البيانات المالية

                                @php
                                    // التحقق إذا كان الشهر الحالي (رقم) والسنة الحالية موجودين في السجلات
                                    $currentMonth = date('n');
                                    $currentYear = date('Y');
                                    
                                    $isPaidThisMonth = $fees->where('fee_month', $currentMonth)
                                                            ->where('fee_year', $currentYear)
                                                            ->isNotEmpty();
                                @endphp

                                <button class="btn btn-dark btn-sm {{ !$isPaidThisMonth ? 'blink-button' : '' }}" 
                                        onclick="window.location.href='{{ route('fee.payment', $student->slug) }}'">
                                    <i class="bi bi-plus-circle me-1"></i> إضافة سداد رسوم جديد
                                </button>
                            </div>
                            <table class="table table-hover align-middle mb-3 student-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-nowrap">#</th>
                                        <th class="text-nowrap">الشهر</th>
                                        <th class="text-nowrap">الرسوم</th>
                                        <th class="text-nowrap">المدفوع</th>
                                        <th class="text-nowrap">المتبقي</th> 
                                        <th class="text-nowrap">نوع الدفع</th> 
                                        <th class="text-nowrap">البنك</th> 
                                        <th class="text-nowrap">رقم العملية</th>                        
                                        <th class="text-nowrap">التاريخ</th> 
                                        <th class="text-nowrap">حالة الدفع</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($fees as $fee)
                                         <tr onclick="window.location='{{ route('fee.receipt', $student=$fee->id) }}'" 
                                            style="cursor: pointer;" 
                                            class="student-row-link">
                                            
                                            @php \Carbon\Carbon::setLocale('ar'); @endphp
                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::create()->month($fee->fee_month)->translatedFormat('F') }}</td>
                                            <td class="fw-bold text-primary">{{ number_format($fee->amount_due) }}</td>
                                            <td class="text-success">{{ number_format($fee->amount_paid) }}</td> 
                                            <td class="text-danger">
                                                {{ $fee->payment_status == 'exempt' ? '-' : number_format($fee->amount_due - $fee->amount_paid) }}
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">
                                                    {{ $fee->payment_method == 'Bank Transfer' ? 'تحويل بنكي' : ($fee->payment_method == 'Cash' ? 'نقداً' : 'إعفاء') }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $banks = ['Mashreg' => 'المشرق', 'Fawry' => 'فوري', 'BOK' => 'الخرطوم', 'O-Cash' => 'أم درمان'];
                                                @endphp
                                                {{ $banks[$fee->bank_name] ?? '-' }}
                                            </td>
                                            <td class="font-monospace small">{{ $fee->transaction_id ?? '-' }}</td>
                                            <td>{{ $fee->payment_date }}</td>
                                            <td>
                                                @if($fee->payment_status == 'paid')
                                                    <span class="badge bg-success">مكتمل</span>
                                                @elseif($fee->payment_status == 'partial')
                                                    <span class="badge bg-warning text-dark">جزئي</span>
                                                    {{-- منع انتشار النقر للسطر عند الضغط على زر التحديث --}}
                                                    <button class="btn badge bg-warning text-dark" 
                                                            onclick="event.stopPropagation(); window.location.href='{{ route('fee.edit-payment', $fee->id) }}';">
                                                        تحديث
                                                    </button>
                                                @elseif($fee->payment_status == 'exempt')
                                                    <span class="badge bg-success">إعفاء</span>
                                                @else
                                                    <span class="badge bg-danger">معلق</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">لا يوجد سداد رسوم لهذا الطالب حتى الآن
                                                <br><button class="btn btn-primary d-center" onclick="window.location.href='{{ route('fee.payment', $student->id) }}'"> اضافة سداد رسوم جديد</button>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>               

<style>
    @media (max-width: 991px) { 
        .back-btn { display: none; }
    }
    /* ألوان الأزرار العلوية */
    
    .main-header { border: 1px solid #f0ad4e; color: #333; padding: 5px 20px; border-radius: 8px; font-weight: bold; }
    
    /* تنسيق التبويبات (Tabs) */
    .nav-tabs .nav-link {
        color: #337ab7;
        border: 1px solid #337ab7;
        margin-left: 2px;
        border-radius: 5px 5px 0 0;
        padding: 8px 15px;
        font-size: 14px;
    }
    .nav-tabs .nav-link.active {
        background-color: #337ab7 !important;
        color: white !important;
    }

    /* جدول البيانات */
    .student-table { border: 1px solid #ddd; width: 100%; margin-top: -1px; margin-bottom: 10px;}
    .table-header-dark { background-color: #5a6b7d; color: white; text-align: center; padding: 5px; font-weight: bold; }
    .info-label { 
        background-color: #ffffff; 
        width: 25%; 
        border-left: 1px solid #ddd; 
        border-bottom: 1px solid #ddd;
        padding: 3px;
        padding-right: 8px;
        font-weight: bold;
        text-align: right; /* كما في الصورة */
    }
    .info-value { 
        background-color: #ffffff; 
        border-bottom: 1px solid #ddd;
        padding: 3px;
        padding-right: 8px;
        text-align: right;
    }
    .tab-pane { margin-bottom: 10px; }
    .row-striped { background-color: #f9f9f9; height: 15px;  }
    .td { border-left: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6; }
    @media (min-width: 992px) {
        /* .table-responsive { width: 100%; overflow-x: scroll; } */
        .tab-pane { min-height: 350px; }
    } 
    
/* تأثير الوميض للزر */
.blink-button {
    animation: blink-animation 1.5s steps(5, start) infinite;
    -webkit-animation: blink-animation 1.5s steps(5, start) infinite;
    background-color: #dc3545 !important; /* تحويل اللون للأحمر للتنبيه */
    border-color: #dc3545 !important;
}

@keyframes blink-animation {
    0% { opacity: 1; box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
    50% { opacity: 0.7; box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
    100% { opacity: 1; }
}

@-webkit-keyframes blink-animation {
    0% { opacity: 1; }
    50% { opacity: 0.7; }
    100% { opacity: 1; }
}
</style>
@endsection