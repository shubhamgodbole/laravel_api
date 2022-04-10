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
    </script><script>$(document).ready(function() {
                $('form').parsley();
            });</script>


<script>
//         $(document).ready(function(){
//    $('.button-menu-mobile').click(function(){
//         $('.left').toggleClass('fliph');
//         $('.topbar-left').toggleClass('fliph');
//    });
     
// });
        </script>

	<!--//validator js-->
    <script src=" {{ asset('public/js/toastr.js') }}"></script>
    
    <!--//DataTable js-->
    <script src=" {{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <script src=" {{ asset('public/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src=" {{ asset('public/js/dataTables.buttons.min.js') }}"></script>
    <script src=" {{ asset('public/js/buttons.bootstrap4.min.js') }}"></script>
    <script src=" {{ asset('public/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.data_table').DataTable();
        $('[data-toggle="tooltip"]').tooltip();   
    } );
    </script>
    <script>
    
    $(document).ready(function() {
        const $valueSpan = $('.valueSpan2');
        const $value = $('#customRange11');
        $valueSpan.html($value.val());
        $value.on('input change', () => {

        $valueSpan.html($value.val());
        });
    });
    </script>
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