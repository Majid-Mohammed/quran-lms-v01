
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>تسجيل  | القرأنية التعليمية</title>
  <link rel="stylesheet" href="{{asset('css/bootstrapt/bootstrap.rtl.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrapt/bootstrap-icons.css')}}">
  <link rel="stylesheet" href="{{asset('css/fonts/fonts.css')}}">
  
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
        <div class="card login-card shadow-lg">
          <div class="card-body p-4">
            <h4 class="text-center mb-4 fw-bold">تسجيل جديد</h4>
            
            @if ($errors->any())
              <div class="alert alert-danger py-2">
                <ul class="mb-0 small">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('users.add-user') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-code-square"></i></span>
                    <input type="text" class="form-control" id="userId" name="userId"
                           placeholder="ادخل الكود ID-000000 " required>
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="text" class="form-control" id="email" name="email" 
                           placeholder="name@school.com" value="" required>
                </div>
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label small fw-bold">كلمة المرور</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="********" required>
                </div>
                <br>
                <label for="password_confirmation" class="form-label small fw-bold">تأكيد كلمة المرور</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                           placeholder="********" required>
                </div>
              </div>

              <button class="btn btn-dark shadow-sm mb-2" type="button" onclick="window.history.back();">
                <i class="bi bi-arrow-left me-2"></i> رجوع 
              </button>
              <button type="submit" class="btn btn-islamic w-100 py-2 fw-bold shadow-sm">
                <i class="bi bi-box-arrow-in-left me-2"></i> دخول النظام
              </button>
            </form>

          </div>
          <div class="card-footer bg-white border-0 text-center pb-4">
              <small class="text-muted">نظام إدارة المدارس - القرأنية © {{date('Y')}}</small>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>