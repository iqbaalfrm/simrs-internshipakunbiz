<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - SIMRS</title>

    {{-- Favicon & CSS (pakai public/assets seperti di Mazer) --}}
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>
<body>
<script src="{{ asset('assets/static/js/initTheme.js') }}"></script>

<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="{{ route('login') }}"><img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo"></a>
                </div>

                <h1 class="auth-title">Masuk</h1>
                <p class="auth-subtitle mb-5">Gunakan email dan kata sandi akun Anda.</p>

                {{-- FLASH / ERROR (versi inline, bisa ganti SweetAlert nanti) --}}
                @if(session('success'))
                    <div class="alert alert-success py-2">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger py-2">
                        {{ $errors->first() ?: 'Email atau kata sandi salah.' }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email"
                               class="form-control form-control-xl @error('email') is-invalid @enderror"
                               name="email" id="email" placeholder="Email"
                               value="{{ old('email') }}" required autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password"
                               class="form-control form-control-xl @error('password') is-invalid @enderror"
                               name="password" id="password" placeholder="Kata sandi" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-gray-600" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                </form>

                <div class="text-center mt-5 text-lg fs-4">
                    {{-- Kalau nanti ada fitur register/forgot, aktifkan link di bawah --}}
                    {{-- <p class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="font-bold">Daftar</a>.</p>
                    <p><a class="font-bold" href="{{ route('password.request') }}">Lupa kata sandi?</a>.</p> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                {{-- biarkan background default Mazer --}}
            </div>
        </div>
    </div>
</div>

{{-- (Opsional) SweetAlert untuk notifikasi lebih cakep
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
  Swal.fire({icon:'success', title:'Berhasil', text:'{{ session('success') }}', timer:2000, showConfirmButton:false});
@endif
@if($errors->any())
  Swal.fire({icon:'error', title:'Gagal Masuk', text:'Email atau kata sandi salah.'});
@endif
</script>
--}}
</body>
</html>
