@extends('layouts.app')

@section('title', 'الدفعيات')

@section('content')


     

<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
            <div class="bg-light p-3 mb-3 border rounded-3">

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-2 z-index-10">
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bold d-flex align-items-center" href="">
                            <i class="bi bi-bank2 me-2 text-warning"></i> 
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#financeNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end" id="financeNavbar">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('fee.finance')}}">
                                        <i class="bi bi-speedometer2"></i> الرئيسة
                                    </a>
                                </li>
                                
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="feesDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-cash-coin"></i> إدارة الرسوم
                                    </a>
                                    <ul class="dropdown-menu shadow-sm">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-plus-circle me-2"></i>تحصيل جديد</a></li>
                                        <li><a class="dropdown-item" href="{{ route('fee.payments-list') }}"><i class="bi bi-list-check me-2"></i>سجلات السداد</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-exclamation-octagon me-2"></i>المتأخرات</a></li>
                                    </ul>
                                </li> --}}
                                <li class="nav-item"><a class="nav-link" href="{{ route('fee.payments-list') }}"><i class="bi bi-list-check me-2"></i>سجلات السداد</a></li>
                   
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('report.month') }}"><i class="bi bi-file-earmark-bar-graph"></i> التقارير الشهرية</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('report.year') }}"><i class="bi bi-file-earmark-bar-graph"></i> التقارير السنوية</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <form id="financialFilterForm" class="row g-1 align-items-end pb-2">
                    @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Manager')
                        <div class="col-md-2"> 
                            <select name="branch_id" class="form-select form-select-sm">
                                <option value="">كل الفروع</option>
                                @foreach(\App\Models\Branch::all() as $branch)
                                    <option value="{{ $branch->id }}" >{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="col-md-3 d-none"> 
                            <select name="branch_id" class="form-select form-select-sm">
                                <option value="0">كل الفروع</option>
                                @foreach(\App\Models\Branch::all() as $branch)
                                    <option value="{{ $branch->id }}" {{ auth()->user()->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="col-md-2"> 
                        <select name="payment_year" class="form-select form-select-sm">
                            <option value="">كل السنوات</option>
                            @foreach(range(date('Y'), date('Y')-6) as $year)
                                <option value="{{ $year }}" {{--{{ request('payment_year') == $year ? 'selected' : '' }}--}}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"> 
                        <select name="payment_month" class="form-select form-select-sm">
                            <option value="">كل الشهور</option>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{--{{$month == date('n') ? 'Selected' : '' }}--}}>{{ $month == 1 ? 'يناير' : ($month == 2 ? 'فبراير' : ($month == 3 ? 'مارس' : ($month == 4 ? 'أبريل' : ($month == 5 ? 'مايو' : ($month == 6 ? 'يونيو' : ($month == 7 ? 'يوليو' : ($month == 8 ? 'أغسطس' : ($month == 9 ? 'سبتمبر' : ($month == 10 ? 'أكتوبر' : ($month == 11 ? 'نوفمبر' : ($month == 12 ? 'ديسمبر' : ''))))))))))) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"> 
                        <select name="status" class="form-select form-select-sm">
                            <option value="">كل الحالات</option>
                            <option value="paid">مكتمل</option>
                            <option value="partial" >جزئي</option>
                            <option value="exempt">اعفاء</option>
                        </select>
                    </div> 
                    <div class="col-md-4 d-flex gap-1">
                        <button type="button" id="resetFilters" class="btn btn-secondary btn-sm w-">
                            <i class="bi bi-arrow-repeat"></i> تحديث
                        </button> 
                        <button type="submit" onclick="window.print()" class="btn btn-secondary btn-sm w-">
                            <i class="bi bi-printer"></i>
                        </button> 
                        <button type="submit" class="btn btn-secondary btn-sm w-">
                            <i class="bi bi-book-half"></i> تحويلPDF
                        </button> 
                    </div>
                </form>
                <div class="table-responsive">
                <table class="table student-table table-hover align-middle mb-3 student-table print-container">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">الاسم</th>
                            <th class="text-nowrap">الفرع</th>
                            <th class="text-nowrap"> جملة لرسوم</th>
                            <th class="text-nowrap">جملة الدفع</th> 
                            <th class="text-nowrap">حالة الدفع</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fee as $fees)
                            <tr class="tr" onclick="window.location.href='{{ route('student.profile', $fees->student->id) }}'"
                                style="cursor: pointer;" 
                                class="student-row-link">
                                                
                                @php \Carbon\Carbon::setLocale('ar');
                                    $total = 0;
                                    $totalPaid = 0;
                                    $exempted = 0;
                                    $exemptStatus = false;
                                    $count = 0;
                                @endphp
                                
                                @foreach(\App\Models\Fee::all()->where('student_id', $fees->student_id) as $payment)
                                       @php 
                                            $total += $payment->amount_due;
                                            if ($payment->payment_status == 'exempt') {
                                                $exempted += $payment->amount_due;
                                                $exemptStatus = true;
                                                $count++;
                                            }else{
                                                $totalPaid += $payment->amount_paid;
                                            }
                                       @endphp
                                @endforeach

                                <td>{{ $loop->iteration }}</td>
                                <td class="">{{ $fees->student->full_name }}</td>
                                <td class="">{{ $fees->branch->name }}</td>
                                <td class="">{{ $total - $exempted }}</td>
                                <td class="">{{ $totalPaid }} {{$exemptStatus ? '('. $count.' حالة اعفاء)' : ''; }}</td> 
                                <td class="">
                                    <span class="badge bg-light text-dark border p-0">
                                        {{-- to subtract exempted amount from total --}}
                                        {{-- @php $total -= $exempted @endphp --}}
                                        {{-- if total paid is not equal to total then print difference if so show's it done --}}
                                        @if($totalPaid != $total)
                                            @if($total - $totalPaid - $exempted == 0)
                                                <span class="badge bg-success text-dark border p-1">
                                                    خالص 
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark border p-1">
                                                متبقي {{ $total - $totalPaid - $exempted }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge bg-success text-dark border p-1">
                                                خالص 
                                            </span>
                                        @endif
                                    </span>
                                </td>              
                            </tr> 
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted">لا يوجد سداد رسوم حتى الآن
                                    {{-- <br><button class="btn btn-primary d-center" onclick="window.location.href='{{ route('fee.payment', $student->id) }}'"> اضافة سداد رسوم جديد</button> --}}
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

<style>
    
    .tr td {
        border: 1px solid #e3e3e3;
        background-color: #fff;
        padding: 0.05rem 0.50rem;
    }

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
            /* background-color: rgba(255, 255, 255, 0.02) !important; */
        }

      @page {
            size: A4;
            margin: 0px;
        }
    /* 2. Prevent the layout from collapsing into a single column */
    /* 4. Remove margins/paddings that waste paper space */
    body {
       visibility: hidden;
    }
    
}
</style>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(document).ready(function() {
    // مراقبة أي تغيير في أي قائمة منسدلة داخل النموذج
    $('#financialFilterForm select').on('change', function() {
        fetchFilteredData();
    });

    function fetchFilteredData() {
        // جمع كل البيانات من النموذج
        let formData = $('#financialFilterForm').serialize();
        
        // إظهار تأثير التحميل (Loading) على الجدول (اختياري)
        $('.student-table').css('opacity', '0.5');

        $.ajax({
            url: "{{ url()->current() }}", // يرسل الطلب لنفس الصفحة الحالية
            method: "GET",
            data: formData,
            success: function(response) {
                // استبدال محتوى الجدول فقط بالبيانات الجديدة
                // تأكد أن الـ Controller يعيد الـ HTML الخاص بالجدول أو استخلص منه الـ tbody
                let newTableBody = $(response).find('.student-table tbody').html();
               // let newPagination = $(response).find('.pagination-container').html();
                
                $('.student-table tbody').html(newTableBody);
               // $('.pagination-container').html(newPagination);
                
                $('.student-table').css('opacity', '1');
            },
            error: function() {
                alert('حدث خطأ أثناء تحديث البيانات');
                $('.student-table').css('opacity', '1');
            }
        });
    }


    // إعادة تحديد الفلاتر الافتراضية
    // عند الضغط على زر إعادة التعيين
    $('#resetFilters').on('click', function() {
        // 1. إعادة تعيين النموذج (مسح كل الاختيارات)
        $('#financialFilterForm')[0].reset();
        
        // 2. إذا كنت تستخدم select2 أو أي مكتبات خاصة، يفضل التأكد من تصفيرها يدوياً
        $('#financialFilterForm select').val('').trigger('change.select2');

        // 3. استدعاء دالة جلب البيانات بدون فلاتر (لجلب الكل)
        fetchFilteredData();
    });

    // دالة جلب البيانات (تأكد أنها مطابقة لما لديك)
    function fetchFilteredData() {
        let formData = $('#financialFilterForm').serialize();
        $('.student-table').css('opacity', '0.5');

        $.ajax({
            url: "{{ url()->current() }}",
            method: "GET",
            data: formData,
            success: function(response) {
                // استبدال محتوى الجدول
                $('.student-table tbody').html($(response).find('.student-table tbody').html() || response);
                // تحديث الترقيم
                $('.pagination-container').html($(response).find('.pagination-container').html());
                
                $('.student-table').css('opacity', '1');
            },
            error: function() {
                $('.student-table').css('opacity', '1');
                console.error("خطأ في تحديث البيانات");
            }
        });
    }
});
</script>

@endsection