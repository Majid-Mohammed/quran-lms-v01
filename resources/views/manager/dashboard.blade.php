@extends('layouts.app')

@section('title', 'المدير')

@section('content')


<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">
        
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper">
            <div class="card border-0 shadow-sm rounded-3 p-4 bg-body-tertiary text-start">
                <h2 class="fw-bold text-primary mb-3"> المدير</h2>
                <hr>
                <p class="lead">عرض المحتوي الاخباري او غير</p>
                <div style="height: 400px;">المحتوي...</div>
            </div>
        </div>
        
    </div>
</div>
@endsection