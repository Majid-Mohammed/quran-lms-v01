@extends('layouts.app')

@section('title', 'التقارير الشهرية | القرأنية التعليمية')

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

                <div class="row g-2 mb-4 text-nowrap">
                    <i class="text-muted text-center">التقارير الشهرية للسنة {{ date('Y') }} قريباً</i>
                </div>

               
            </div>
        </div> 
    </div>
</div>

<style>
    

</style>
@endsection