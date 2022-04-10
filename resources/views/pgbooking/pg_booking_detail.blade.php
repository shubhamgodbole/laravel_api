<x-header />
   <body class="fixed-left">
      <!-- Loader -->
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      <!-- Begin page -->
      <div id="wrapper">
         <!-- Top Bar Start -->
         <x-topbar />
         <!-- Top Bar End -->
         <!-- ========== Left Sidebar Start ========== -->
         <x-sidebar />
         <!-- Left Sidebar End -->
         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="content-page">
            <!-- Start content -->
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="page-title-box">
                           <div class="row align-items-center">
                              <div class="col-md-8">
                                 <h4 class="page-title mb-0">PG Booking Detail</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/pg_bookings') }}">PG Bookings</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">PG Booking Detail</li>
                                 </ol>
                              </div>
								<div class="col-md-4">
									<div class="float-right ">
										<!-- <div class="">
											<a class="btn btn-primary btn-rounded " href="{{ url('/room_types/add_room_types') }}" > Add New</a>
										</div> -->
									</div>
								</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<h4 class="mt-0 header-title">PG Booking Detail</h4>
                                        <table class="table table-hover">
                                            <tr>
                                                <th><strong class="error_msg">Tenant Name</strong></th>
                                                <td>{{ $pg_booking_datail['tenantDetail']['first_name'].' '.$pg_booking_datail['tenantDetail']['last_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">PG Name</strong></th>
                                                <td>{{ $pg_booking_datail['pgDetail']['pg_name'].' '.$pg_booking_datail['pgDetail']['pg_name'] }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Booking Date</strong></th>
                                                <td>{{ $pg_booking_datail->from_date.' To '.$pg_booking_datail->to_date }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Extra Guest</strong></th>
                                                <td>{{ $pg_booking_datail->extra_guest }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Booking Price</strong></th>
                                                <td>{{ $pg_booking_datail->booking_price }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Security Deposit</strong></th>
                                                <td>{{ $pg_booking_datail->security_deposit }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">City Fee</strong></th>
                                                <td>{{ $pg_booking_datail->city_fee }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Cleaning Fee</strong></th>
                                                <td>{{ $pg_booking_datail->cleaning_fee }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Tax</strong></th>
                                                <td>{{ $pg_booking_datail->booking_tax }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Extra Guest</strong></th>
                                                <td>{{ $pg_booking_datail->extra_guest }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Extra Guest Fee</strong></th>
                                                <td>{{ $pg_booking_datail->extra_guest_fee }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Discount</strong></th>
                                                <td>{{ $pg_booking_datail->discount }}%</td>
                                            </tr>
                                            <tr>
                                                <th><strong class="error_msg">Total Amount</strong></th>
                                                <td>{{ $pg_booking_datail->total_amount }}</td>
                                            </tr>
                                        </table>
									</div>
								</div>
							</div>
							<!-- end col -->
                  
                  
               </div>
               <!-- container-fluid -->
            </div>
            <!-- content -->
            <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer>
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
	  <!-- jQuery  -->
	  <script type="text/javascript">
  		function confirmDelete(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover it!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: "GET",
							url : "{{url('/room_types/deletRoomType')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Room type is deleted successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
		}
		
		function changeActivationStatus(id) {
            swal({
                title: "Are you sure?",
                text: "You want to change it's activation status!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: "GET",
							url : "{{url('room_types/changeActivationStatus/')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Room type status is updated successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
        }
	</script>	
      <x-footer />