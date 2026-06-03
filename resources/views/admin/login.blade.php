<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #4e73df, #1cc88a);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      width: 400px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .login-header {
      background: #4e73df;
      color: white;
      text-align: center;
      padding: 20px;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }

    .login-header h4 {
      margin: 0;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #4e73df;
    }

    .btn-login {
      background: #4e73df;
      color: white;
    }

    .btn-login:hover {
      background: #2e59d9;
    }

    .login-footer {
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <div class="card login-card">
    <div class="login-header">
      <h4><i class="fa fa-user-shield"></i> Admin Login</h4>
    </div>

    <div class="card-body p-4">
      <form action="{{ route('admin.authenticate') }}" method="POST">
          @csrf
        <!-- Username -->
        <div class="mb-3">
          <label class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="u_email" class="form-control" placeholder="Nhập tên đăng nhập" required>
          </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="form-label">Mật khẩu</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" name="u_password" class="form-control" placeholder="Nhập mật khẩu" required>
          </div>
        </div>

        <!-- Remember -->
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="remember">
          <label class="form-check-label" for="remember">
            Ghi nhớ đăng nhập
          </label>
        </div>

        <!-- Button -->
        <button type="submit" class="btn btn-login w-100">
          <i class="fa fa-sign-in-alt"></i> Đăng nhập
        </button>

      </form>

      <div class="login-footer mt-3">
        <a href="#">Quên mật khẩu?</a>
      </div>
    </div>
  </div>

</body>
</html>
