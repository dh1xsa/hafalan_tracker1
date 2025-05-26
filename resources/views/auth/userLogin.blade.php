<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Admin & Guru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Raleway, sans-serif;
        }

        body {
            background: linear-gradient(90deg, #C7C5F4, #776BCC);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .screen {
    background: linear-gradient(90deg, #5D54A4, #7C78B8);
    position: relative;
    width: 90vw;
    max-width: 380px;
    aspect-ratio: 9 / 16; /* Rasio vertikal 16:9 */
    box-shadow: 0px 0px 24px #5C5696;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}



.screen__content {
    position: relative;
    z-index: 1;
    padding: 40px 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    overflow-y: auto;
}


        .login-title {
            color:#6d6d6d;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            margin-top:150px;
            text-align: center;
        }

        .login {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .login__field {
            position: relative;
            margin-bottom: 20px;
        }

        .login__icon {
            position: absolute;
            top: 12px;
            left: 10px;
            color: #7875B5;
        }

        .login__input {
      width: 100%;
      padding: 10px 10px 10px 34px;
      border: none;
      border-bottom: 2px solid rgba(255,255,255,0.7);
      background: rgba(255,255,255,0.1);
      font-weight: 700;
      transition: .2s;
      color: #6d6d6d; /* putih terang */
    }
    /* placeholder agar lebih jelas */
    .login__input::placeholder {
      color: rgba(255,255,255,0.6);
    }

        .login__input:focus {
            outline: none;
            border-bottom-color: #fff;
        }

        .login__submit {
            background: #fff;
            font-size: 14px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4C489D;
            box-shadow: 0px 2px 2px #5C5696;
            cursor: pointer;
            transition: .2s;
        }

        .login__submit:hover {
            border-color: #6A679E;
        }

        .button__icon {
            font-size: 24px;
            margin-left: 10px;
            color: #7875B5;
        }

        .screen__background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
        }

        .screen__background__shape {
            transform: rotate(45deg);
            position: absolute;
        }

        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #FFF;
            top: -50px;
            right: 120px;
            border-radius: 0 72px 0 0;
        }

        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            background: #6C63AC;
            top: -172px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            background: linear-gradient(270deg, #5D54A4, #6A679E);
            top: -24px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #7E7BB9;
            top: 420px;
            right: 50px;
            border-radius: 60px;
        }

        .flash-message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
        }

        .flash-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }

        .flash-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .text-red-600 {
            color: #dc2626;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="screen">
        <div class="screen__content">
            <div class="login-title">Welcome Back!<br><small style="font-size: 14px; color: #6d6d6d;">Login sebagai Admin atau Guru</small></div>

            <!-- Flash messages -->
            @if(session('success'))
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flash-message flash-success"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->has('login'))
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flash-message flash-error"
                >
                    {{ $errors->first('login') }}
                </div>
            @endif

            <form class="login" action="{{ route('user-login') }}" method="POST">
                @csrf
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input 
                        type="text" 
                        class="login__input" 
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Username / Email"
                        required>
                </div>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input 
                        type="password" 
                        class="login__input" 
                        name="password"
                        placeholder="Password"
                        required>
                </div>
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <button class="login__submit" type="submit">
                    Log In Now
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
            </form>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</body>
</html>
