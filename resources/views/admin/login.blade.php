<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Admin Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/preloader.min.css') }}" type="text/css" />
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="admin-login">

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        {{-- <div class="auth-page"> --}}
            {{-- <div class="container-fluid p-0"> --}}
                {{-- <div class="row g-0"> --}}
                    <div class="col-xxl-6 col-lg-6 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4 admin-login-form">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-2 mb-md-2 text-center">
                                        <a href="index.html" class="d-block auth-logo">
                                            <img src="{{ asset('backend/assets/images/logo-sm.svg') }}" alt="" height="28">
                                            <span class="main-title">
                                                Admin Login
                                            </span>
                                        </a>
                                    </div>

                                    <div class="mt-1">
                                        <div class="text-center">
                                            <h5 class="mb-0">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to continue.</p>
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

                                        <form class="mt-4 pt-2" action="{{ route('admin.login_submit') }}"  method="post">
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
                                                        <div>
                                                            <a href="{{ route('admin.forget_password') }}" class="text-muted">Forgot password?</a>
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

                                    </div>

                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0 copy-rights">© <script>document.write(new Date().getFullYear())</script> LINDA AGENCY   . Crafted with <i class="mdi mdi-heart text-danger"></i> by Hkmt Ali</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    {{-- <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay bg-primary"></div>
                                <ul class="bg-bubbles">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>

                                <div class="row justify-content-center align-items-center">
                                    <div class="col-xl-7">
                                        <div class="p-0 p-sm-4 px-xl-0">
                                            <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                    <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                </div>

                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="testi-contain text-white">
                                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                            <h4 class="mt-4 fw-medium lh-base text-white">“I feel confident
                                                                imposing change
                                                                on myself. It's a lot more progressing fun than looking back.
                                                                That's why
                                                                I ultricies enim
                                                                at malesuada nibh diam on tortor neaded to throw curve balls.”
                                                            </h4>

                                                            <div class="mt-4 pt-3 pb-5">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                    </div>

                                                                    <div class="flex-grow-1 ms-3 mb-4">
                                                                        <h5 class="font-size-18 text-white">Richard Drews</h5>
                                                                        <p class="mb-0 text-white-50">Web Designer</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="carousel-item">
                                                        <div class="testi-contain text-white">
                                                            <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                            <h4 class="mt-4 fw-medium lh-base text-white">“Our task must be to
                                                                free ourselves by widening our circle of compassion to embrace
                                                                all living
                                                                creatures and
                                                                the whole of quis consectetur nunc sit amet semper justo. nature
                                                                and its beauty.”
                                                            </h4>

                                                            <div class="mt-4 pt-3 pb-5">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                    </div>

                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Rosanna French
                                                                    </h5>
                                                                    <p class="mb-0 text-white-50">Web Developer</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="carousel-item">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6">
                                                        </i>
                                                        <h4 class="mt-4 fw-medium lh-base text-white">“I've learned that
                                                            people will forget what you said, people will forget what you
                                                            did,
                                                            but     people will never forget
                                                            how donec in efficitur lectus, nec lobortis metus you made them
                                                            feel.”
                                                        </h4> 

                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                <div class="flex-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                                    <p class="mb-0 text-white-50">Manager
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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

</body>

</html>