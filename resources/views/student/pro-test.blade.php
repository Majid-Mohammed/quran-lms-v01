@extends('layouts.app')

@section('title', 'Students')

@section('content')


     

<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
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
@endsection