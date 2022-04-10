@if(session('user'))
	<script>window.location = "{{ url('/dashboard') }}";</script>
@endif
<!DOCTYPE html>
<html>
<head>
        <!-- App Icons -->
        <link rel="shortcut icon" href=" {{ asset('public/images/favicon1.ico') }}">
        <!-- Basic Css files -->
        <link href=" {{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/style.css') }}" rel="stylesheet" type="text/css">
        <!-- font-awesome icons CSS -->
        <link href=" {{ asset('public/css/font-awesome.css') }}" rel="stylesheet"> 

<link rel="stylesheet" type="text/css" href=" {{ asset('public/css/toastr.css') }}">

<style>
.mobile {
	font-size: 1em;
    padding: 14px 15px 14px 37px;
    width: 100%;
    color: #A8A8A8;
    outline: none;
    border: 1px solid #D3D3D3;
    background: #FFFFFF;
    margin: 0em 0em 1.5em 0em;
}
.error_msg {
    font-size: 12px;
    color: #e2595f;
    margin-top: 5px;
}
</style>
</head>
<body class="fixed-left">
        <!-- Loader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div> -->
        <!-- Begin page -->
        <div class="accountbg"></div>

        <div class="wrapper-page">
            <div class="card">
                <div class="card-body">
                    <div class="p-3">
                        <div class="float-right text-right">
                            <h4 class="font-18 mt-3 m-b-5">Forgot Password !!</h4>
                        </div>
                        <a href="#" class="logo-admin"><img src=" {{ asset('public/images/logo_dark.png') }} " height="80" alt="logo"></a>
                    </div>
                    <div class="p-3">
                        <form class="form-horizontal m-t-10" method="post" action="forgotPassword" autocomplete="off">
                            <div class="form-group">
                                <label for="username">Mobile</label> 
                                <input type="text" class="form-control" name="mobile" placeholder="Enter Your Mobile">
                                <span  class="help-block"></span>
                                @error('mobile')
                                    <span  class="error_msg">{{$message}}</span>
                                @enderror
                            </div>
                             
                            <div class="form-group row m-t-30">
                                
                                <div class="col-sm-12 text-center">
                                    <!-- <input class="btn btn-primary w-md waves-effect waves-light" type="submit" name="submit" value="Sign In"> -->
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Submit</button>
                                </div>
                            </div>
                            
                            <div class="form-group m-t-30 mb-0 row">
                                <div class="col-12 text-center">
                                    <a href="{{ url('/login') }}" class="text-muted"><i class="fa fa-lock "></i> Login?</a>
                                </div>
                                {{ csrf_field() }}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="m-t-40 text-center text-white-50">
                <p>Don't have an account ? <a href="pages-register.html" class="font-600 text-white">Signup Now</a></p>
                <p>© 2018 Foxia. Crafted with <i class="mdi mdi-heart text-white"></i> by Themesbrand</p>
            </div> -->
        </div>


    <!-- end wrapper-page --><!-- jQuery  -->
    <script src=" {{ asset('public/js/jquery.min.js') }}"></script>
    <script src=" {{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    <script src=" {{ asset('public/js/modernizr.min.js') }}"></script>
    <script src=" {{ asset('public/js/metisMenu.min.js') }}"></script>
    <script src=" {{ asset('public/js/jquery.slimscroll.js') }}"></script>
    <script src=" {{ asset('public/js/waves.js') }}"></script>
    <!-- App js -->
    <script src=" {{ asset('public/js/app.js') }}"></script>
    <!-- Parsley js -->
    <script src=" {{ asset('public/js/parsley.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    toastr.options = {
        "positionClass": "toast-top-center",
    };

    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
</body>
</html>