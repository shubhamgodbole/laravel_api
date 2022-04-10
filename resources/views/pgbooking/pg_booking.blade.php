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
                                 <h4 class="page-title mb-0">PG Bookings</h4>
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
										<h4 class="mt-0 header-title">PG Bookings</h4>
										<table id="datatable" class="table data_table table-bordered dt-responsive">
											<thead>
											<tr>
								  <th>#</th>
                                  <th>Tenant Name</th>
								  <th>PG Name</th>
								  <th>From Date</th>
                                  <th>To Date</th>
                                  <th>Action</th>
								</tr>
											</thead>
											<tbody>
								@foreach($pg_booking_datail as  $index => $u)
									<tr>
										<th scope="row">{{  $index + 1  }}</th>
										<td>{{ $u['tenantDetail']['first_name'].' '.$u['tenantDetail']['last_name'] }}</td>
										<td>{{ $u['pgDetail']['pg_name'] }}</td>
                                        <td>{{ $u->from_date }}</td>
                                        <td>{{ $u->to_date }}</td>
										<td>
											
													<div class="dropdown">
													<button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions</button>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
														<a class="dropdown-item" href="pg_bookings/pg_booking_detail/{{$u->id}}">View Detail</a> 
													</div>
												</div>
											 	</td>
									</tr>
								@endforeach
							</tbody>
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