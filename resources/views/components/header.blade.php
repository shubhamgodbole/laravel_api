@if(!session('user'))
<script>window.location = "login";</script>
@endif
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<title>PayPG</title>
        <!-- App Icons -->
        <link rel="shortcut icon" href=" {{ asset('public/images/favicon1.ico') }}">
        

        
         <!-- Basic Css files -->
         <link href=" {{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('public/css/morris.css') }}" rel="stylesheet" type="text/css">
        <!-- font-awesome icons CSS -->
        <link href=" {{ asset('public/css/font-awesome.css') }}" rel="stylesheet"> 
        <!-- //font-awesome icons CSS-->
<!--//Metis Menu -->
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
.desc1-right h3 {
    text-shadow: 0 1px 0 #ffffff;
    color: #1e272e;
    font-size: 1.1em;
    margin-bottom: 15px;
}
.desc1-right h5 {
    font-size: 1.3em;
    color: #62676b;
    line-height: 1.5em;
    -webkit-text-stroke: 0.2px;
    font-weight: 400;
}
.error_msg {
    font-size: 12px;
    color: #e2595f;
    margin-top: 5px;
}
.fliph { display: none; }

</style>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href=" {{ asset('public/css/toastr.css') }}">

    <!-- Data Table -->
    <link href=" {{ asset('public/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('public/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('public/js/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea',
        menubar: false,
      });
    </script>
<script>
    
    $(document).ready(function() {
        alert();
        const $valueSpan = $('.valueSpan2');
        const $value = $('#customRange11');
        $valueSpan.html($value.val());
        $value.on('input change', () => {

        $valueSpan.html($value.val());
        });
    });
    </script>
</head> 