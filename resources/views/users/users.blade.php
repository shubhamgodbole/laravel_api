<x-header />
<body class="fixed-left ">
	<!-- Loader -->
	<!-- <div id="preloader">
		<div id="status">
			<div class="spinner"></div>
		</div>
	</div> -->
	<div class="wrapper">
		<!-- header-starts -->
		<x-topbar />
		<!-- //header-ends -->

		<!--left-fixed -navigation-->
        <x-sidebar />
        <!--left-fixed -navigation-end-->

		<!-- main content start-->
		<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12">
								<div class="page-title-box">
									<div class="row align-items-center">
										<div class="col-md-8">
											<h4 class="page-title mb-0">Dashboard</h4>
											<ol class="breadcrumb m-0">
												<li class="breadcrumb-item"><a href="#">Foxia</a></li>
												<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
											</ol>
										</div>
										<div class="col-md-4">
											<div class="float-right d-none d-md-block">
												<div class="dropdown">
													<button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-settings mr-1"></i> Settings</button>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
														<a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" href="#">Separated link</a>
													</div>
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
										<h4 class="mt-0 header-title">Default Datatable</h4>
										<table id="datatable" style="width:100%" class="table data_table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
											<thead>
											<tr>
								  <th>#</th>
								  <th>First Name</th>
								  <th>Last Name</th>
								  <th>Email</th>
								  <th>Phone</th>
								  <th>User Type</th>
								  <th>Pincode</th>
								  <th>District</th>
								  <th>State</th>
								  <th>Actions</th>
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
										<td>{{ $u->user_type == 2 ? 'Pg Owner' : 'Tanant' }}</td>
										<td>{{ $u->address['pincode'] }}</td>
										<td>{{ $u->address['district'] }}</td>
										<td>{{ $u->address['state'] }}</td>
										<td>
											 		<a href='users/edit_user/{{$u->id}} ' data-toggle="tooltip" title="Edit">
											 			<i class='fa fa-edit'></i>
											 		</a>&nbsp;&nbsp;
													<a href='#'  onclick="confirmDelete({{$u->id}})" data-toggle="tooltip" title="Delete"><i class='fa fa-trash'></i></a>&nbsp;&nbsp;
													<a  href='#' onclick="changeActivationStatus({{$u->id}})" data-toggle="tooltip" title="{{$u->is_active ? 'Active' : 'Deactive' }}" ><i class="{{$u->is_active ? 'fa fa-eye text-success' : 'fa fa-eye-slash text-danger' }}  "></i></a>
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
						<!-- end row -->
						<!-- end row -->
					</div>
					<!-- container-fluid -->
				</div>
				<!-- content -->
				<footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer>
			</div>
			<!-- ============================================================== --><!-- End Right content here -->
		
	</div>
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
<script>
// $(document).ready(function() {
//     // Setup - add a text input to each footer cell
//     $('.data_table thead tr').clone(true).appendTo( '.data_table thead' );
//     $('.data_table thead tr:eq(1) th').each( function (i) {
//         var title = $(this).text();
// 		if(title!= '#' && title!= 'Actions') {
// 			$(this).html( '<input type="text" placeholder="Search.." style=width:100px />' );
	
// 			$( 'input', this ).on( 'keyup change', function () {
// 				if ( table.column(i).search() !== this.value ) {
// 					table
// 						.column(i)
// 						.search( this.value )
// 						.draw();
// 				}
// 			} );

// 		}
// 		else {
// 			false
// 		}
//     } );
	
//     var table = $('.data_table').DataTable( {
        
//     } );
// } );
</script>
<script>
$(document).ready(function (){
	var table = $('.data_table').DataTable({
		
    //    dom: 'lr<"table-filter-container">tip',
    //    initComplete: function(settings){
    //       var api = new $.fn.dataTable.Api( settings );
    //     //   $('.table-filter-container', api.table().container()).before(
    //     //      $('#table-filter').detach().show()
	// 	//   );

          
        //   $('#table-filter select').on('change', function(){
        //      table.search(this.value).draw();   
		//   });      
	// 	   $('#searchByName').keyup(function(){
	// 		table.search(this.value).draw();      
	// 		}); 
    //    }
    });
	// $('.dataTables_filter').before($('#table-filter'));
	// $('#table-filter select').on('change', function(){
    //          table.search(this.value).draw();   
	// 	  });      
});
</script>		
<x-footer />