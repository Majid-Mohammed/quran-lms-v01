@extends('layouts.app')

@section('title', 'المستخدمين')

@section('content')


     

<div class="container-fluid px-4 text-start" dir="rtl">
    <div class="row flex-column flex-lg-row">   
        @include('partials.calender')
        <div class="col-12 col-lg-8 main-content-wrapper"> 
            <div class="bg-light p-3 mb-3 border rounded-3">
                <form id="financialFilterForm" class="row g-1 align-items-end pb-2">
                    @if (Auth::user()->role === 'Admin')
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
                        <select name="role" class="form-select form-select-sm">
                            <option value="">كل الوظائف</option>
                            <option value="Admin">مدير عام</option>
                            <option value="Manager" >مدير فرع</option>
                            <option value="Teacher" >مدرس</option>
                            <option value="Student" >طالب</option>
                        </select>
                    </div>
                    <div class="col-md-2"> 
                        <select name="status" class="form-select form-select-sm">
                            <option value="">كل الحالات</option>
                            <option value="Active">نشط</option>
                            <option value="Not Active" >غير نشط</option>
                        </select>
                    </div> 
                    <div class="col-md-6 d-flex gap-1">
                        <button type="button" id="resetFilters" class="btn btn-secondary btn-sm w-">
                            <i class="bi bi-arrow-repeat"></i> تحديث
                        </button> 
                        <button type="submit" onclick="window.print()" class="btn btn-secondary btn-sm w-">
                            <i class="bi bi-printer"></i>
                        </button> 
                        {{-- <button type="submit" class="btn btn-secondary btn-sm w-">
                            <i class="bi bi-book-half"></i> تحويلPDF
                        </button>  --}}
                        <button type="button" class="btn btn-primary btn-sm w-" onclick="window.location.href='{{ route('users.add-user') }}'">
                            <i class="bi bi-plus-circle"></i> اضافة مستخدم
                        </button>  
                    </div>
                </form>
                <div class="table-responsive">
                <table class="table user-table table-hover align-middle mb-3 student-table print-container">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">الاسم</th>
                            <th class="text-nowrap">البريد الإلكتروني</th>
                            <th class="text-nowrap">الفرع</th>
                            <th class="text-nowrap"> الوظيفة</th> 
                            <th class="text-nowrap">حالة </th> 
                            <th class="text-nowrap">الاجراء </th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="tr" oclick="window.location.href='{{ route('users.user-profile', $user->id) }}'"
                                style="cursor: pointer;" 
                                class="student-row-link">
                                                
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-nowrap ">{{ $user->name }}</td>
                                <td class="text-nowrap ">{{ $user->email }}</td> 
                                <td class="text-nowrap text-center">{{ $user->branch->name ?? '-' }}</td>
                                <td class="text-nowrap ">{{ $user->role === 'Admin' ? ' مدير عام' : ($user->role === 'Manager' ? 'مدير فرع' : ($user->role === 'Teacher' ? 'مدرس' : ($user->role === 'Student' ? 'طالب' :  ($user->role === 'Register' ? 'مسجل' :  'غير معروف')))) }}</td>
                                {{-- <td class="text-nowrap ">{{ $user->status === 'Active' ? 'نشط' : 'غير نشط' }}</td> --}}
                                <td class="text-nowrap text-center">
                                    <button class="btn btn-sm toggle-status {{ $user->isActive() ? 'btn-success' : 'btn-danger' }}" 
                                            data-id="{{ $user->id }}" title="{{ $user->isActive() ? 'توقف المستخدم' : 'تفعيل المستخدم' }}">
                                        <i class="bi {{ $user->isActive() ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                                        <span class="status-text">{{ $user->isActive() ? 'نشط' : 'غير نشط' }}</span>
                                    </button>
                                </td>
                                <td class="text-nowrap text-center">
                                    <button class="btn btn-sm btn-outline-warning reset-button" data-id="{{ $user->id }}" title="إعادة تعيين كلمة المرور">
                                        <i class="bi bi-lock-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">لا يوجد مستخدمين حتى الآن</td>
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
            background-color: rgba(255, 255, 255, 0.02) !important;
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


<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

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
        $('.user-table').css('opacity', '0.5');

        $.ajax({
            url: "{{ url()->current() }}", // يرسل الطلب لنفس الصفحة الحالية
            method: "GET",
            data: formData,
            success: function(response) {
                // استبدال محتوى الجدول فقط بالبيانات الجديدة
                // تأكد أن الـ Controller يعيد الـ HTML الخاص بالجدول أو استخلص منه الـ tbody
                let newTableBody = $(response).find('.user-table tbody').html();
               // let newPagination = $(response).find('.pagination-container').html();
                
                $('.user-table tbody').html(newTableBody);
               // $('.pagination-container').html(newPagination);
                
                $('.user-table').css('opacity', '1');
            },
            error: function() {
                alert('حدث خطأ أثناء تحديث البيانات');
                $('.user-table').css('opacity', '1');
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
        $('.user-table').css('opacity', '0.5');

        $.ajax({
            url: "{{ url()->current() }}",
            method: "GET",
            data: formData,
            success: function(response) {
                // استبدال محتوى الجدول
                $('.user-table tbody').html($(response).find('.user-table tbody').html() || response);
                // تحديث الترقيم
                $('.pagination-container').html($(response).find('.pagination-container').html());
                
                $('.user-table').css('opacity', '1');
            },
            error: function() {
                $('.user-table').css('opacity', '1');
                console.error("خطأ في تحديث البيانات");
            }
        });
    }
});


// change user status (active/not active)
$(document).on('click', '.toggle-status', function() {
    let btn = $(this);
    let id = btn.data('id');
    let statusText = btn.find('.status-text');
    let icon = btn.find('i');

    // إظهار حالة تحميل بسيطة
    btn.prop('disabled', true).css('opacity', '0.7');

    $.ajax({
        url: `users-list/${id}`, // عدل المسار حسب الـ route الخاص بك
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
        },
        success: function(response) {
            if(response.new_status === 'Active') {
                btn.removeClass('btn-danger').addClass('btn-success');
                statusText.text('نشط');
                icon.removeClass('bi-x-circle').addClass('bi-check-circle');
                alert('تم تفعيل المستخدم بنجاح');
            } else {
                btn.removeClass('btn-success').addClass('btn-danger');
                statusText.text('غير نشط');
                icon.removeClass('bi-check-circle').addClass('bi-x-circle');
                alert('تم توقف المستخدم بنجاح');
            }
        },
        error: function() {
            alert('حدث خطأ أثناء تحديث الحالة');
        },
        complete: function() {
            btn.prop('disabled', false).css('opacity', '1');
        }
    });
});
// to reset user password
$(document).on('click', '.reset-button', function() {
    let btn = $(this);
    let userId = btn.data('id'); 

    // إظهار حالة تحميل بسيطة
    btn.prop('disabled', true).css('opacity', '0.7');

    $.ajax({
        url: `reset-password/${userId}`, // عدل المسار حسب الـ route الخاص بك
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
        },
        success: function(response) {
            alert('تم إعادة تعيين كلمة المرور بنجاح');
        },
        error: function() {
            alert('حدث خطأ أثناء تحديث الحالة');
        },
        complete: function() {
            btn.prop('disabled', false).css('opacity', '1');
        }
    });
});
</script>

@endsection