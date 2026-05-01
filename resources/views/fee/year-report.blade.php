@extends('layouts.app')

@section('title', 'التقارير السنوية | القرأنية التعليمية')

@section('content')  

<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
            <div class="bg-light p-3 mb-3 border rounded-3">

                <span>قريباً من السنة الحالية</span>
            </div>
        </div> 
    </div>
</div>


@endsection