@extends('layouts.app')

@section('title', 'اضافة طالب')

@section('content')


     

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
                                        <input type="text" name="full_name" id="name" placeholder="الاسم بالكامل"class="formbold-form-input"/>
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
                                                            {{-- <option value="{{ $branch->id }}">{{ $branch->name }}</option> --}}
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
                                    <legend class="mb-0 text-primary fw-bold ">بيانات ولي الامر </legend>
                                    <div class="border rounded-3 bg-dark bg-opacity-10 p-">
                                    <div class="formbold-mb-1 formbold-pt-3 p-2">
                                        <div class="flex flex-wrap formbold-mx-3">
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1">
                                                    <label for="phone" class="formbold-form-label"> الاسم <span class="text-danger">*</span> </label>
                                                    <input type="text" name="g_name" id="phone"  placeholder="الاسم" class="formbold-form-input" />
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1">
                                                    <label for="phone" class="formbold-form-label"> رقم الهاتف<span class="text-danger">*</span> </label>
                                                    <input type="text" name="g_phone" id="phone"  placeholder="رقم الهاتف" class="formbold-form-input" />
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1" >
                                                    <label for="national_id" class="formbold-form-label"> الرقم الوطني<span class="text-danger">*</span> </label>
                                                    <input type="number" max="99999999999" name="g_national_id" id="national_id"  placeholder="الرقم الوطني" class="formbold-form-input" />
                                                    @error('g_national_id')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-1">
                                                    <label for="address" class="formbold-form-label">المهنة : </label>
                                                    <input type="text" name="g_occupation" id="address"  placeholder="المهنة" class="formbold-form-input" />
                                                </div>
                                            </div> 
                                            <div class="w-full sm:w-half formbold-px-3">
                                                <div class="formbold-mb-5">
                                                    <label for="status">العلاقة <span class="text-danger">*</span></label>
                                                    <select name="relation" id="status" class="formbold-form-input" style="padding: 6px">
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
                                                    <label for="address" class=""> عنوان ولي الأمر <span class="text-danger">*</span> </label>
                                                    <input type="text" name="g_address" id="address"  placeholder="الولاية - المدينة - الحي" class="formbold-form-input" />
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
        width: 50%;legend {
            display: block;
            padding-left: 10px;
            padding-right: 10px;
            border: 3px solid green;
            background-color: tomato;
            color: white;
            ;
        }
        }
    }




    
</style>



@endsection