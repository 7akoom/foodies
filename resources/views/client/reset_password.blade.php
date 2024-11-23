<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Client Reset Password</title>
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
            <div class="col-xxl-6 col-lg-6 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0 sub-title">Client Reset Password</h5>   
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

                                <form class="mt-4 pt-2" action="{{route('client.reset_password_submit')}}"  method="post">
                                    @csrf

                                    <input type="hidden" name="token" value="{{$token}}">
                                    <input type="hidden" name="email" value="{{$email}}">

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Repeat Password">
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn button-bg w-100 waves-effect waves-light" type="submit">Submit</button>
                                    </div>
                                </form>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> LINDA AGENCY  . Crafted with <i class="mdi mdi-heart text-danger"></i> by Hkmt Ali</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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