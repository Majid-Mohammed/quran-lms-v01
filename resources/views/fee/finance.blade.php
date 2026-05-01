@extends('layouts.app')

@section('title', 'ادارة الرسوم والسجلات المالية')

@section('content')  

<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
            <div class="bg-light p-3 mb-3 border rounded-3">


                @php
                    $totalPaid = 0;
                    $totalDue = 0;
                    $totalExempted = 0;
                    $totalLate = 0;
                    $totalExempted = 0;
                    $exemptStatus = 0;
                    if(auth()->user()->role === 'Admin'){
                        $fees = \App\Models\Fee::all()->where('fee_year', date('Y'));
                    }else{
                        $fees = \App\Models\Fee::where('branch_id', auth()->user()->branch_id)->where('fee_year', date('Y'))->get();
                    }
                    foreach($fees as $fee)
                    {
                        $totalPaid += $fee->amount_paid;
                        $totalDue += $fee->amount_due;
                        $totalLate = $totalDue - $totalPaid;
                        if($fee->payment_status == 'exempt')
                        {
                            $totalExempted += $fee->amount_due;
                            $exemptStatus++;
                        } 
                        $totalLate = $totalDue - $totalPaid - $totalExempted;
                    }
                @endphp

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
                                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="#">
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

                <div class="row g-2 mb-4 text-nowrap">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="small fw-bold text-nowrap">إجمالي المستحقة</h6>
                                        <h4 class="mb-0">{{ $totalDue }}</h4>
                                    </div>
                                    <i class="bi bi-wallet2 fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="small fw-bold">إجمالي التحصيل</h6>
                                        <h4 class="mb-0">{{ $totalPaid }}</h4>
                                    </div>
                                    <i class="bi bi-cash-stack fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm bg-danger text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="small fw-bold">المتأخرات الكلية</h6>
                                        <h4 class="mb-0">{{ number_format($totalLate) }}</h4>
                                    </div>
                                    <i class="bi bi-graph-down-arrow fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm bg-warning text-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="small fw-bold"> حالات اعفاء  {{$exemptStatus}}</h6>
                                        <h4 class="mb-0">{{ $totalExempted }}</h4>
                                    </div>
                                    <i class="bi bi-people fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <form id="filterForm" class="row g-1">
                            <div class="col-md-2">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="ابحث باسم الطالب أو الرقم...">
                            </div>
                            <div class="col-md-2">
                                <select name="branch" class="form-select form-select-sm">
                                    <option value="">كل الفروع</option>
                                    @foreach(\App\Models\Branch::all() as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select form-select-sm">
                                    <option value="">حالة الدفع</option>
                                    <option value="paid">خالص</option>
                                    <option value="partial">متبقي</option>
                                    <option value="exempt">إعفاء</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex gap-1">
                                <input type="date" name="from" class="form-control form-control-sm" title="من تاريخ">
                                <input type="date" name="to" class="form-control form-control-sm" title="إلى تاريخ">
                            </div> 
                        </form>
                    </div>
                </div> --}}

                {{-- <div class="table-responsive bg-white rounded-3 shadow-sm">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>الطالب</th>
                                <th>المستحق</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th>الحالة</th>
                                <th class="text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                             
                        </tbody>
                    </table>
                </div> --}}

                <div class="modal fade" id="paymentModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title">تسجيل دفعة جديدة</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label small">طريقة الدفع</label>
                                        <select name="method" class="form-select">
                                            <option value="Cash">نقداً</option>
                                            <option value="Bank">تحويل بنكي</option>
                                            <option value="Cheque">شيك</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small">المبلغ</label>
                                        <input type="number" name="amount" class="form-control" required placeholder="0.00">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_exempt" id="exemptCheck">
                                        <label class="form-check-label small" for="exemptCheck">إعفاء (Exemption)</label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small">ملاحظات</label>
                                        <textarea name="note" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-primary btn-sm">تأكيد وعرض الإيصال</button>
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
    
    .tr td {
        border: 1px solid #e3e3e3;
        background-color: #fff;
        padding: 0.05rem 0.50rem;
    }
</style>

@endsection