

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top px-3 custom-navbar d-flex align-items-center justify-content-between z-index-9999">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="#">
      <i class="bi bi-house-fill me-2"></i> الرئيسية 
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent" dir="rtl">
      <form class="d-flex mx-auto my-3 my-lg-0 w-100 w-lg-50 position-relative" role="search" id="searchForm" onsubmit="return false;">
       @csrf
        <div class="input-group">
          <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
          <input id="studentSearchInput" class="form-control bg-light border-1 rounded-2" type="search" placeholder="ابحث عن اسم الطالب أو رقم الهاتف..." aria-label="Search" autocomplete="off">
          
          <div id="searchSpinner" class="spinner-border spinner-border-sm text-primary position-absolute end-0 mt-2 me-3 d-none" style="z-index: 500;"></div>
        </div>

        <div id="resultsContainer" class="list-group position-absolute w-100 shadow-lg d-none" style="top: 100%; z-index: 1100; max-height: 300px; overflow-y: auto;">
          </div>
      </form>

      <ul class="navbar-nav align-items-lg-center ">
          <li class="nav-item ,e-lg-3 mb-0 text-nowrap mx-2 fw-bold text-primary">
            <span class="p">
              {{ auth()->user()->Branch->name }}
            </span>
          </li>
      
        @if (auth()->user()->role === 'Admin' )
          <li class="nav-item dropdown me-lg-3">
            <a class="nav-link dropdown-toggle" href="#" id="mainMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>القائمة الرئيسية</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="mainMenu">
              <li><a class="dropdown-item" href="#">الشؤون الادارية</a></li>
              <li><a class="dropdown-item" href="#">الشؤون الفنية</a></li>
              <li><a class="dropdown-item" href="#">المدرسين</a></li>
              <li><a class="dropdown-item" href="#">الطلاب</a></li>
            </ul>
          </li>
          
          <li class="nav-item dropdown me-lg-3 mb-0">
            <a class="nav-link dropdown-toggle py-3" href="#" id="mainMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>تهئة النظام </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="mainMenu">
              <li><a class="dropdown-item" href="#"> اضافة فروع</a></li>
              <li><a class="dropdown-item" href="#"> المستويات</a></li>
              <li><a class="dropdown-item" href="#">الرسوم</a></li> 
            </ul>
          </li>

          <li class="nav-item dropdown me-lg-3">
            <a class="nav-link dropdown-toggle" href="" id="branchesMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span>الفروع</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="branchesMenu"> 
              @forelse (\App\Models\Branch::all() as $branch) 
                {{-- <li><a class="dropdown-item" href="{{ route('branch.dashboard') }}">{{ $branch->name }}</a></li> --}}
                <li><a class="dropdown-item" href="{{ route('branch.dashboard', ['id' => $branch ]) }}">{{ $branch->name }}</a></li>
              @empty
                  <li><a class="dropdown-item" href="#">لا توجد فروع</a></li>
              @endforelse
            </ul>
          </li>
        @endif

        {{-- Notifications --}}
        {{-- <li class="nav-item dropdown me-3" dir="rtl">
          <a class="nav-link position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              0
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="notifDropdown" dir="rtl">
            <li><h6 class="dropdown-header">التنبيهات</h6></li>
            <li><a class="dropdown-item" href="#">تم تحديث النظام بنجاح</a></li>
            <li><a class="dropdown-item" href="#">رسالة جديدة من المدير</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-center small text-muted" href="#">عرض الكل</a></li>
          </ul>
        </li> --}}

        <li class="nav-item dropdown rounded-3 mt-2 mt-lg-0 user-profile-item">
          <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-between justify-content-lg-end gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="text-end">
              <p class="mb-0 small fw-bold text-dark">{{ auth()->user()->name }}</p>
              <p class="mb-0 text- text-primary" style="font-size: 0.7rem;">{{ auth()->user()->role }}</p>
            </div>
            <img src="https://ui-avatars.com/api/?name=Ahmed+Mohamed&background=0D6EFD&color=fff" alt="Avatar" class="rounded-circle" width="35" height="35">
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> الملف الشخصي</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-escape me-2"></i> تسجيل الخروج</button>
              </form> --}}

              <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bi bi-box-arrow-right me-2"></i> تسجيل الخروج
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                  @csrf
              </form>


            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
/* تعويض الـ margin الخاص بالـ Sidebar ليكون متجاوباً */
.custom-navbar {
    margin-right: 250px;
    transition: margin 0.3s;
}

/* في الشاشات الصغيرة، نلغي الهامش ليملأ الـ Navbar العرض بالكامل */
@media (max-width: 991.98px) {
    .custom-navbar {
        margin-right: 60px !important;
    }
    .navbar-nav {
        padding-top: 1rem;
    }
    .user-profile-item {
        background-color: #f8f9fa;
        padding: 10px;
    }
}

/* تحسين شكل القوائم المنسدلة في الجوال */
@media (max-width: 991px) {
    .dropdown-menu {
        border: none !important;
        background-color: #fefefe;
        padding-right: 1rem;
    }
}
</style>

<script>

</script>

