{{-- @extends('layouts.app')

@section('title', 'Students')

@section('content')


     

<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender') --}}
        {{-- <div class="col-12 col-lg-8 main-content-wrapper">  --}}
            {{-- <div class="card border-0 rounded-3 bg-body-tertiary text-start "> 
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');

                    :root {
                        --gold-primaryl: #c19b67;
                        --dark-primary: #333333;
                        --light-gray: #eeeeee;
                        
                    }

                    .receipt-wrapper {
                        font-family: 'Times New Roman', Times, serif;
                        background-color: #fff;
                        direction: rtl;
                        position: relative;
                        max-width: 900px;
                        margin: 20px auto;
                        border: 1px solid var(--light-gray);
                        overflow: hidden;
                        min-height: 500px;
                        display: flex;
                        flex-direction: column;
                    }

                    /* الزخارف الجانبية - متجاوبة */
                    .top-decoration {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 30%;
                        height: 120px;
                        background: linear-gradient(135deg, var(--dark-primary) 30%, var(--gold-primary) 30%, var(--gold-primary) 60%, var(--light-gray) 60%);
                        clip-path: polygon(0 0, 100% 0, 0 100%);
                        z-index: 1;
                    }

                    .bottom-decoration {
                        width: 100%;
                        height: 30px;
                        background: linear-gradient(to left, var(--gold-primary) 30%, var(--light-gray) 30%, var(--light-gray) 40%, var(--gold-primary) 40%, var(--gold-primary) 70%, var(--dark-primary) 70%);
                        margin-top: auto;
                    }

                    /* الشعار - يتمركز في الموبايل ويكون جانبي في الشاشات الكبيرة */
                    .receipt-header-section {
                        padding: 40px 40px 10px;
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-start;
                        flex-wrap: wrap;
                        gap: 20px;
                    }

                    .logo-box {
                        border: 3px solid var(--gold-primary);
                        width: 110px;
                        height: 110px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        text-align: center;
                        font-weight: bold;
                        color: var(--dark-primary);
                        z-index: 2;
                    }

                    .title-area {
                        flex-grow: 1;
                        text-align: center;
                        padding-top: 20px;
                    }

                    .receipt-title {
                        color: var(--gold-primary);
                        font-size: clamp(1.8rem, 5vw, 2.5rem);
                        font-weight: 400;
                        margin-bottom: 0;
                    }

                    /* محتوى الإيصال المتجاوب */
                    .receipt-body {
                        padding: 20px 40px;
                    }

                    .info-row {
                        display: flex;
                        align-items: baseline;
                        flex-wrap: wrap;
                        gap: 10px;
                        margin-bottom: 25px;
                        width: 100%;
                    }

                    .field-label {
                        font-weight: 700;
                        color: var(--dark-primary);
                        white-space: nowrap;
                        font-size: 1.1rem;
                    }

                    .dotted-line {
                        flex-grow: 1;
                        border-bottom: 1.5px dashed #666;
                        min-width: 150px;
                        padding: 0 10px;
                        color: #000;
                        font-weight: 600;
                    }

                    .signature-area {
                        display: flex;
                        justify-content: space-around;
                        margin-top: 50px;
                        padding-bottom: 40px;
                    }

                    .sign-box {
                        text-align: center;
                        color: var(--gold-primary);
                        font-weight: 700;
                    }

                    /* شاشات الموبايل الصغير جداً */
                    @media (max-width: 576px) {
                        .receipt-header-section {
                            flex-direction: column;
                            align-items: center;
                        }
                        .top-decoration { width: 50%; }
                        .receipt-body { padding: 20px; }
                        .info-row { flex-direction: column; align-items: stretch; }
                        .dotted-line { min-width: 100%; }
                    }

                    /* إعدادات الطباعة */
                    @media print {
                        .receipt-wrapper {
                            border: none;
                            margin: 0;
                            width: 100%;
                            max-width: 100%;
                            background-color: white;
                        }
                        .print-container { background-color: white }
                        .btn-print-action { display: none !important; }
                        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
                    }
                </style>

                <div class="receipt-wrapper shadow-sm print-container">
                    <div class="top-decoration"></div>
                    <div class="receipt-header-section">
                        <div class="logo-box">
                            <div>أضف<br>شعارك</div>
                        </div>

                        <div class="title-area">
                            <h1 class="receipt-title">إيصال استلام رسوم</h1>
                            <div class="text-muted small">رقم: {{ $receipt_no ?? '١٢٣٤٥' }}</div>
                        </div>
                        
                        <div class="date-box pt-md-4">
                            <span class="field-label" style="color: var(--gold-primary)">التاريخ:</span>
                            <span class="dotted-line" style="min-width: 120px;">{{ date('Y / m / d') }}</span>
                        </div>
                    </div>

                    <div class="receipt-body">
                        <div class="info-row">
                            <span class="field-label">استلمنا من الطالب:</span>
                            <span class="dotted-line">ماجد محمد أحمد</span>
                        </div>

                        <div class="info-row">
                            <span class="field-label">مبلغ وقدره:</span>
                            <span class="dotted-line" style="flex-grow: 2;">خمسة آلاف جنيه سوداني فقط</span>
                            <span class="field-label">نقداً / شيك رقم:</span>
                            <span class="dotted-line">123456</span>
                        </div>

                        <div class="info-row">
                            <span class="field-label">وذلك قيمة:</span>
                            <span class="dotted-line">رسوم دورة البرمجة - شهر مارس</span>
                        </div>

                        <div class="signature-area">
                            <div class="sign-box">
                                <div>المستلم</div>
                                <div class="dotted-line mt-4" style="min-width: 120px;"></div>
                            </div>
                            <div class="sign-box">
                                <div>الختم الرسمي</div>
                            </div>
                        </div>
                    </div>

                    <div class="bottom-decoration"></div>
                </div>

                <div class="text-center mt-3 mb-5 btn-print-action">
                    <button onclick="window.print()" class="btn btn-dark px-5 py-2 rounded-pill shadow">
                        <i class="bi bi-printer me-2"></i> طباعة الإيصال
                    </button>
                </div>
            </div> --}}
            {{-- <div class="bg-light p-3 mb-3 border rounded-3">
                <form action="{{ url()->current() }}" method="GET" class="row g-2 align-items-end pb-2">
                    <div class="col-md-3">
                        <label class="small fw-bold mb-1"> الفرع</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">كل الحالات</option>
                            @foreach(\App\Models\Branch::all() as $branch)
                                <option value="{{ $branch->id }}" {{ auth()->user()->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="small fw-bold mb-1">السنة الدراسية</label>
                        <select name="year" class="form-select form-select-sm">
                            <option value="">كل السنوات</option>
                            @foreach(range(date('Y'), date('Y')-6) as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="small fw-bold mb-1">حالة الدفع</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">كل الحالات</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>مكتمل</option>
                            <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>جزئي</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>معلق</option>
                            <option value="exempt" {{ request('status') == 'exempt' ? 'selected' : '' }}>اعفاء</option>
                        </select>
                    </div> 
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-secondary btn-sm w-100">
                            <i class="bi bi-filter"></i> تصفية
                        </button> 
                    </div>
                </form>
                <table class="table table-hover align-middle mb-3 student-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-nowrap">#</th>
                                        <th class="text-nowrap">الاسم</th>
                                        <th class="text-nowrap">الفرع</th>
                                        <th class="text-nowrap">الرسوم</th>
                                        <th class="text-nowrap">جملة الدفع</th> 
                                        <th class="text-nowrap">حالة الدفع</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($fees as $fee) --}}
                                         {{-- <tr onclick="window.location=''" 
                                            style="cursor: pointer;" 
                                            class="student-row-link">
                                            
                                            @php \Carbon\Carbon::setLocale('ar'); @endphp
                                            
                                            <td>#</td> 
                                            <td class="fw-bold text-primary">{{ "ماجد محمد أحمد" }}</td>
                                            <td class="fw-bold text-primary">{{ "كوستي" }}</td>
                                            <td class="fw-bold text-primary">{{ 5000 }}</td>
                                            <td class="fw-bold text-primary">{{  5000 }}</td> 
                                            <td class="fw-bold text-primary">
                                                <span class="badge bg-light text-dark border">
                                                    {{'تحويل بنكي' }}
                                                </span>
                                            </td>
                                            
                                        </tr> 
                                </tbody>
                </table> --}}
            {{-- </div> --}} 
            
{{-- 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استمارة بيانات الطالب - جعفر مهدي</title> 
    <style>
        body { font-family: 'Cairo', sans-serif; background-color: #f8f9fa; }
        .report-container { background: white; padding: 30px; border: 1px solid #dee2e6; max-width: 900px; margin: 20px auto; position: relative; }
        .header-logo { width: 80px; height: 80px; object-fit: contain; }
        .student-photo { width: 120px; height: 140px; border: 2px solid #0d6efd; border-radius: 10px; object-fit: cover; }
        .section-title { background-color: #e9ecef; padding: 5px 15px; font-weight: bold; border-right: 5px solid #0d6efd; margin-bottom: 15px; margin-top: 20px; }
        .data-label { font-weight: bold; color: #495057; width: 30%; background-color: #f1f3f5; }
        .table-bordered td { padding: 8px 12px; vertical-align: middle; }
        @media print {
            body { background: white; }
            .report-container { border: none; margin: 0; width: 100%; max-width: 100%; }
            .btn-print { display: none; }
        }
    </style>
</head>

<div class="container text-center my-3 btn-print">
    <button onclick="window.print()" class="btn btn-primary px-4">طباعة التقرير</button>
</div>

<div class="report-container shadow-sm">
    <div class="row align-items-center text-center mb-4">
        <div class="col-3 text-start rounded-3">
            جامعة الإمام المهدي <br> <br>
            كلية الشريعة
        </div>
        <div class="col-6 text-center">
            <h4 class="fw-bold">استمارة بيانات الطالب</h4>
            <div class="badge bg-primary px-3 py-2">البيانات الأساسية</div>
        </div>
        <div class="col-3 text-start rounded-3">
            <img src="{{asset('images/loginback.jpg')}}" class="img-fluid rounded-3" alt="Image">
        </div>
    </div>

    <table class="table table-bordered border-dark-subtle">
        <tr>
            <td class="data-label">الرقم الوطني</td>
            <td>18220296699</td>
            <td class="data-label">رقم الطالب</td>
            <td>1200023123</td>
        </tr>
        <tr>
            <td class="data-label">الاسم بالعربية</td>
            <td colspan="3" class="fw-bold">جعفر مهدي عبد القادر محمد</td>
        </tr>
        <tr>
            <td class="data-label">الاسم بالإنجليزية</td>
            <td colspan="3">GAFER MAHDI ABDELGADRE MOHAMED</td>
        </tr>
        <tr>
            <td class="data-label">الكلية</td>
            <td>كلية الشريعة</td>
            <td class="data-label">القسم</td>
            <td>القانون العام</td>
        </tr>
        <tr>
            <td class="data-label">نوع القبول</td>
            <td>عام</td>
            <td class="data-label">تاريخ القبول</td>
            <td>2023-2024</td>
        </tr>
        <tr>
            <td class="data-label">البرنامج الدراسي</td>
            <td colspan="3">بكالوريوس</td>
        </tr>
    </table>

    <div class="section-title">البيانات الشخصية</div>
    <table class="table table-bordered border-dark-subtle">
        <tr>
            <td class="data-label">الولاية</td>
            <td>النيل الابيض</td>
            <td class="data-label">المحلية</td>
            <td>ربك</td>
        </tr>
        <tr>
            <td class="data-label">الوحدة الإدارية</td>
            <td>ربك</td>
            <td class="data-label">مكان الميلاد</td>
            <td>العباسية شرق_ ربك</td>
        </tr>
        <tr>
            <td class="data-label">تاريخ الميلاد</td>
            <td>2005-04-01</td>
            <td class="data-label">النوع</td>
            <td>ذكر</td>
        </tr>
        <tr>
            <td class="data-label">الجنسية</td>
            <td>سوداني</td>
            <td class="data-label">الشهادة</td>
            <td>سودانية</td>
        </tr>
        <tr>
            <td class="data-label">نوع السكن</td>
            <td>خارجي</td>
            <td class="data-label">السكن الحالي</td>
            <td>العباسية شرق ريفي مدينة ربك</td>
        </tr>
        <tr>
            <td class="data-label">رقم الهاتف 1</td>
            <td>0906054153</td>
            <td class="data-label">رقم الهاتف 2</td>
            <td>0923642889</td>
        </tr>
        <tr>
            <td class="data-label">الحالة الاجتماعية</td>
            <td colspan="3">اعزب</td>
        </tr>
    </table>

    <div class="section-title">بيانات ولي الأمر</div>
    <table class="table table-bordered border-dark-subtle">
        <tr>
            <td class="data-label">اسم أقرب الأقربين</td>
            <td colspan="3">خالد محمود عبد القادر</td>
        </tr>
        <tr>
            <td class="data-label">العلاقة</td>
            <td>ابن عم شقيق</td>
            <td class="data-label">رقم الهاتف</td>
            <td>0917173252</td>
        </tr>
        <tr>
            <td class="data-label">عنوانه</td>
            <td colspan="3">العباسية شرق ريفي مدينة ربم</td>
        </tr>
    </table>

    <div class="section-title">تفاصيل الرسوم الدراسية</div>
    <table class="table table-bordered border-dark-subtle">
        <tr>
            <td class="data-label">الرسوم الدراسية</td>
            <td class="text-primary fw-bold">250,000</td>
            <td class="data-label">رسوم التسجيل</td>
            <td class="text-primary fw-bold">200,000</td>
        </tr>
        <tr>
            <td class="data-label">عدد الأقساط</td>
            <td>قسطين</td>
            <td class="data-label">القسط الأول</td>
            <td>275,000</td>
        </tr>
        <tr>
            <td class="data-label">القسط الثاني</td>
            <td>225,000</td>
            <td class="data-label">القسط الثالث</td>
            <td>0</td>
        </tr>
        <tr>
            <td class="data-label">القسط الرابع</td>
            <td>0</td>
            <td colspan="2"></td>
        </tr>
    </table>

    <div class="mt-4 pt-3 border-top d-flex justify-content-between small text-muted">
        <span>تاريخ الطباعة : 2026-04-11 17:03</span>
        <span class="fw-bold">نظام إسناد لإدارة المؤسسات التعليمية</span>
    </div>
</div>


        </div> 
    </div>
</div>

<style>
    @media print { 
    @page { size: A4; margin: 10px;  }

    /* إخفاء كل شيء ما عدا منطقة الطباعة */
    body * { visibility: hidden; }
    .print-container, .print-container * { visibility: visible; }
    
    .print-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            margin: 0 !important;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.02) !important;
        }

    /* تحويل المدخلات (Inputs) إلى نصوص عادية عند الطباعة */
    .form-control, .form-select {
        border: none !important;
        background: transparent !important;
        padding: 0 !important;
        appearance: none;
    }

    /* إخفاء الأزرار وأي عناصر تفاعلية */
    .d-print-none { display: none !important; }

    /* تنسيق الجداول والحدود للطباعة */
    .card { border: none !important; border-radius: 0 !important; box-shadow: none}
    .card-header { 
        background-color: #f8f9fa !important; 
        color: #000 !important; 
        border-bottom: 2px solid #333 !important;
        -webkit-print-color-adjust: exact;
    }
    
    /* إظهار التواقيع في أسفل الصفحة */
    .print-footer {
        position: absolute;
        bottom: 2cm;
        width: 100%;
        display: block !important;
    }
}
/* تنسيق إضافي لتحسين المظهر على الشاشة */
.print-container { transition: all 0.3s; }
</style>
@endsection --}}

{{-- @extends('layouts.app')

@section('title', 'اضافة طالب')

@section('content')

    <div class="container-fluid px-4 text-start" dir="rtl">
        <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
            <div class="col-12 col-lg-8 main-content-wrapper"> 
                <div class="card border-0 shadow-sm rounded-3 bg-body-tertiary text-start">
                    <div class="report-header p-3 text-white mb-2 rounded-top-3 bg-dark d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-0"> أضافة بيانات طالب جديد </h4>
                            <small class="opacity-75">إدارة حلقات التحفيظ</small>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-0 fw-bold view-field"> التاريخ</h5>
                            <small class="opacity-75">{{ date('Y/m/d') }}</small>
                        </div>
                    </div>

                    <!-- Step Indicator -->
                    <div class="px-3 pt-2">
                        <ul class="nav nav-pills nav-justified bg-white p-2 rounded border" id="formWizardTab">
                            <li class="nav-item">
                                <span class="nav-link active fw-bold" id="tab-step-1">
                                    <i class="bi bi-person-fill me-1"></i> 1. بيانات الطالب
                                </span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link text-muted fw-bold" id="tab-step-2">
                                    <i class="bi bi-people-fill me-1"></i> 2. بيانات ولي الأمر
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="form-responsive">
                        <div class="formbold-form-wrapper p-3 rounded-3 border mb-2">
                            <form action="{{route('student.add-student')}}" method="POST" id="studentRegistrationForm">
                                @csrf

                                <!-- STEP 1: STUDENT DATA -->
                                <div id="step-1" class="wizard-step">
                                    <legend class="mb-3 text-primary fw-bold fs-5">بيانات الطالب</legend>
                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-3">
                                        <div class="formbold-mb-3 p-2">
                                            <label for="name" class="formbold-form-label"> اسم الطالب <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" id="name" placeholder="الاسم بالكامل" class="formbold-form-input" required/>
                                        </div>
                                        <div class="formbold-mb-3 p-2">
                                            <label for="student_id" class="form-label">رقم الطالب التعريفي <span class="text-danger">*</span></label>
                                            <div class="input-group formbold-mb-0 rounded-3 border p-0">
                                                <input type="text" name="student_code" style="border-radius: 0 0.375rem 0.375rem 0; padding: 0.375rem;" id="student_id" class="form-control bg-light" placeholder="اضغط توليد لإنشاء الرقم" readonly required>
                                                <button class="btn btn-primary" style="border-radius: 0.375rem 0 0 0.375rem; padding: 0.375rem;" type="button" onclick="assignStudentId()">
                                                    <i class="bi bi-gear-fill me-1"></i> توليد رقم
                                                </button>
                                                @error('student_code')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div> 
                                        </div>
                                        <div class="formbold-mb-1 formbold-pt-3 p-2">
                                            <div class="flex flex-wrap formbold-mx-3">
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="phone" class="formbold-form-label"> رقم الهاتف </label>
                                                        <input type="text" name="phone" id="phone" placeholder="رقم الهاتف" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                        <input type="number" max="99999999999" name="national_id" id="national_id" placeholder="الرقم الوطني" class="formbold-form-input" required/>
                                                        @error('national_id')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="address" class="formbold-form-label"> عنوان الطالب <span class="text-danger">*</span> </label>
                                                        <input type="text" name="address" id="address" placeholder="الولاية - المدينة - الحي" class="formbold-form-input" required/>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="email" class="formbold-form-label"> البريد الإلكتروني </label>
                                                        <input type="text" name="email" id="email" placeholder="البريد الإلكتروني" class="formbold-form-input" />
                                                        @error('email')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="gender">الجنس <span class="text-danger">*</span></label>
                                                        <select name="gender" id="gender" class="formbold-form-input" required>
                                                            <option value="">------</option>
                                                            <option value="male">ذكر</option>
                                                            <option value="female">أنثى</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="branch">الفرع <span class="text-danger">*</span></label>
                                                        <select name="branch_id" id="branch" class="formbold-form-input" {{ Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Manager' ? 'disabled' : '' }} required>
                                                            <option value=""> ------ </option> 
                                                            @if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Manager')
                                                                <option value="{{ Auth::user()->branch_id }}" selected>{{ Auth::user()->branch->name }}</option>
                                                            @endif
                                                            @foreach(\App\Models\Branch::all() as $branch)
                                                                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Manager' || Auth::user()->branch_id == $branch->id)
                                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="birth_date">تاريخ الميلاد <span class="text-danger">*</span></label>
                                                        <input type="date" name="birth_date" id="birth_date" placeholder="تاريخ الميلاد" class="formbold-form-input" required/>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="status">الحالة :</label>
                                                        <select name="status" id="status" class="formbold-form-input" style="padding: 6px">
                                                            <option value="">------</option>
                                                            <option value="active">نشط</option>
                                                            <option value="graduated">متخرج</option>
                                                            <option value="transferred">منقول</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="w-full mt-3">
                                        <button type="button" class="formbold-btn bg-primary" onclick="goToStep(2)">
                                            التالي: بيانات ولي الأمر <i class="bi bi-arrow-left ms-1"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- STEP 2: GUARDIAN DATA -->
                                <div id="step-2" class="wizard-step d-none">
                                    <legend class="mb-3 text-primary fw-bold fs-5">بيانات ولي الأمر</legend>
                                    
                                    <!-- Selector for Existing vs New Guardian -->
                                    <div class="card mb-3 border-secondary-subtle">
                                        <div class="card-body p-3 bg-light rounded-3">
                                            <div class="form-check form-check-inline me-3">
                                                <input class="form-check-input" type="radio" name="guardian_type" id="type_new" value="new" checked onchange="toggleGuardianSelection()">
                                                <label class="form-check-label fw-bold" for="type_new">إضافة ولي أمر جديد</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="guardian_type" id="type_existing" value="existing" onchange="toggleGuardianSelection()">
                                                <label class="form-check-label fw-bold" for="type_existing">اختيار ولي أمر مسجل مسبقاً</label>
                                            </div>

                                            <!-- Dropdown for existing guardians -->
                                            <div id="existing_guardian_wrapper" class="mt-3 d-none">
                                                <label for="existing_guardian_id" class="formbold-form-label">اختر ولي الأمر <span class="text-danger">*</span></label>
                                                <select name="guardian_id" id="existing_guardian_id" class="formbold-form-input select2" onchange="autofillGuardianData(this)">
                                                    <option value="">-- اختر ولي الأمر من القائمة --</option>
                                                    @foreach(\App\Models\Guardian::all() as $guardian)
                                                        <option value="{{ $guardian->id }}" 
                                                                data-name="{{ $guardian->name }}" 
                                                                data-phone="{{ $guardian->phone }}" 
                                                                data-national_id="{{ $guardian->national_id }}" 
                                                                data-occupation="{{ $guardian->occupation }}" 
                                                                data-address="{{ $guardian->address }}">
                                                            {{ $guardian->name }} - {{ $guardian->phone }} (الرقم الوطني: {{ $guardian->national_id }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Guardian Form Fields -->
                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-3" id="guardian_fields_container">
                                        <div class="formbold-mb-1 formbold-pt-3 p-2">
                                            <div class="flex flex-wrap formbold-mx-3">
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_name" class="formbold-form-label"> الاسم <span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_name" id="g_name" placeholder="الاسم" class="formbold-form-input" required />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_phone" class="formbold-form-label"> رقم الهاتف<span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_phone" id="g_phone" placeholder="رقم الهاتف" class="formbold-form-input" required />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                        <input type="number" max="99999999999" name="g_national_id" id="g_national_id" placeholder="الرقم الوطني" class="formbold-form-input" required />
                                                        @error('g_national_id')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_occupation" class="formbold-form-label">المهنة : </label>
                                                        <input type="text" name="g_occupation" id="g_occupation" placeholder="المهنة" class="formbold-form-input" />
                                                    </div>
                                                </div> 
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="relation">العلاقة <span class="text-danger">*</span></label>
                                                        <select name="relation" id="relation" class="formbold-form-input" style="padding: 6px" required>
                                                            <option value="">------</option>
                                                            <option value="father">أب</option>
                                                            <option value="uncle">خال/عم</option> 
                                                            <option value="grandfather">جد</option>
                                                            <option value="mother">أم</option>
                                                            <option value="brother">أخ</option>
                                                            <option value="sister">اخت</option>
                                                            <option value="other">أخرى</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_address" class="formbold-form-label"> عنوان ولي الأمر <span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_address" id="g_address" placeholder="الولاية - المدينة - الحي" class="formbold-form-input" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 mt-3">
                                        <button type="button" class="btn btn-secondary w-50 py-2 fw-bold" onclick="goToStep(1)">
                                            <i class="bi bi-arrow-right me-1"></i> السابق
                                        </button>
                                        <button type="submit" class="formbold-btn bg-success w-50">
                                            تسجيــــل
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: "Inter", Arial, Helvetica, sans-serif;
    }
    .formbold-mb-5 {
        margin-bottom: 10px;
    }
    .formbold-pt-3 {
        padding-top: 12px;
    }
    .formbold-main-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px;
    }

    .formbold-form-wrapper {
        margin: 0 auto;
        max-width: 550px;
        width: 100%;
        background: white;
    }
    .formbold-form-label {
        display: block;
        font-weight: 500;
        font-size: 16px;
        color: #07074d;
        margin-bottom: 5px;
    }

    .formbold-form-input {
        width: 100%;
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        background: white;
        font-weight: 500;
        font-size: 16px;
        color: #6b7280;
        outline: none;
        resize: none;
    }
    .formbold-form-input:focus {
        border-color: #6a64f1;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold-btn {
        text-align: center;
        font-size: 16px;
        border-radius: 6px;
        padding: 12px 32px;
        border: none;
        font-weight: 600;
        background-color: #6a64f1;
        color: white;
        cursor: pointer;
    }
    .formbold-btn:hover {
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold-px-3 {
        padding-left: 6px;
        padding-right: 6px;
    }
    .flex {
        display: flex;
    }
    .flex-wrap {
        flex-wrap: wrap;
    }
    .w-full {
        width: 100%;
    }
    @media (min-width: 540px) {
        .sm\:w-half {
            width: 50%;
        }
    }
</style>

<script>
    function goToStep(step) {
        // Simple form validation check before advancing to step 2
        if (step === 2) {
            const step1Inputs = document.querySelectorAll('#step-1 input[required], #step-1 select[required]');
            let isValid = true;

            step1Inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    isValid = false;
                    return false;
                }
            });

            if (!isValid) return;
        }

        // Toggle visibility
        if (step === 1) {
            document.getElementById('step-1').classList.remove('d-none');
            document.getElementById('step-2').classList.add('d-none');
            
            document.getElementById('tab-step-1').classList.add('active');
            document.getElementById('tab-step-1').classList.remove('text-muted');
            document.getElementById('tab-step-2').classList.remove('active');
            document.getElementById('tab-step-2').classList.add('text-muted');
        } else {
            document.getElementById('step-1').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');

            document.getElementById('tab-step-2').classList.add('active');
            document.getElementById('tab-step-2').classList.remove('text-muted');
            document.getElementById('tab-step-1').classList.remove('active');
            document.getElementById('tab-step-1').classList.add('text-muted');
        }
    }

    function toggleGuardianSelection() {
        const isExisting = document.getElementById('type_existing').checked;
        const wrapper = document.getElementById('existing_guardian_wrapper');
        const gName = document.getElementById('g_name');
        const gPhone = document.getElementById('g_phone');
        const gNationalId = document.getElementById('g_national_id');
        const gAddress = document.getElementById('g_address');

        if (isExisting) {
            wrapper.classList.remove('d-none');
            // Make read-only when existing is chosen
            gName.readOnly = true;
            gPhone.readOnly = true;
            gNationalId.readOnly = true;
            gAddress.readOnly = true;
        } else {
            wrapper.classList.add('d-none');
            // Reset and allow typing for new guardian
            gName.readOnly = false;
            gPhone.readOnly = false;
            gNationalId.readOnly = false;
            gAddress.readOnly = false;

            gName.value = '';
            gPhone.value = '';
            gNationalId.value = '';
            document.getElementById('g_occupation').value = '';
            gAddress.value = '';
            document.getElementById('existing_guardian_id').value = '';
        }
    }

    function autofillGuardianData(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        if (selectedOption && selectedOption.value !== '') {
            document.getElementById('g_name').value = selectedOption.getAttribute('data-name') || '';
            document.getElementById('g_phone').value = selectedOption.getAttribute('data-phone') || '';
            document.getElementById('g_national_id').value = selectedOption.getAttribute('data-national_id') || '';
            document.getElementById('g_occupation').value = selectedOption.getAttribute('data-occupation') || '';
            document.getElementById('g_address').value = selectedOption.getAttribute('data-address') || '';
        }
    }
</script>

@endsection --}}

@extends('layouts.app')

@section('title', 'اضافة طالب')

@section('content')

    {{-- <div class="container-fluid px-4 text-start" dir="rtl">
        <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
            <div class="col-12 col-lg-8 main-content-wrapper"> 
                <div class="card border-0 shadow-sm rounded-3 bg-body-tertiary text-start">
                    <div class="report-header p-3 text-white mb-2 rounded-top-3 bg-dark d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-0"> أضافة يبانات طالب جديد </h4>
                            <small class="opacity-75">إدارة حلقات التحفيظ</small>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-0 fw-bold view-field"> التاريخ</h5>
                            <small class="opacity-75">{{ date('Y/m/d') }}</small>
                        </div>
                    </div>
                    <div class="form-responsive">
                        <div class="formbold-form-wrapper p-1 rounded-3 border mb-2">
                            <form action="{{route('student.add-student')}}" method="POST">
                                @csrf

                                
                                <div id="step-student">
                                    {{-- <legend class="mb-2 text-primary fw-bold">بيانات الطالب</legend> --}
                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-2">
                                        <div class="formbold-mb-3 p-2">
                                            <label for="name" class="formbold-form-label"> اسم الطالب <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" id="name" placeholder="الاسم بالكامل" class="formbold-form-input"/>
                                        </div>
                                        <div class="formbold-mb-3 p-2">
                                            <label for="student_id" class="form-label">رقم الطالب التعريفي <span class="text-danger">*</span></label>
                                            <div class="input-group formbold-mb-0 rounded-3 border p-0">
                                                <input type="text" name="student_code" style="border-radius: 0 0.375rem 0.375rem 0; padding: 0.375rem;" id="student_id" class="form-control bg-light" placeholder="اضغط توليد لإنشاء الرقم" readonly>
                                                <button class="btn btn-primary" style="border-radius: 0.375rem 0 0 0.375rem; padding: 0.375rem;" type="button" onclick="assignStudentId()">
                                                    <i class="bi bi-gear-fill me-1"></i> توليد رقم
                                                </button>
                                                @error('student_code')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div> 
                                        </div>

                                        <div class="formbold-mb-1 formbold-pt-3 p-2">
                                            <div class="flex flex-wrap formbold-mx-3">
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="phone" class="formbold-form-label"> رقم الهاتف </label>
                                                        <input type="text" name="phone" id="phone" placeholder="رقم الهاتف" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                        <input type="number" max="99999999999" name="national_id" id="national_id" placeholder="الرقم الوطني" class="formbold-form-input" />
                                                        @error('national_id')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="address" class="formbold-form-label"> عنوان الطالب <span class="text-danger">*</span> </label>
                                                        <input type="text" name="address" id="address" placeholder="الولاية - المدينة - الحي" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="email" class="formbold-form-label"> البريد الإلكتروني </label>
                                                        <input type="text" name="email" id="email" placeholder="البريد الإلكتروني" class="formbold-form-input" />
                                                        @error('email')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="gender">الجنس <span class="text-danger">*</span></label>
                                                        <select name="gender" id="gender" class="formbold-form-input">
                                                            <option value="">------</option>
                                                            <option value="male">ذكر</option>
                                                            <option value="female">أنثى</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="branch">الفرع <span class="text-danger">*</span></label>
                                                        <select name="branch_id" id="branch" class="formbold-form-input" {{ Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Manager' ? 'disabled' : '' }}>
                                                            <option value=""> ------ </option> 
                                                            @if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Manager')
                                                                <option value="{{ Auth::user()->branch_id }}" selected>{{ Auth::user()->branch->name }}</option>
                                                            @endif
                                                            @foreach(\App\Models\Branch::all() as $branch)
                                                                @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Manager' || Auth::user()->branch_id == $branch->id)
                                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="birth_date">تاريخ الميلاد <span class="text-danger">*</span></label>
                                                        <input type="date" name="birth_date" id="birth_date" placeholder="تاريخ الميلاد" class="formbold-form-input"/>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="status">الحالة :</label>
                                                        <select name="status" id="status" class="formbold-form-input" style="padding: 6px">
                                                            <option value="">------</option>
                                                            <option value="active">نشط</option>
                                                            <option value="graduated">متخرج</option>
                                                            <option value="transferred">منقول</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-full p-1 mt-3">
                                        <button type="button" id="next-to-guardian" class="formbold-btn bg-primary">
                                            التالي (بيانات ولي الأمر) &larr;
                                        </button>
                                    </div>
                                </div>

                                {{-- STEP 2: GUARDIAN DATA --}
                                <div id="step-guardian" style="display: none;">
                                    <legend class="mb-2 text-primary fw-bold">بيانات ولي الامر</legend>
                                    
                                    {{-- Existing Guardian Selection --}
                                    <div class="border rounded-3 bg-light p-3 mb-3">
                                        <label for="existing_guardian_id" class="formbold-form-label fw-bold">اختر ولي أمر مسجل مسبقاً (اختياري)</label>
                                        <select name="guardian_id" id="existing_guardian_id" class="formbold-form-input" onchange="toggleGuardianFields(this)">
                                            <option value="">-- إدخال ولي أمر جديد --</option>
                                            @foreach(\App\Models\Guardian::all() as $guardian)
                                                <option value="{{ $guardian->id }}" 
                                                        data-name="{{ $guardian->name }}" 
                                                        data-phone="{{ $guardian->phone }}" 
                                                        data-national_id="{{ $guardian->national_id }}" 
                                                        data-occupation="{{ $guardian->occupation }}" 
                                                        data-address="{{ $guardian->address }}">
                                                    {{ $guardian->name }} (الهاتف: {{ $guardian->phone }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted mt-1 d-block">إذا كان ولي الأمر مضافاً بالفعل، اختر اسمه وسيتم ملء كافة البيانات تلقائياً.</small>
                                    </div>

                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-2">
                                        <div class="formbold-mb-1 formbold-pt-3 p-2">
                                            <div class="flex flex-wrap formbold-mx-3">
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_name" class="formbold-form-label"> الاسم <span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_name" id="g_name" placeholder="الاسم" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_phone" class="formbold-form-label"> رقم الهاتف<span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_phone" id="g_phone" placeholder="رقم الهاتف" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                        <input type="number" max="99999999999" name="g_national_id" id="g_national_id" placeholder="الرقم الوطني" class="formbold-form-input" />
                                                        @error('g_national_id')
                                                            <div class="invalid-feedback d-block">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_occupation" class="formbold-form-label">المهنة : </label>
                                                        <input type="text" name="g_occupation" id="g_occupation" placeholder="المهنة" class="formbold-form-input" />
                                                    </div>
                                                </div> 
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-5">
                                                        <label for="g_relation">العلاقة <span class="text-danger">*</span></label>
                                                        <select name="relation" id="g_relation" class="formbold-form-input" style="padding: 6px">
                                                            <option value="">------</option>
                                                            <option value="father">أب</option>
                                                            <option value="uncle">خال/عم</option> 
                                                            <option value="grandfather">جد</option>
                                                            <option value="mother">أم</option>
                                                            <option value="brother">أخ</option>
                                                            <option value="sister">اخت</option>
                                                            <option value="other">أخرى</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_address" class="formbold-form-label"> عنوان ولي الأمر <span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_address" id="g_address" placeholder="الولاية - المدينة - الحي" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 mt-3">
                                        <button type="button" id="prev-to-student" class="btn btn-secondary w-50 py-2">
                                            &rarr; السابق
                                        </button>
                                        <button type="submit" class="formbold-btn bg-primary w-50">
                                            تسجيــــل
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: "Inter", Arial, Helvetica, sans-serif;
    }
    .formbold-mb-5 {
        margin-bottom: 10px;
    }
    .formbold-pt-3 {
        padding-top: 12px;
    }
    .formbold-main-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px;
    }

    .formbold-form-wrapper {
        margin: 0 auto;
        max-width: 550px;
        width: 100%;
        background: white;
    }
    .formbold-form-label {
        display: block;
        font-weight: 500;
        font-size: 16px;
        color: #07074d;
        margin-bottom: 5px;
    }
    .formbold-form-label-2 {
        font-weight: 600;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .formbold-form-input {
        width: 100%;
        padding: 3px 12px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        background: white;
        font-weight: 500;
        font-size: 16px;
        color: #6b7280;
        outline: none;
        resize: none;
    }
    .formbold-form-input:focus {
        border-color: #6a64f1;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold-btn {
        text-align: center;
        font-size: 16px;
        border-radius: 6px;
        padding: 14px 32px;
        border: none;
        font-weight: 600;
        background-color: #6a64f1;
        color: white;
        width: 100%;
        cursor: pointer;
    }
    .formbold-btn:hover {
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold--mx-3 {
        margin-left: -12px;
        margin-right: -12px;
    }
    .formbold-px-3 {
        padding-left: 6px;
        padding-right: 6px;
    }
    .flex {
        display: flex;
    }
    .flex-wrap {
        flex-wrap: wrap;
    }
    .w-full {
        width: 100%;
    }
    @media (min-width: 540px) {
        .sm\:w-half {
            width: 50%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stepStudent = document.getElementById('step-student');
        const stepGuardian = document.getElementById('step-guardian');
        const nextBtn = document.getElementById('next-to-guardian');
        const prevBtn = document.getElementById('prev-to-student');

        // Toggle forward
        nextBtn.addEventListener('click', function () {
            stepStudent.style.display = 'none';
            stepGuardian.style.display = 'block';
        });

        // Toggle back
        prevBtn.addEventListener('click', function () {
            stepGuardian.style.display = 'none';
            stepStudent.style.display = 'block';
        });
    });

    // Handle existing guardian select auto-fill
    function toggleGuardianFields(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        
        const gName = document.getElementById('g_name');
        const gPhone = document.getElementById('g_phone');
        const gNationalId = document.getElementById('g_national_id');
        const gOccupation = document.getElementById('g_occupation');
        const gAddress = document.getElementById('g_address');

        if (selectEl.value !== "") {
            gName.value = selectedOption.getAttribute('data-name') || '';
            gPhone.value = selectedOption.getAttribute('data-phone') || '';
            gNationalId.value = selectedOption.getAttribute('data-national_id') || '';
            gOccupation.value = selectedOption.getAttribute('data-occupation') || '';
            gAddress.value = selectedOption.getAttribute('data-address') || '';
            
            // Set fields read-only when pre-selected
            gName.readOnly = true;
            gPhone.readOnly = true;
            gNationalId.readOnly = true;
            gOccupation.readOnly = true;
            gAddress.readOnly = true;
        } else {
            // Reset fields
            gName.value = '';
            gPhone.value = '';
            gNationalId.value = '';
            gOccupation.value = '';
            gAddress.value = '';

            gName.readOnly = false;
            gPhone.readOnly = false;
            gNationalId.readOnly = false;
            gOccupation.readOnly = false;
            gAddress.readOnly = false;
        }
    }
</script> --}}
<div class="container-fluid px-4 text-start" dir="rtl">
        <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
            <div class="col-12 col-lg-8 main-content-wrapper"> 
                <div class="card border-0 shadow-sm rounded-3 bg-body-tertiary text-start">
                    <div class="report-header p-3 text-white mb-2 rounded-top-3 bg-dark d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold mb-0"> أضافة يبانات طالب جديد </h4>
                            <small class="opacity-75">إدارة حلقات التحفيظ</small>
                        </div>
                        <div class="text-end">
                            <h5 class="mb-0 fw-bold view-field"> التاريخ</h5>
                            <small class="opacity-75">{{ date('Y/m/d') }}</small>
                        </div>
                    </div>
                    <div class="form-responsive">
                        <div class="formbold-form-wrapper p-1 rounded-3 border mb-2">
                            <form action="{{route('student.add-student')}}" method="POST">
                                @csrf
                                    {{-- <legend class="mb-0 text-primary fw-bold ">بيانات الطالب </legend> --}}
                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-">
                                    <div class="formbold-mb-3 p-2">
                                        <label for="name" class="formbold-form-label"> اسم الطالب <span class="text-danger">*</span></label>
                                        <input type="text" name="full_name" id="name" placeholder="الاسم بالكامل" class="formbold-form-input"/>
                                    </div>
                                    <div class="formbold-mb-3 p-2 ">
                                        <label for="student_id" class="form-label">رقم الطالب التعريفي <span class="text-danger">*</span></label>
                                        <div class="input-group formbold-mb-0 rounded-3 border p-0">
                                            <input type="text" name="student_code" style="border-radius: 0 0.375rem 0.375rem 0; padding: 0.375rem;" id="student_id" class="form-control bg-light " placeholder="اضغط توليد لإنشاء الرقم" readonly>
                                            <button class="btn btn-primary" style="border-radius: 0.375rem 0 0 0.375rem; padding: 0.375rem;" type="button" onclick="assignStudentId()">
                                                <i class="bi bi-gear-fill me-1"></i> توليد رقم
                                            </button>
                                            @error('student_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> 
                                    </div>
                                    {{-- fd --}}
                                    <div class="formbold-mb-1 formbold-pt-3 p-2">
                                        <div class="flex flex-wrap formbold-mx-3">
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1">
                                                    <label for="phone" class="formbold-form-label"> رقم الهاتف </label>
                                                    <input type="text" name="phone" id="phone"  placeholder="رقم الهاتف" class="formbold-form-input" />
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1" >
                                                    <label for="national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                    <input type="number" max="99999999999" name="national_id" id="national_id"  placeholder="الرقم الوطني" class="formbold-form-input" />
                                                    @error('national_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1">
                                                    <label for="address" class="formbold-form-label"> عنوان الطالب <span class="text-danger">*</span> </label>
                                                    <input type="text" name="address" id="address"  placeholder="الولاية - المدينة - الحي" class="formbold-form-input" />
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1">
                                                    <label for="email" class="formbold-form-label"> البريد الإلكتروني </label>
                                                    <input type="text" name="email" id="email"  placeholder="البريد الإلكتروني" class="formbold-form-input" />
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-5">
                                                    <label for="gender">الجنس <span class="text-danger">*</span></label>
                                                    <select name="gender" id="gender" class="formbold-form-input">
                                                        <option value="">------</option>
                                                        <option value="male">ذكر</option>
                                                        <option value="female">أنثى</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-5">
                                                    <label for="branch">الفرع <span class="text-danger">*</span></label>
                                                    <select name="branch_id" id="branch" class="formbold-form-input" {{ Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Manager' ? 'disabled' : '' }}>
                                                        <option value=""> ------ </option> 
                                                        @if (Auth::user()->role !== 'Admin' && Auth::user()->role !== 'Manager')
                                                            <option value="{{ Auth::user()->branch_id }}" selected>{{ Auth::user()->branch->name }}</option>
                                                        @endif
                                                        @foreach(\App\Models\Branch::all() as $branch)
                                                            @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Manager' || Auth::user()->branch_id == $branch->id)
                                                            
                                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-5">
                                                    <label for="birth_date">تاريخ الميلاد <span class="text-danger">*</span></label>
                                                    <input type="date" name="birth_date" id="birth_date" placeholder="تاريخ الميلاد" class="formbold-form-input"/>
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-5">
                                                    <label for="status">الحالة :</label>
                                                    <select name="status" id="status" class="formbold-form-input" style="padding: 6px">
                                                        <option value="">------</option>
                                                        <option value="active">نشط</option>
                                                        <option value="graduated">متخرج</option>
                                                        <option value="transferred">منقول</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div> 
                                    
                                    <legend class="mb-0 text-primary fw-bold mt-3">بيانات ولي الامر </legend>
                                    
                                    {{-- خيار اختيار ولي أمر موجود --}}
                                    <div class="border rounded-3 bg-light p-2 my-2">
                                        <label for="existing_guardian_id" class="formbold-form-label fw-bold">اختيار ولي أمر مسجل مسبقاً (اختياري)</label>
                                        <select name="guardian_id" id="existing_guardian_id" class="formbold-form-input" onchange="toggleGuardianFields(this)">
                                            <option value="">-- إدخال ولي أمر جديد --</option>
                                            @foreach(\App\Models\Guardian::all() as $guardian)
                                                <option value="{{ $guardian->id }}">
                                                    {{ $guardian->name }} (الهاتف: {{ $guardian->phone }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-">
                                    <div class="formbold-mb-1 formbold-pt-3 p-2">
                                        <div class="flex flex-wrap formbold-mx-3">

                                            {{-- حقول إدخال ولي أمر جديد (سيتم إخفائها عند تحديد ولي أمر موجود) --}}
                                            <div id="new-guardian-fields" class="w-full flex flex-wrap">
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_name" class="formbold-form-label"> الاسم <span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_name" id="g_name" placeholder="الاسم" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_phone" class="formbold-form-label"> رقم الهاتف<span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_phone" id="g_phone" placeholder="رقم الهاتف" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                        <input type="number" max="99999999999" name="g_national_id" id="g_national_id" placeholder="الرقم الوطني" class="formbold-form-input" />
                                                        @error('g_national_id')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_occupation" class="formbold-form-label">المهنة : </label>
                                                        <input type="text" name="g_occupation" id="g_occupation" placeholder="المهنة" class="formbold-form-input" />
                                                    </div>
                                                </div> 
                                                <div class="w-full sm:w-half formbold-px-3">
                                                    <div class="formbold-mb-1">
                                                        <label for="g_address" class="formbold-form-label"> عنوان ولي الأمر <span class="text-danger">*</span> </label>
                                                        <input type="text" name="g_address" id="g_address" placeholder="الولاية - المدينة - الحي" class="formbold-form-input" />
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- حقل صلة القرابة (يبقى دائماً ظاهراً) --}}
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-5">
                                                    <label for="g_relation" class="formbold-form-label">العلاقة <span class="text-danger">*</span></label>
                                                    <select name="relation" id="g_relation" class="formbold-form-input" style="padding: 6px">
                                                        <option value="">------</option>
                                                        <option value="father">أب</option>
                                                        <option value="uncle">خال/عم</option> 
                                                        <option value="grandfather">جد</option>
                                                        <option value="mother">أم</option>
                                                        <option value="brother">أخ</option>
                                                        <option value="sister">اخت</option>
                                                        <option value="other">أخرى</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                <div class="w-full p- mt-1">
                                    <button class="formbold-btn bg-primary">تسجيــــل</button>
                                </div> 
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: "Inter", Arial, Helvetica, sans-serif;
    }
    .formbold-mb-5 {
        margin-bottom: 10px;
    }
    .formbold-pt-3 {
        padding-top: 12px;
    }
    .formbold-main-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 48px;
    }

    .formbold-form-wrapper {
        margin: 0 auto;
        max-width: 550px;
        width: 100%;
        background: white;
    }
    .formbold-form-label {
        display: block;
        font-weight: 500;
        font-size: 16px;
        color: #07074d;
        margin-bottom: 5px;
    }
    .formbold-form-label-2 {
        font-weight: 600;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .formbold-form-input {
        width: 100%;
        padding: 3px 12px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        background: white;
        font-weight: 500;
        font-size: 16px;
        color: #6b7280;
        outline: none;
        resize: none;
    }
    .formbold-form-input:focus {
        border-color: #6a64f1;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold-btn {
        text-align: center;
        font-size: 16px;
        border-radius: 6px;
        padding: 14px 32px;
        border: none;
        font-weight: 600;
        background-color: #6a64f1;
        color: white;
        width: 100%;
        cursor: pointer;
    }
    .formbold-btn:hover {
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
    }

    .formbold--mx-3 {
        margin-left: -12px;
        margin-right: -12px;
    }
    .formbold-px-3 {
        padding-left: 6px;
        padding-right: 6px;
    }
    .flex {
        display: flex;
    }
    .flex-wrap {
        flex-wrap: wrap;
    }
    .w-full {
        width: 100%;
    }
    @media (min-width: 540px) {
        .sm\:w-half {
            width: 50%;
        }
    }
</style>

<script>
    function toggleGuardianFields(selectEl) {
        const newGuardianFields = document.getElementById('new-guardian-fields');
        if (selectEl.value !== "") {
            // إخفاء الحقول عند اختيار ولي أمر مسبق
            newGuardianFields.style.display = 'none';
        } else {
            // إظهار الحقول عند اختيار ولي أمر جديد
            newGuardianFields.style.display = 'flex';
        }
    }
</script>

@endsection