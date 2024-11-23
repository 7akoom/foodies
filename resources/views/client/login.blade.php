<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Client Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/preloader.min.css') }}" type="text/css" />
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <link href="{{ asset('backend/assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            {{-- <div class="auth-page"> --}}
                {{-- <div class="container-fluid p-0"> --}}
                    {{-- <div class="row g-0"> --}}
                        <div class="col-xxl-6 col-lg-6 col-md-5">
                            <div class="auth-full-page-content d-flex p-sm-5 p-4">
                                <div class="w-100">
                                    <div class="d-flex flex-column h-100">
                                        <div class="mb-4 mb-md-5 text-center">
                                            <a href="index.html" class="d-block auth-logo">
                                                <img src="{{ asset('backend/assets/images/logo-sm.svg') }}" alt="" height="28">
                                                <span class="main-title">
                                                    Client Login
                                                </span>
                                            </a>
                                        </div>

                                        <div class="mt-1">
                                            <div class="text-center">
                                                <h5 class="mb-0">Welcome Back !</h5>
                                                <p class="text-muted mt-2">Sign in to continue to Client.</p>
                                            </div>

                                            @if ($errors->any())
                                                @foreach ($errors->all() as $error)
                                                    <span class="text-danger">{{$error }}</span>
                                                @endforeach
                                            @endif

                                            @if (Session::has('error'))
                                                <span class="text-danger">{{ Session::get('error') }}</span>
                                            @endif

                                            @if (Session::has('success'))
                                                <span class="text-success">{{ Session::get('success') }}</span>
                                            @endif    

                                            <form class="mt-4 pt-2" action="{{ route('client.login.submit') }}"  method="post">
                                                @csrf

                                                <div class="mb-2">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                                </div>

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <label class="form-label">Password</label>
                                                        </div>

                                                        <div class="flex-shrink-0">
                                                            <div class="">
                                                                <a href="{{ route('client.forget_password') }}" class="text-muted">Forgot password?</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" name="password"  class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                        <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn button-bg w-100 waves-effect waves-light" type="submit">Log In</button>
                                                </div>
                                            </form>

                

                                            <div class="mt-5 text-center">
                                                <p class="text-muted mb-0">Don't have an account ? <a href="{{route('client.register')}}"
                                                        class="small-title"> Signup now </a> </p>
                                            </div>
                                        </div>

                                        <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0 copy-rights">© <script>document.write(new Date().getFullYear())</script> LINDA AGENCY   . Crafted with <i class="mdi mdi-heart text-danger"></i> by Hkmt Ali</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>

<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/pace-js/pace.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/pass-addon.init.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
        
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                break; 
            }
    @endif 
</script>

</body>

</html>