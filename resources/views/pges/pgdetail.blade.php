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
                                 <h4 class="page-title mb-0">PG Detail</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/pges') }}">PGs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">PG Detail</li>
                                 </ol>
                              </div>
                              <div class="col-md-4">
                                 <div class="float-right d-none d-md-block">
                                    <!-- <div class="dropdown">
                                       <button class="btn btn-primary btn-rounded dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-settings mr-1"></i> Settings</button>
                                       <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                          <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">Separated link</a>
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
				  <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                              <h4 class="mt-0 header-title">PG Detail</h4>
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs" role="tablist">
                                 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="d-none d-md-block">PG Detail</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span></a></li>
                                 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="d-none d-md-block">Amenities</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span></a></li>
                                 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="d-none d-md-block">Pricing Detail</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span></a></li>
                                 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab"><span class="d-none d-md-block">PG Images</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
                                 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#owner" role="tab"><span class="d-none d-md-block">Owner Detail</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span></a></li>
                              </ul>
                              <!-- Tab panes -->
                              <div class="tab-content">
                                 <div class="tab-pane active p-3" id="home" role="tabpanel">
                                    <table class="table table-hover">
                                       <tr>
                                          <th> <strong class="error_msg">PG Name</strong> </th>
                                          <td> {{ $pgdetail['pg_name'] }} </td>
                                          <th> <strong class="error_msg">PG Type</strong> </th>
                                          <td> {{ $pgdetail['property_type'] }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Address</strong> </th>
                                          <td> {{ $pgdetail['address']['line1'].' '. $pgdetail['address']['line2'].' '. $pgdetail['address']['city'].', '.  $pgdetail['address']['state'].', '.  $pgdetail['address']['country'] }} </td>
                                          <th> <strong class="error_msg">Room Type</strong> </th>
                                          <td> {{ $pgdetail['pg_room_type'] }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Food Available</strong> </th>
                                          <td> {{ $pgdetail['is_fooding_available'] }} </td>
                                          <th> <strong class="error_msg">Luxry Type</strong> </th>
                                          <td> {{ $pgdetail['luxry_type'] }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Guest</strong> </th>
                                          <td> {{ $pgdetail['guests'] ? $pgdetail['guests'] : '-' }} </td>
                                          <th> <strong class="error_msg">Bathroom</strong> </th>
                                          <td> {{ $pgdetail['bathroom'] ? $pgdetail['bathroom'] : '-' }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Bedroom</strong> </th>
                                          <td> {{ $pgdetail['bedroom'] ? $pgdetail['bedroom'] : '-' }} </td>
                                          <th> <strong class="error_msg">Beds</strong> </th>
                                          <td> {{ $pgdetail['beds'] ? $pgdetail['beds'] : '-' }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Size</strong> </th>
                                          <td> {{ $pgdetail['size'] ? $pgdetail['size'] . ' Square Feet' : '-' }} </td>
                                          <th> </th>
                                          <td>  </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Description</strong> </th>
                                          <td> {{ $pgdetail['description'] ? $pgdetail['description'] : '-' }} </td>
                                          <th> <strong class="error_msg">Other Details</strong> </th>
                                          <td> {{ $pgdetail['other_details'] ? $pgdetail['other_details'] : '-' }} </td>
                                       </tr>
                                    </table>
                                 </div>
                                 <div class="tab-pane p-3" id="profile" role="tabpanel">
                                    
                                    <table class="table table-hover table-sm">
                                       @foreach($pgdetail['pg_amenities'] as  $index => $p)
                                          <!-- <li><img src="{{ $p['icon'] }}" class="img-fluid img-thumbnail" alt="" height="30" width="50"> {{   $p['name'] }}</li> -->

                                          <tr>
					               					<td> <img src="{{ $p['icon'] }}" class="img-fluid img-thumbnail" alt="" height="30" width="50"></td>
               										<td>{{ $p['name'] }}</td>
                                             <td> {{ $p['description'] ? $p['description'] : '-' }} </td>
               									</tr>
                                       @endforeach
                                    </table>
                                 </div>
                                 <div class="tab-pane p-3" id="messages" role="tabpanel">
                                    <table class="table table-hover">
                                       <tr>
                                          <th> <strong class="error_msg">Per Month</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['per_month'] ? '₹ '. $pgdetail['pg_pricing']['per_month'] : '-' }} </td>
                                          <th> <strong class="error_msg">Security Deposit</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['security_deposit'] ? '₹ '. $pgdetail['pg_pricing']['security_deposit'] : '-' }} </td>
                                       </tr>
                                       
                                       <tr>
                                          <th> <strong class="error_msg">Cleaning Fee</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['cleaning_fee'] ? $pgdetail['pg_pricing']['cleaning_fee'] : '-' }} </td>
                                          <th> <strong class="error_msg">Minimum Stay Month</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['minimum_stay_month'] ?  $pgdetail['pg_pricing']['minimum_stay_month'] : '-' }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Check In</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['check_in'] ? $pgdetail['pg_pricing']['check_in'] : '-' }} </td>
                                          <th> <strong class="error_msg">Check Out</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['check_out'] ?  $pgdetail['pg_pricing']['check_out']  : '-' }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Cancellation Charge</strong> </th>
                                          <td> {{ $pgdetail['pg_pricing']['cancellation_charge'] ? '₹ '. $pgdetail['pg_pricing']['cancellation_charge'] : '-' }} </td>
                                          <th>  </th>
                                          <td> </td>
                                       </tr> 
                                    </table>
                                 </div>
                                 <div class="tab-pane p-3" id="settings" role="tabpanel">
                                    <div class="row">
                                       @foreach($pgdetail['pg_images'] as  $index => $p)
                                          <div class="col-md-3" >
                                          <img src="{{ $p['image'] }}" class="img-fluid img-thumbnail" alt="" style="height:300px;width:300px" >
                                          </div>
                                       @endforeach
                                    </div>
                                 </div>
                                 <div class="tab-pane p-3" id="owner" role="tabpanel">
                                 <table class="table table-hover">
                                       <tr>
                                          <th> <strong class="error_msg">Profile</strong> </th>
                                          <td>  <img src="{{ $pgdetail['pg_owner']['profile'] }}" class="img-fluid img-thumbnail" alt="" height="30" width="50" >  </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Owner Name</strong> </th>
                                          <td> {{ $pgdetail['pg_owner']['name'] }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Eamil ID</strong> </th>
                                          <td> {{  $pgdetail['pg_owner']['email']  }} </td>
                                       </tr>
                                       <tr>
                                          <th> <strong class="error_msg">Contact Number</strong> </th>
                                          <td> {{ $pgdetail['pg_owner']['mobile'] }} </td>
                                       </tr>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
				  </div>
                  	<!-- end row -->
               </div>
               <!-- container-fluid -->
            </div>
            <!-- content -->
            <!-- <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer> -->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper --><!-- jQuery  -->
      <x-footer />