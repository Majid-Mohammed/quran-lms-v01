<!DOCTYPE html>
<html lang="ar" dir="rtl" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="refresh" content="">
  <meta name="color-scheme" content="light">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Dashboard')</title>


<link rel="stylesheet" href="{{asset('css/boxicons.min.css')}}">
<link rel="stylesheet" href="{{asset('css/materialdesignicons.css')}}">

  <!-- Bootstrap CSS -->
  <link href="{{asset('css/bootstrapt/bootstrap.min.css')}}" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="{{asset('css/bootstrapt/bootstrap-icons.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/bootstrapt/bootstrap.rtl.min.css')}}">

  <style>
    body {
      /* background-image: url({{asset('images/loginback.jpg')}}); background-size: cover; background-position: center; */
      overflow-y: auto;   
      background-color: #f4f7f9;
      text-align: right; /* Ensure text alignment for RTL */
    }
        /* منع التفاف النص في العناوين لضمان مظهر احترافي */
    .student-table th {
        white-space: nowrap;
        background-color: #212529; /* لون داكن يتناسب مع نظام إسناد */
    }

    /* تحسين شكل التمرير (Scrollbar) ليصبح أنيقاً */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 10px;
    }
  .tr{
    background-color: #aaa;
  }
    
    /* ميزة الطباعة: إخفاء التمرير عند الطباعة */
    @media print {
        .table-responsive {
            overflow: visible !important;
        }
    }


  </style>
</head>
<body>
  {{-- the sidebar and navbare are played here --}}
  @include('partials.sidebar')
  @include('partials.navbar')

  <div class="main-content">

    <div class="content">
      @yield('content')
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  
  <script>
    (() => {
      'use strict'
      const getStoredTheme = () => localStorage.getItem('theme')
      const setStoredTheme = theme => localStorage.setItem('theme', theme)

      const getPreferredTheme = () => {
        const storedTheme = getStoredTheme()
        if (storedTheme) return storedTheme
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'light' : 'light'
      }

      const setTheme = theme => {
        if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
          document.documentElement.setAttribute('data-bs-theme', 'dark')
        } else {
          document.documentElement.setAttribute('data-bs-theme', theme)
        }
      }

      setTheme(getPreferredTheme())

      window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-bs-theme-value]')
          .forEach(toggle => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value')
              setStoredTheme(theme)
              setTheme(theme)
            })
          })
      })
    })()

    // ID generation logic
    function generateFormattedId() {
        const now = new Date();
        const year = now.getFullYear();
        const monthStr = String(now.getMonth() + 1).padStart(2, '0'); 
        const randomStr = String(Math.floor(Math.random() * 9000)).padStart(4, '0');
        
        return `ID-${year}-${monthStr}-${randomStr}`;
    }

    function assignStudentId() {
        const idInput = document.getElementById('student_id');
        // Generate the ID and set it as the value of the input
        idInput.value = generateFormattedId();
        
        // Optional: Add a small visual feedback
        idInput.classList.add('is-valid');
    }

    //teacher code
    function generateFormattedCode() {

        const randomStr = String(Math.floor(Math.random() * 900000)).padStart(6, '0');
        
        return `ID-${randomStr}`;
    }
    function assignTeacherId() {
        const idInput = document.getElementById('teacher_id');
        idInput.value = generateFormattedCode();
        idInput.classList.add('is-valid');
    }
    

  // Search functionality for students Logic
    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('studentSearchInput');
    const resultsContainer = document.getElementById('resultsContainer');
    const spinner = document.getElementById('searchSpinner');
    let debounceTimer;

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();

        // إخفاء النتائج إذا كان البحث فارغاً
        if (query.length < 2) {
            resultsContainer.classList.add('d-none');
            return;
        }

        // إظهار مؤشر التحميل
        spinner.classList.remove('d-none');

        // تقنية الذكاء في الأداء: انتظار المستخدم حتى يتوقف عن الكتابة (300ms)
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetch(`/student/search?q=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                spinner.classList.add('d-none');
                renderResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
                spinner.classList.add('d-none');
            });
        }, 100);
    });

    function renderResults(students) {
    const resultsContainer = document.getElementById('resultsContainer');
    resultsContainer.innerHTML = '';

    // التأكد من أن students هي مصفوفة فعلاً
    if (!Array.isArray(students)) {
        console.error("البيانات المستلمة ليست مصفوفة:", students);
        return;
    }

    if (students.length === 0) {
        resultsContainer.innerHTML = '<div class="list-group-item text-center text-muted">لا توجد نتائج مطابقة</div>';
    } else {
        students.forEach(student => {
            const url = `@php echo route('student.profile', ['id' => 'STUDENT_ID_PLACEHOLDER']); @endphp`.replace('STUDENT_ID_PLACEHOLDER', student.id);
            resultsContainer.innerHTML += `
                <a href="${url}" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-person-circle me-2 text-primary"></i>
                            <strong>${student.full_name}</strong>
                        </div>
                        
                    </div>
                </a>`;
        });
    }
    resultsContainer.classList.remove('d-none');
  }

    // إغلاق النتائج عند الضغط في أي مكان آخر
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.classList.add('d-none');
        }
    });
  });


  
  </script>

@if(session('error'))
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    Swal.fire({
        icon: 'warning',
        title: 'عذراً!',
        text: "{{ session('error') }}",
        confirmButtonText: 'حسناً',
        confirmButtonColor: '#ffc107',
        timer: 50000
    });
</script>
@elseif(session('success'))
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'نجاح',
        text: "{{ session('success') }}",
        confirmButtonText: 'حسناً',
        confirmButtonColor: '#0ec90e',
        timer: 50000
    });
</script>
@endif
</body>
</html>