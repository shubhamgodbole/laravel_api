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
                                 <h4 class="page-title mb-0">Cancellation Policy</h4>
                              </div>
	                            <div class="col-md-4">
									<!--<div class="float-right ">-->
									<!--	<div class="">-->
									<!--		<a class="btn btn-primary btn-rounded " href="{{ url('/citymaster/add_city') }}" > Add New</a>-->
									<!--	</div>-->
									<!--</div>-->
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
										<h4 class="mt-0 header-title">Cancellation Policy</h4>
										<div class="">
										<table id="datatable"  class="table data_table table-bordered dt-responsive">
											<thead>
											<tr>
								  <th>#</th>
                                  <th>Title</th>
                                  <th>1 Day</th>
								  <th>15 Day</th>
                                  <th>30 Day</th>
								  <th>Actions</th>
								</tr>
											</thead>
											<tbody>
								@foreach($ploicies as  $index => $u)
									<tr>
										<th scope="row">{{  $index + 1  }}</th>
										<td>{{ $u->title }}</td>
										<td> {{ $u->day1 }}%</td>
										<td>{{ $u->day15 }}%</td>
                                        <td>{{ $u->day30 }}%</td>
										<td>

													<div class="dropdown">
													<button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions</button>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
														<a class="dropdown-item" href="cancellation_policy/edit_policy/{{$u->id}}">Edit</a> 
														<!-- <a class="dropdown-item" href="#" onclick="confirmDelete({{$u->id}})">Delete</a> 
														<a class="dropdown-item" href="#" onclick="changeActivationStatus({{$u->id}})">Change Status</a> -->
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
							</div>
							<!-- end col -->
						</div>
						<!-- end row -->
               </div>
               <!-- container-fluid -->
            </div>
            <!-- content -->
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
							url : "{{url('citymaster/delete_city')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Amenitie is deleted successfully')
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
							url : "{{url('citymaster/changeActivationStatus/')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Amenitie status is updated successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
        }
	</script>
	  <x-footer />