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
                                 <h4 class="page-title mb-0">PGs</h4>
                                 
                              </div>
							  	<div class="col-md-4">
									<!-- <div class="float-right ">
										<div class="">
											<a class="btn btn-primary btn-rounded " href="{{ url('/property_types/add_property_types') }}" > Add New</a>
										</div>
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
										<h4 class="mt-0 header-title">PGs</h4>
										<div class="">
										<table class="table data_table table-bordered dt-responsive">
							<thead>
								<tr>
								  <th>#</th>
								  <th>Thumbnail</th>
								  <th>PG Name</th>
								  <th>Owner Name</th>
								  <th>Status</th>
								  <th>Booking Status</th>
								  <th>Recommended</th>
								  <th>City</th>
								  <th>State</th>
								  <th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($pges as  $index => $p)
									<tr>
										<th scope="row">{{  $index + 1  }}</th>
										<td><img src="{{ count($p->pg_images) > 0 ? $p->pg_images[0]['image'] : '' }}" class="img-fluid img-thumbnail" alt="" style="height:50px;width:50px"></td>
										<td>{{ $p->pg_name }}</td>
										<td>{{ $p->pg_owner['first_name'] .' '. $p->pg_owner['last_name']}}</td>
										<!-- <td>{{ $p->is_active == 1 ? 'Active' : 'Deactive' }}</td> -->
										<td><p  class="{{$p->is_active ? 'btn btn-sm btn-success waves-effect waves-light' : 'btn btn-sm btn-primary waves-effect waves-light' }} ">{{$p->is_active ? 'Active' : 'Deactive' }}</p></td>
										<td><p  class="{{$p->is_available ? 'btn btn-sm btn-success waves-effect waves-light' : 'btn btn-sm btn-primary waves-effect waves-light' }} ">{{$p->is_available ? 'Available' : 'Booked' }}</p></td>
										<td><p  class="{{$p->is_recommended ? 'btn btn-sm btn-success waves-effect waves-light' : 'btn btn-sm btn-primary waves-effect waves-light' }} ">{{$p->is_recommended ? 'Yes' : 'No' }}</p></td>
										<td>{{ $p->address['city'] }}</td>
										<td>{{ $p->address['state'] }}</td>
										<td>
											<div class="dropdown">
												<button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions</button>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
													<a class="dropdown-item" href="pges/pg_detail/{{$p->id}}">View Detail</a> 
													<a class="dropdown-item" href="#" onclick="changeActivationStatus({{$p->id}})">Change Status</a>
													<a class="dropdown-item" href="#" onclick="changeIsRecommendedStatus({{$p->id}})">Change Recommanded Status</a>
													<a class="dropdown-item" href="pges/update_pg/{{$p->id}}">Edit PG</a> 
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
               <!-- container-fluid -->
            </div>
            <!-- content -->
            <!-- <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer> -->
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
							url : "{{url('property_types/deletPropertyType')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Property type is deleted successfully')
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
							url : "{{url('pges/changeActivationStatus')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('PG status is updated successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
        }
		function changeIsRecommendedStatus(id) {
            swal({
                title: "Are you sure?",
                text: "You want to change it's  status!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: "GET",
							url : "{{url('pges/changeIsRecommendedStatus')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('PG status is updated successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
        }
	</script>	
      <x-footer />