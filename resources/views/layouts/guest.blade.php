<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anteraja</title>
    <link rel="icon" type="image/png" href="{{asset('images/logo.jpg')}}">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 50%, #f8b500 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.15'%3E%3Cpath d='M20 20l20 20-20 20-20-20zm20 0l20 20-20 20-20-20zm20 0l20 20-20 20-20-20z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.2;
            z-index: -1;
            animation: floatPattern 20s linear infinite;
        }

        @keyframes floatPattern {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(-10px) translateY(-10px); }
            50% { transform: translateX(10px) translateY(10px); }
            75% { transform: translateX(-5px) translateY(5px); }
            100% { transform: translateX(0) translateY(0); }
        }

        .login-page {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .courier-login-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            box-shadow: 
                0 25px 50px rgba(255, 107, 157, 0.2),
                0 10px 30px rgba(196, 69, 105, 0.15);
            padding: 0;
            overflow: hidden;
            max-width: 950px;
            width: 100%;
            display: flex;
            min-height: 550px;
            position: relative;
        }

        .courier-login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255, 107, 157, 0.1), transparent);
            animation: rotate 10s linear infinite;
            z-index: -1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .courier-branding {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 50%, #ff9ff3 100%);
            color: white;
            padding: 60px 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .courier-branding::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath d='M10 50 Q30 20 50 50 Q70 80 90 50' stroke='%23ffffff' stroke-width='0.5' fill='none' opacity='0.1'/%3E%3Cpath d='M10 30 Q30 60 50 30 Q70 0 90 30' stroke='%23ffffff' stroke-width='0.5' fill='none' opacity='0.1'/%3E%3C/svg%3E");
            animation: wave 8s ease-in-out infinite;
            z-index: 0;
        }

        @keyframes wave {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .courier-icon {
            font-size: 4.5rem;
            margin-bottom: 25px;
            color: #fff;
            text-shadow: 
                0 0 20px rgba(255, 255, 255, 0.5),
                0 0 40px rgba(248, 181, 0, 0.3);
            animation: bounceGlow 3s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes bounceGlow {
            0%, 100% { 
                transform: translateY(0) scale(1); 
                text-shadow: 
                    0 0 20px rgba(255, 255, 255, 0.5),
                    0 0 40px rgba(248, 181, 0, 0.3);
            }
            50% { 
                transform: translateY(-10px) scale(1.05); 
                text-shadow: 
                    0 0 30px rgba(255, 255, 255, 0.8),
                    0 0 60px rgba(248, 181, 0, 0.5);
            }
        }

        .courier-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .courier-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .courier-features {
            list-style: none;
            padding: 0;
            position: relative;
            z-index: 1;
        }

        .courier-features li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .courier-features li i {
            margin-right: 12px;
            color: #fff;
            width: 20px;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .login-form-container {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-title {
            font-size: 2.2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-subtitle {
            color: #7f8c8d;
            text-align: center;
            margin-bottom: 40px;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            border: 2px solid #f1c0e8;
            border-radius: 15px;
            padding: 16px 22px;
            font-size: 1rem;
            transition: all 0.4s ease;
            background: linear-gradient(145deg, #ffeef8 0%, #ffffff 100%);
            box-shadow: inset 0 2px 4px rgba(255, 107, 157, 0.1);
        }

        .form-control:focus {
            border-color: #ff6b9d;
            box-shadow: 
                0 0 0 0.3rem rgba(255, 107, 157, 0.25),
                inset 0 2px 4px rgba(255, 107, 157, 0.1);
            background: #ffffff;
            transform: translateY(-1px);
        }

        .input-group-text {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
            color: white;
            border: 2px solid #ff6b9d;
            border-radius: 0 15px 15px 0;
            box-shadow: 
                0 4px 15px rgba(255, 107, 157, 0.3),
                inset 0 1px 3px rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .input-group:hover .input-group-text {
            transform: translateY(-1px);
            box-shadow: 
                0 6px 20px rgba(255, 107, 157, 0.4),
                inset 0 1px 3px rgba(255, 255, 255, 0.3);
        }

        .btn-login {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 50%, #ff9ff3 100%);
            border: none;
            border-radius: 15px;
            padding: 18px;
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            box-shadow: 
                0 8px 25px rgba(255, 107, 157, 0.35),
                0 4px 15px rgba(196, 69, 105, 0.2);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 
                0 12px 35px rgba(255, 107, 157, 0.45),
                0 6px 20px rgba(196, 69, 105, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .forgot-link {
            color: #ff6b9d;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .forgot-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
            transition: width 0.3s ease;
        }

        .forgot-link:hover {
            color: #c44569;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .forgot-link:hover::after {
            width: 100%;
        }

        @media (max-width: 768px) {
            .courier-login-container {
                flex-direction: column;
                margin: 20px;
            }
            
            .courier-branding {
                padding: 40px 30px;
            }
            
            .login-form-container {
                padding: 40px 30px;
            }
            
            .courier-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body class="login-page">
    <div class="courier-login-container">
        <!-- Branding Section -->
        <div class="courier-branding">
            <div class="courier-icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <h1 class="courier-title"> Anteraja</h1>
            <p class="courier-subtitle">Sistem informasi payroll penggajian mitra kurir </p>

            <ul class="courier-features">
                <li><i class="fas fa-heart"></i> Kelola Data Karyawan</li>
                <li><i class="fas fa-coins"></i> Laporan Gaji Real-time</li>
                <li><i class="fas fa-chart-line"></i> Dashboard Analytics</li>
                {{-- <li><i class="fas fas-stumbleupon-circle"></i> Keamanan Terjamin</li> --}}
            </ul>
        </div>

        <!-- Login Form Section -->
        <div class="login-form-container">
            @yield('content')
        </div>
    </div>

<script src="{{ asset('js/app.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
</body>
</html>
