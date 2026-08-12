<div style="background-colr: #e3e3e3" class="header-print row align-items-center text-center mb-4 border-bottom border-2 p-1 d-none d-print-flex">
    <div class="col-3 text-center rounded-3 fw-bold">
                            <span> المدرسة القرآنية لتحفيظ القرآن الكريم</span>
                            <br>
                            <span>{{Auth::user()->branch->name ?? ''}}</span>
                        </div>
                        <div class="col-6 text-center margin-top-0">
                            <h6 class="margin-top-0 font-size-49">بسم الله الرحمن الرحيم</h6><br>
                            <h4 class="fw-bold title-print">@yield('title2', '')</h4>
                            {{-- <div class="badge bg-primary px-3 py-2">البيانات الأساسية</div> --}}
                        </div>
                        <div class="col-3 text-start rounded-3">
                            <img src="{{asset('images/logo1.jpeg')}}" alt="Logo" class="img-fluid">
                        </div>
                    </div>                    