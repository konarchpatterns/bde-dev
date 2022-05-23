
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patterns</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{ asset('patternscrmdesign/assets/img/rsz_2logo125_opt.png') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('loginformcss/css/main.css') }}">
<!--===============================================================================================-->
<style type="text/css">
    .container-login100 {
        background: linear-gradient(-135deg, #E8CFCF, #E8CFCF) !important;
}
    }
</style>
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('loginformcss/images/patternslogin.png')}}" alt="IMG">
                </div>

                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                       @csrf
                    <span class="login100-form-title">
                        User Login
                    </span>
                        @if ($errors->any())
                             
                               @foreach ($errors->all() as $error)
                                 
                                        <span style="color: red;" class="mr-2">These credentials do not match</span>
                                   
                               @endforeach
                                   
                        @endif
                    <div class="wrap-input100 validate-input" data-validate = "Valid username is required">
                        <input class="input100" type="text" name="login" placeholder="User Name">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-30">
                    
                    </div>

                    <div class="text-center p-t-50">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="{{ asset('loginformcss/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('loginformcss/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('loginformcss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('loginformcss/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('loginformcss/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="{{ asset('loginformcss/js/main.js') }}"></script>

</body>
</html>