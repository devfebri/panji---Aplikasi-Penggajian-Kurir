@extends('layouts.guest')

@section('content')
    <div class="login-title">✨ Selamat Datang</div>
    <div class="login-subtitle">Masuk ke dashboard Anteraja Anda</div>

    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="form-group">
            <div class="input-group">
                <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror" 
                       placeholder=" Masukkan Nomor HP Anda" required autofocus value="{{ old('nohp') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
            @error('nohp')
            <div class="invalid-feedback d-block mt-2" style="color: #ff6b9d;">
                <i class="fas fa-exclamation-circle"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <div class="input-group">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder=" Masukkan password Anda" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
            </div>
            @error('password')
            <div class="invalid-feedback d-block mt-2" style="color: #ff6b9d;">
                <i class="fas fa-exclamation-circle"></i> {{ $message }}
            </div>
            @enderror
        </div>

        {{-- <div class="remember-forgot"> --}}
            {{-- <div class="form-check">
                <input type="checkbox" id="remember" name="remember" class="form-check-input" style="accent-color: #ff6b9d;">
                <label class="form-check-label" for="remember" style="color: #c44569; font-weight: 500;">
                    💝 Ingat saya
                </label>
            </div> --}}
            {{-- @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    🤔 Lupa password?
                </a>
            @endif --}}
        {{-- </div> --}}

        <button type="submit" class="btn btn-login">
            <i class="fas fa-heart me-2"></i> MASUK SEKARANG
        </button>
    </form>

    <div class="text-center mt-4">
        <small style="color: #c44569; font-weight: 500;">
            <i class="fas fa-shield-heart" style="color: #ff6b9d;"></i> 
            Platform aman untuk manajemen kurir profesional
        </small>
    </div>

    {{-- <div class="text-center mt-3">
        <small style="color: #ff9ff3;">
            <i class="fas fa-sparkles"></i> 
            Made with 💖 for beautiful courier management
        </small>
    </div> --}}
@endsection
