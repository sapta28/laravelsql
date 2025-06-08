<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - HIPAM Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            max-width: 400px;
            margin: 80px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        .logo-icon {
            font-size: 3rem;
            color: #0d6efd;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>

    <div class="login-box text-center">
        {{-- Logo Ikon --}}
        <div class="logo-icon mb-2">
            <i class="fas fa-tint"></i> {{-- ikon tetesan air --}}
        </div>
        <div class="login-title text-primary mb-3">Login HIPAM Payment</div>

        {{-- Form Login --}}
        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt me-1"></i> Login
            </button>
        </form>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
