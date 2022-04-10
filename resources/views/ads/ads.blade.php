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
                                 <h4 class="page-title mb-0">Ads</h4>
                              </div>
	                            <div class="col-md-4">
									<div class="float-right ">
										<div class="">
											<a class="btn btn-primary btn-rounded " href="{{ url('/categories/add_category') }}" > Add New</a>
										</div>
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
										<h4 class="mt-0 header-title">Ads</h4>
										<div class="">
										<table id="datatable"  class="table data_table table-bordered dt-responsive">
											<thead>
											<tr>
								  <th>#</th>
                                  <th>Icon</th>
								  <th>Category</th>
                                  <th>Title</th>
								  <th>Description</th>
								  <th>Recommanded Status</th>
                                  <th>Status</th>
								  <th>Actions</th>
								</tr>
											</thead>
											<tbody>
								@foreach($ads as  $index => $u)
									<tr>
										<th scope="row">{{  $index + 1  }}</th>
										<td> <img src="{{ $u->image }}" class="img-fluid img-thumbnail" alt="" height="30" width="50"></td>
										<td>{{ $u->category['title'] }}</td>
										<td>{{ $u->title }}</td>
										<td>{{ $u->description }}</td>
										<td><p  class="{{$u->is_recommanded ? 'btn btn-sm btn-success waves-effect waves-light' : 'btn btn-sm btn-primary waves-effect waves-light' }} ">{{$u->is_recommanded ? 'Active' : 'Deactive' }}</p></td>
										<td><p  class="{{$u->is_active ? 'btn btn-sm btn-success waves-effect waves-light' : 'btn btn-sm btn-primary waves-effect waves-light' }} ">{{$u->is_active ? 'Active' : 'Deactive' }}</p></td>
										<td>
											 		<!-- <a href='users/edit_user/{{$u->id}} ' data-toggle="tooltip" title="Edit">
											 			<i class='fa fa-edit'></i>
											 		</a>&nbsp;&nbsp;
													<a href='#'  onclick="confirmDelete({{$u->id}})" data-toggle="tooltip" title="Delete"><i class='fa fa-trash'></i></a>&nbsp;&nbsp;
													<a  href='#' onclick="changeActivationStatus({{$u->id}})" data-toggle="tooltip" title="{{$u->is_active ? 'Active' : 'Deactive' }}" ><i class="{{$u->is_active ? 'fa fa-eye text-success' : 'fa fa-eye-slash text-danger' }}  "></i></a> -->
													<div class="dropdown">
													<button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions</button>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
														<a class="dropdown-item" href="ads/edit_ads/{{$u->id}}">Edit</a> 
														<a class="dropdown-item" href="#" onclick="confirmDelete({{$u->id}})">Delete</a> 
														<a class="dropdown-item" href="#" onclick="changeRecommandedStatus({{$u->id}})">Change Recommanded Status</a>
														<a class="dropdown-item" href="#" onclick="changeActivationStatus({{$u->id}})">Change Activation Status</a>
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
							url : "{{url('ads/deletAds')}}" + "/" + id,
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
		
		function changeRecommandedStatus(id) {
            swal({
                title: "Are you sure?",
                text: "You want to change it's recommanded status!!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
					if (willDelete) {
						$.ajax({
							type: "GET",
							url : "{{url('ads/changeRecommandedStatus/')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Ads status is updated successfully')
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
							url : "{{url('ads/changeActivationStatus/')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('Ads status is updated successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
        }
	</script>
	  <x-footer />