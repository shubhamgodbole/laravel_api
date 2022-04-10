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
                                 <h4 class="page-title mb-0">Admin Users</h4>
                              </div>
                              <div class="col-md-4">
									<!-- <div class="float-right ">
										<div class="">
											<a class="btn btn-primary btn-rounded " href="{{ url('/pg_owners/add_owner') }}" > Add New</a>
										</div>
									</div> -->
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
										<h4 class="mt-0 header-title">Admin Users</h4>
										<table id="datatable"  class="table  data_table table-bordered dt-responsive" >
											<thead>
											<tr>
								  <th>#</th>
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Email</th>
								  <th>Phone</th>
								  <th>Status</th>
								  
								</tr>
											</thead>
											<tbody>
								@foreach($users as  $index => $u)
									<tr>
										<th scope="row">{{  $index + 1  }}</th>
										<td>{{ $u->first_name }}</td>
										<td>{{ $u->last_name }}</td>
										<td>{{ $u->email }}</td>
										<td>{{ $u->mobile }}</td>
										<td><p  class="{{$u->is_active ? 'btn btn-sm btn-success waves-effect waves-light' : 'btn btn-sm btn-primary waves-effect waves-light' }} ">{{$u->is_active ? 'Active' : 'Deactive' }}</p></td>
								
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
            <!--<footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer>-->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->
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
							url : "{{url('users/deleteUser')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('User is deleted successfully')
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
							url : "{{url('users/changeActivationStatus/')}}" + "/" + id,
							success: function (data) {
								if(data) {
									//swal("Deleted Successfully");
									toastr.options = {
										"positionClass": "toast-top-center",
									};
									toastr.success('User status is updated successfully')
									window.location.reload();
								}
							}         
						});

                    }
                });
        }
</script>			
      <x-footer />