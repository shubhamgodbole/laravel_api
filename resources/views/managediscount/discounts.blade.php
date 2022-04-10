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
                                 <h4 class="page-title mb-0">Manage PG Discounts</h4>
                                 
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
										<h4 class="mt-0 header-title">Manage PG Discounts</h4>
										<div class="">
										<table id="datatable"  class="table data_table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
											<thead>
											<tr>
								  <th>#</th>
                                  <th>PG Name</th>
								  <th>Discount</th>
								  <th>Actions</th>
								</tr>
											</thead>
											<tbody>
								@foreach($discountDetail as  $index => $u)
									<tr>
										<th scope="row">{{  $index + 1  }}</th>
										<td>{{ $u->pg_name }}</td>
										<td>{{ $u['pg_pricing']['discount'] }}</td>
										<td>
													<div class="dropdown">
													<button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions</button>
													<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
														<a class="dropdown-item" href="discounts/edit_discount/{{$u->id}}">Edit</a> 
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
            <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer>
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper -->

      <x-footer />