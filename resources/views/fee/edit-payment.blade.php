@extends('layouts.app')

@section('title', 'تعديل السداد رسوم')

@section('content')


<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
            <div class="card border-0 rounded-3 bg-body-tertiary text-start "> 
            <div class="card border-0 shadow-sm rounded-3 p-0 bg-dark bg-opacity-10 text-start report-card print-container">
                <div class="card-header bg-dark p-2 text-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0">سند قبض رسوم</h4>
                        <small class="opacity-75">رقم السند: #INV-{{ date('Ymd') }}-{{ rand(10,99) }}</small>
                    </div>
                    <div class="text-start">
                        <i class="bi bi-receipt fs-1"></i>
                    </div>
                </div>

                <div class="card-body p-4 p-md-4">
                    @php
                        $id = $fees->id;
                    @endphp
                    <form action="{{ route('fee.edit-payment', $id) }}" method="POST">
                        @method('PUT')
                        @csrf 
                        <input type="hidden" name="student_id" value="{{ $fees->student->id }}">
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
                                <span class="badge bg-success rounded-pill">{{$fees->payment_status == 'paid' ? 'مكتمل' : ($fees->first()->payment_status == 'partial' ? 'جزئي' : ($fees->first()->payment_status == 'pending' ? 'معلق' : ($fees->first()->payment_status == 'overdue' ? 'منتهي الصلاحية' : ($fees->first()->payment_status == 'exempt' ? 'إعفاء' : ''))))}}</span>
                            </div>
                        </div>

                        <div class="row g-1">
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">شهر الاستحقاق <span class="text-danger">*</span></label>
                                <select name="fee_month" class="form-select border-0 bg-light py-2">
                                    @foreach(range(1, 12) as $m)
                                        <option value="{{ $fees->payment_month }}" {{ date('n') == $m ? 'selected' : '' }}>{{ Carbon\Carbon::create()->month($m)->locale('ar')->monthName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">السنة <span class="text-danger">*</span></label>
                                <input type="number" name="fee_year" class="form-control border-0 bg-light py-2" value="{{ $fees->fee_year }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">المبلغ المطلوب (SDG)</label>
                                <input type="number" name="amount_due" class="form-control border-0 bg-light py-2 fw-bold text-primary" value="{{ $fees->amount_due }}">
                            </div>

                            <hr class="m-2 opacity-25">

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-success">المبلغ المدفوع </label>
                                <label class="form-label fw-bold small text-success">   ـــــــــــــــ   </label>
                                <label class="form-label fw-bold small text-success">{{ number_format($fees->amount_paid, 2, '.', '.') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-success text-white border-0"><i class="bi bi-cash-stack"></i></span>
                                    <input type="number" min="0" name="" id="amount_paid" class="form-control border-success py-2 shadow-none" placeholder="المبلغ المطلوب - {{ number_format($fees->amount_due - $fees->amount_paid, 2, '.', '') }}" required value="" oninput="togglePaymentValue(this.value)">
                                    <input type="hidden" name="amount_paid" id="amount_paid1" class="form-control border-success py-2 shadow-none">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">طريقة الدفع</label>
                                <select name="payment_method" class="form-select border-0 bg-light py-2" onchange="toggleBankDetails(this.value)">
                                    <option value="Cash" {{ $fees->payment_method == 'Cash' ? 'selected' : '' }}>نقداً (Cash)</option>
                                    <option value="Bank Transfer" {{ $fees->payment_method == 'Bank Transfer' ? 'selected' : '' }}>تحويل بنكي</option>
                                    <option value="Exempt" {{ $fees->payment_method == 'Exempt' ? 'selected' : '' }}>إعفاء (Exempt)</option>
                                </select>
                            </div>

                            <div id="bank_details" class="row g-1 mt-1 {{ $fees->payment_method == 'Cash' ? 'd-none' : '' }}">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">اسم التطبيق/البنك</label>
                                    <select name="bank_name" class="form-select border-0 bg-light">
                                        <option value="">----------</option>
                                        <option value="BOK" {{ $fees->bank_name == 'BOK' ? 'selected' : '' }}>بنكك (BOK)</option>
                                        <option value="O-Cash" {{ $fees->bank_name == 'O-Cash' ? 'selected' : '' }}>أو كاش</option>
                                        <option value="Fawry" {{ $fees->bank_name == 'Fawry' ? 'selected' : '' }}>فوري</option>
                                        <option value="Mashreg" {{ $fees->bank_name == 'Mashreg' ? 'selected' : '' }}>المشرق </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">رقم المعاملة / المرجع</label>
                                    <input type="number" name="transaction_id" class="form-control border-0 bg-light" placeholder="رقم العملية" value="{{ $fees->transaction_id }}">
                                </div>
                            </div>

                            <div class="col-12 mt-2">
                                <label class="form-label fw-bold small">ملاحظات إضافية</label>
                                <textarea name="notes" class="form-control border-0 bg-light" rows="2" placeholder="أي تفاصيل أخرى عن الدفعة...">{{ $fees->notes }}</textarea>
                            </div>
                        </div>

                        <div class="mt-2 d-flex gap-2 d-print-none" id="buttons">
                            <button type="submit" class="btn btn-primary p-2 rounded-3 shadow">
                                <i class="bi bi-cloud-arrow-up me-0"></i> حفظ السند
                            </button>
                            <button type="button" onclick="window.history.back()" class="btn btn-outline-dark p-2 rounded-3">
                                <i class="bi bi-arrow-counterclockwise me-0"></i> رجوع
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    </div>
</div>

<script>
function toggleBankDetails(val) {
    const bankSection = document.getElementById('bank_details');
    if (val === 'Bank Transfer') {
        bankSection.classList.remove('d-none');
    } else {
        bankSection.classList.add('d-none');
    }
}


function togglePaymentValue(val) {
    const paymentValue = document.querySelector('#buttons button');
    let inputValue = document.querySelector('#amount_paid1'); 
    let text = document.getElementById('amount_paid');
    let mount = {{ $fees->amount_due - $fees->amount_paid }};
   let paid = {{ $fees->amount_paid }};
       inputValue.value = (+val)+(+paid);
    if (val > mount) {
        // paymentValue.classList.add('d-none');
        paymentValue.disabled = true;
        text.classList.add('text-danger');
    } else {
        paymentValue.disabled = false;
        //paymentValue.classList.remove('d-none');
        text.classList.remove('text-danger');
    }
}
</script>

<style>
    #buttons {
        transition: all 1.5s ease-in-out;
    }
    /* @media (min-width: 992px) {
        .card {
            min-height: 550px;
        }
    } */
@media print {
    /* 1. Force backgrounds and colors to appear */
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
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
    .card-header { 
        background-color: gray !important; color: #fff !important; 
    }
      @page {
            size: A4;
            margin: 10px;
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
    .col-md-6 { width: 50% !important; }

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