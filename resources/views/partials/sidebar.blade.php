

<button class="btn btn-dark d-lg-none sticky-top position-fixed top-0 end-10 m-1 z-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" style="height: 50px;width: 55px;">
    <i class="bi bi-list fs-3"></i>
</button>

<div class="sidebar bg-dark text-white p-3 offcanvas-lg offcanvas-end" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
    
    <div class="offcanvas-header d-lg-none">
        <h5 class="offcanvas-title text-white" id="sidebarOffcanvasLabel">القائمة</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#sidebarOffcanvas"></button>
    </div>

    <div class="offcanvas-body flex-column p-lg-0">
        <h4 class="mb-4 d-none d-lg-block text-center fs-5 fw-bold border-bottom pb-3">نظام إدارة المدرسة القرأنية</h4>
        
        <ul class="nav text-right flex-column w-100">
            @foreach ($menuItems as $item)
                @php
                    $slug = \Illuminate\Support\Str::slug($item['label']);
                   // $slug = \Illuminate\Support\Str::slug($child['label']);
                    $isActive = request()->routeIs($item['route'] ?? '') 
                        || collect($item['children'] ?? [])->pluck('route')->contains(fn($r) => request()->routeIs($r));
                @endphp
                
                @if (!empty($item['children']))
                    <li class="nav-item mb-1">
                        <a class="nav-link text-white d-flex justify-content-between align-items-center rounded-2 {{ $isActive ? 'bg-primary' : 'hover-bg' }} " 
                           data-bs-toggle="collapse" href="#menu-{{ $slug }}" role="button">
                            <span><i class="{{ $item['icon'] }} me-2"></i> {{ $item['label'] }}</span>
                            <i class="bi bi-chevron-down small transition-icon"></i>
                        </a>
                        <div class="collapse {{ $isActive ? 'show' : '' }}" id="menu-{{ $slug }}">
                            <ul class="nav flex-column ms-3 border-start border-secondary mt-1">
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a href="{{ route($child['route']) }}" 
                                           class="nav-link text-white-60 py-1 px-3 {{ request()->routeIs($child['route']) ? 'text-white fw-bold active' : '' }}">
                                            • {{ $child['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item mb-1">
                        <a href="{{ route($item['route']) }}" 
                           class="nav-link text-white rounded-2 {{ $isActive ? 'bg-primary fw-bold' : 'hover-bg' }}">
                            <i class="{{ $item['icon'] }} me-2"></i> {{ $item['label'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>

<style>
        /* nav */
    .content {
      margin-right: 250px;
      transition: all 0.3s ease;
      padding: 20px;
    }
    .dropdown-item:hover {
        background-color: rgba(13, 110, 253, 0.1); /* Light blue tint */
    }
    .sidebar {
      background-color: #1e293b; /* dark blue-gray background */
      color: #fff;
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 0;
      right: 0;
      padding: 1rem;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: #ccc transparent;
      border-left: 1px solid #334155;
      direction: rtl;
      transition: transform 0.3s ease, visibility 0.3s;
      z-index: 1050;
    }

    .sidebar h4 {
      font-weight: bold;
      color: #f8fafc;
      margin-bottom: 2rem;
    }

    .sidebar .nav-link {
      color: #cbd5e1;
      font-size: 16px;
      margin-bottom: 0.5rem;
      transition: all 0.2s;
      display: flex;
      align-items: right;
      margin-bottom: 0px;
      gap: 8px;
    }

    .sidebar .nav-link:hover {
      color: #fff;
      background-color: #334155;
      border-radius: 5px;
    }

    .sidebar .nav-link.fw-bold {
      color: #fff;
      font-weight: bold;
    }

    .sidebar .collapse .nav-link {
      padding-left: 1.5rem;
    }

    .sidebar .nav-item .bi-chevron-down {
      transition: transform 0.3s ease;
    }

    .sidebar .nav-item .collapsed .bi-chevron-down {
      transform: rotate(0deg);
    }

    .sidebar .nav-item[aria-expanded="true"] .bi-chevron-down {
      transform: rotate(180deg);
    }

    .sidebar .nav-link.active {
      background-color: #495057;
      color: #ffffff !important;
      border-radius: 5px;
    }
    /* تنسيق السايدبار للديسكطوب */
    @media (min-width: 992px) {
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            right: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; /* Align with navbar */
        }
    }


    /* تأثيرات الـ Hover */
    .hover-bg:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .nav-link {
        transition: 0.2s;
        padding: 10px 15px;
    }

    /* حركة السهم عند الفتح */
    .nav-link.collapsed .bi-chevron-down {
        transform: rotate(0deg);
    }
    .nav-link:not(.collapsed) .bi-chevron-down {
        transform: rotate(180deg);
    }

    .transition-icon {
        transition: transform 100ms ease-in-out;
    }

    /* تصغير الخط في الجوال */
    @media (max-width: 991px) {
        .sidebar { 
            width: 350px !important; 
            top:5px !important;
            
        }.content {
            margin-right: 0 !important; /* تحرير المساحة بالكامل */
            width: 100%;
        }
    }

</style>