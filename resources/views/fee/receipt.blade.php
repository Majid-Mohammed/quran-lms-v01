@extends('layouts.app')

@section('title', 'إيصال')

@section('content')


<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
            <div class="card border-0 rounded-3 bg-body-tertiary text-start "> 
            <div class="card border-0 shadow-sm rounded-3 p-0 bg-dark bg-opacity-10 text-start report-card print-container" onload="window.print()">
                <div class="card-header bg-dark p-2 text-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0">سند قبض رسوم</h4>
                        <small class="opacity-75">التاريخ: {{ date('Y-m-d') }}</small>
                    </div>
                    <div class="text-start"> 
                        <small class="opacity-75">رقم الطالب: {{ $fees->student->student_code }}</small>
                        <i class="bi bi-receipt fs-1"></i>
                    </div>
                </div>

                <div class="card-body p-4 p-md-4">
                    <form action="" method="">
                        @csrf 
                        <input type="hidden" name="student_id" value="{{ $fees->student->full_name }}">
                        <input type="hidden" name="branch_id" value="{{ $fees->branch->id }}">
                        <input type="hidden" name="payment_date" value="{{ date('Y-m-d') }}">
                        <div class="row mb-1 bg-light p-3 rounded-3 g-1">
                            <div class="col-md-5">
                                <label class="text-muted small d-block">اسم الطالب</label>
                                <span class="fw-bold">{{ $fees->student->full_name }}</span>
                            </div>
                            <div class="col-md-3">
                                <label class="text-muted small d-block">الفرع</label>
                                <span class="fw-bold">{{ $fees->branch->name }}</span>
                            </div>
                            <div class="col-md-3 text-md-start">
                                <label class="text-muted small d-block">الحالة</label>
                                <span class="badge bg-success rounded-pill">{{ $fees->payment_status == 'paid' ? 'مكتمل' : ($fees->payment_status == 'partial' ? 'جزئي' : ($fees->payment_status == 'pending' ? 'معلق' : ($fees->payment_status == 'overdue' ? 'منتهي الصلاحية' : ($fees->payment_status == 'exempt' ? 'إعفاء' : '')))) }}</span>
                            </div>
                        </div>

                        <div class="row g-1">
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">شهر الاستحقاق <span class="text-danger  span-danger">*</span></label>
                                <select disabled name="fee_month" class="form-select border-0 bg-light py-2">
                                     @php 
                                                // To print Month name in arabic
                                                \Carbon\Carbon::setLocale('ar'); 
                                            @endphp
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ $fees->fee_month == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->locale('ar')->monthName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">السنة <span class="text-danger span-danger">*</span></label>
                                <input disabled type="number" name="fee_year" class="form-control border-0 bg-light py-2" value="{{ $fees->fee_year }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">المبلغ المطلوب (SDG)</label>
                                <input disabled type="number" name="amount_due" class="form-control border-0 bg-light py-2 fw-bold text-primary" value="{{ $fees->amount_due }}">
                            </div>

                            <hr class="m-2 opacity-25">

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-success">المبلغ المدفوع الآن <span class="text-danger span-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-success text-white border-0"><i class="bi bi-cash-stack"></i></span>
                                    <input disabled type="number" min="0" name="amount_paid" class="form-control border-success py-2 shadow-none" placeholder="0.00" value="{{ $fees->amount_paid }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">طريقة الدفع</label>
                                <select disabled name="payment_method" class="form-select border-0 bg-light py-2" >
                                    <option value="Cash"{{ $fees->payment_method == 'Cash' ? ' selected' : '' }}>نقداً (Cash)</option>
                                    <option value="Bank Transfer" {{ $fees->payment_method == 'Bank Transfer' ? ' selected' : '' }}>تحويل بنكي</option>
                                    <option value="Exempt"{{ $fees->payment_method == 'Exempt' ? ' selected' : '' }}>إعفاء (Exempt)</option>
                                </select>
                            </div>

                            <div id="bank_details" class="row g-1 mt-1 ">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">اسم التطبيق/البنك <span class="text-danger span-danger">*</span></label>
                                    <select disabled name="bank_name" class="form-select border-0 bg-light">
                                        <option value="">----------</option>
                                        <option value="BOK" {{ $fees->bank_name == 'BOK' ? ' selected' : '' }}>بنكك (BOK)</option>
                                        <option value="O-Cash" {{ $fees->bank_name == 'O-Cash' ? ' selected' : '' }}>أو كاش</option>
                                        <option value="Fawry" {{ $fees->bank_name == 'Fawry' ? ' selected' : '' }}>فوري</option>
                                        <option value="Mashreg" {{ $fees->bank_name == 'Mashreg' ? ' selected' : '' }}>المشرق </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">رقم المعاملة / المرجع <span class="text-danger span-danger">*</span></label>
                                    <input disabled type="number" name="transaction_id" class="form-control border-0 bg-light" placeholder="رقم العملية" value="{{ $fees->transaction_id }}">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label fw-bold small">ملاحظات إضافية</label>
                                <textarea disabled name="notes" class="form-control border-0 bg-light" rows="2" placeholder="أي تفاصيل أخرى عن الدفعة...">{{ $fees->notes }}</textarea>
                            </div>
                        </div>

                        <div class="mt-2 d-flex gap-2 d-print-none">
                            <button type="button" onclick="window.print()" class="btn btn-outline-dark p-2 rounded-3">
                                <i class="bi bi-printer me-0"></i> طباعة الفاتورة
                            </button>
                            <a href='{{ route('student.profile', $fees->student->id) }}' class="btn btn-primary p-2 rounded-3">
                                <i class="bi bi- me-0"></i> الذهاب لبيانات الطالب
                            </a>
                        </div>
                    </form>
                </div>

                <div class="card-footer p-4 text-center d-none d-print-block border-top-0">
                    <div class="row">
                        <div class="col-6">توقيع المستلم: ......................</div>
                        <div class="col-6"> الختم : ......................</div>
                    </div>
                    {{-- <p class="mt-4 small text-muted italic">شكراً لثقتكم بنا - تم إنشاء هذا السند آلياً بواسطة نظام إدارة الحلقات</p> --}}
                </div>
            </div>
        </div>
    </div> 
    </div>
</div>

<script>
    
    
</script>



<style> 
    
@media print {
    /* 1. Force backgrounds and colors to appear */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .span-danger {
        visibility: hidden;
    }
 .print-container, .print-container * { visibility: visible; }
        
        .print-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            margin: 0 !important;
            padding: 10px;
            /* background-color: rgba(255, 255, 255, 0.02) !important; */
        }
    .card-header { 
        background-color: gray !important; color: #fff !important; 
    }
      @page {
            size: A4;
            margin: 0px;
        }
    /* 2. Prevent the layout from collapsing into a single column */
    .row {
        display: flex !important;
        flex-wrap: wrap !important;
    }
    
    /* Ensure columns maintain their width instead of stacking */
    .col-md-3 { width: 25% !important; }
    .col-md-4 { width: 33.333% !important; }
    .col-md-5 { width: 41.666% !important; }
    .col-md-6 { width: 50% !important; background-color: #0ec90ef00}

    /* 3. Clean up the UI for paper */
    .card {
        border: 1px solid #eee !important;
        box-shadow: none !important;
    }

    /* 4. Remove margins/paddings that waste paper space */
    body {
       visibility: hidden;
    }
    
}
</style>

@endsection