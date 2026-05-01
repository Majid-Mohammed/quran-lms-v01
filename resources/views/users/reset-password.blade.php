
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> تغيير كلمة المرور | مدرسة القرأنية التعليمية</title>

  <link rel="stylesheet" href="{{asset('css/boxicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/materialdesignicons.css')}}">

  <!-- Bootstrap CSS -->
  <link href="{{asset('css/bootstrapt/bootstrap.min.css')}}" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="{{asset('css/bootstrapt/bootstrap-icons.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/bootstrapt/bootstrap.rtl.min.css')}}">

  
  <style>
    body {
      font-family: 'Noto Kufi Arabic', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
      height: 100vh;
      display: flex;
      align-items: center;
    }
    .login-card {
      border: none;
      border-top: 5px solid #1a5928; /* لون أخضر إسلامي وقور */
      border-radius: 15px;
      overflow: hidden;
    }
    .brand-logo {
      font-family: 'Times New Roman', Times, serif;
      color: #f8f9fa;
      font-size: 2rem;
    }
    .btn-islamic {
      background-color: #1a5928;
      color: white;
      border: none;
      transition: 0.3s;
    }
    .btn-islamic:hover {
      background-color: #13421e;
      color: #fff;
      transform: translateY(-2px);
    }
    .input-group-text {
      background-color: #f8f9fa;
      color: #1a5928;
    }
  </style>
</head>
<body style="background-image: url({{asset('images/loginback.jpg')}}); background-size: cover; background-position: center;">

      
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        
        <div class="text-center mb-4 text-white">
            <div class="brand-logo mb-1">القرأنية التعليمية</div>
            <div class="text- small">بوابة الإدارة المدرسية الرقمية</div>
        </div>

        <div class="card login-card shadow-lg">
          <div class="card-body p-4">
            <h4 class="text-center mb-4 fw-bold">تغيير كلمة المرور</h4>
            
            @if ($errors->any())
              <div class="alert alert-danger py-2">
                <ul class="mb-0 small">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('users.reset-password', $user->id) }}">
              @csrf

              <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label small fw-bold"> كلمة المرور الحالية</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="current_password" placeholder="********" required>
                </div>  
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label small fw-bold">كلمة المرور الجديدة</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="new_password" 
                           placeholder="********" required>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label small fw-bold">تأكيد كلمة المرور</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="new_password_confirmation" 
                           placeholder="********" required>
                </div>
              </div>

              <button type="submit" class="btn btn-islamic w-100 py-2 fw-bold shadow-sm">
                <i class="bi bi-box-arrow-in-left me-2"></i> تغيير كلمة المرور
              </button>
            </form>

          </div>
          <div class="card-footer bg-white border-0 text-center pb-4">
              <small class="text-muted">نظام إدارة المدارس - القرأنية © 2026</small>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>