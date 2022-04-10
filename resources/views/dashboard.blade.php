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
                                 <h4 class="page-title mb-0">Dashboard</h4>
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
                     <div class="col-xl-3 col-md-6">
                        <div class="card mini-stats">
                           <div class="p-3 mini-stats-content">
                              <div class="mb-4">
                                 <div class="float-right text-right">
                                    <span class="badge badge-light text-info mt-2 mb-2">{{ $dashboard_data['total_owners'] }}</span>
                                    <p class="text-white-50">Total PG Owners</p>
                                 </div>
                                 <!-- <span class="peity-pie" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"]}' data-width="54" data-height="54">5/8</span> -->
                                 <span  style="font-size: 2em;color:#FFF"><i class="fa fa-user"></i></span>
                              </div>
                           </div>
                           <!-- <div class="ml-3 mr-3">
                              <div class="bg-white p-3 mini-stats-desc rounded">
                                 <h5 class="float-right mt-0">1758</h5>
                                 <h6 class="mt-0 mb-3">Orders</h6>
                                 <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                              </div>
                           </div> -->
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6">
                        <div class="card mini-stats">
                           <div class="p-3 mini-stats-content">
                              <div class="mb-4">
                                 <div class="float-right text-right">
                                    <span class="badge badge-light text-danger mt-2 mb-2">{{ $dashboard_data['total_tenants'] }}</span>
                                    <p class="text-white-50">Total Tenants</p>
                                 </div>
                                 <!-- <span class="peity-donut" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"], "innerRadius": 18, "radius": 32 }' data-width="54" data-height="54">2/5</span> -->
                                 <span style="font-size: 2em;color:#FFF"><i class="fa fa-user"></i></span>
                              </div>
                           </div>
                           <!-- <div class="ml-3 mr-3">
                              <div class="bg-white p-3 mini-stats-desc rounded">
                                 <h5 class="float-right mt-0">48259</h5>
                                 <h6 class="mt-0 mb-3">Revenue</h6>
                                 <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                              </div>
                           </div> -->
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6">
                        <div class="card mini-stats">
                           <div class="p-3 mini-stats-content">
                              <div class="mb-4">
                                 <div class="float-right text-right">
                                    <span class="badge badge-light text-primary mt-2 mb-2">{{ $dashboard_data['total_pgs'] }}</span>
                                    <p class="text-white-50">Total PGs</p>
                                 </div>
                                 <!-- <span class="peity-pie" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"]}' data-width="54" data-height="54">3/8</span> -->
                                 <span style="font-size: 2em;color:#FFF"><i class="fa fa-building"></i></span>
                              </div>
                           </div>
                           <!-- <div class="ml-3 mr-3">
                              <div class="bg-white p-3 mini-stats-desc rounded">
                                 <h5 class="float-right mt-0">$17.5</h5>
                                 <h6 class="mt-0 mb-3">Average Price</h6>
                                 <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                              </div>
                           </div> -->
                        </div>
                     </div>
                     <div class="col-xl-3 col-md-6">
                        <div class="card mini-stats">
                           <div class="p-3 mini-stats-content">
                              <div class="mb-4">
                                 <div class="float-right text-right">
                                    <span class="badge badge-light text-info mt-2 mb-2">{{ $dashboard_data['total_booking'] }}</span>
                                    <p class="text-white-50">Total Booekd PGs</p>
                                 </div>
                                 <!-- <span class="peity-donut" data-peity='{ "fill": ["rgba(255, 255, 255, 0.8)", "rgba(255, 255, 255, 0.2)"], "innerRadius": 18, "radius": 32 }' data-width="54" data-height="54">3/5</span> -->
                                 <span style="font-size: 2em;color:#FFF"><i class="fa fa-credit-card-alt"></i></span>
                              </div>
                           </div>
                           <!-- <div class="ml-3 mr-3">
                              <div class="bg-white p-3 mini-stats-desc rounded">
                                 <h5 class="float-right mt-0">2048</h5>
                                 <h6 class="mt-0 mb-3">Product Sold</h6>
                                 <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                              </div> -->
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- end row -->
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card">
                           <div class="card-body">
                              <h4 class="mt-0 header-title">Latest Booked PGs</h4>
                              <div class="table-responsive mt-4">
                                 <table class="table table-hover mb-0">
                                    <thead>
                                       <tr>
                                       <th>#</th>
                                  <th>Tenant Name</th>
								  <th>PG Name</th>
								  <th>From Date</th>
                                  <th>To Date</th>
                                       
                                       </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dashboard_data['letest_booking'] as  $index => $u)
                                       <tr>
                                          <th scope="row">{{  $index + 1  }}</th>
                                          <td>{{ $u['tenantDetail']['first_name'].' '.$u['tenantDetail']['last_name'] }}</td>
                                          <td>{{ $u['pgDetail']['pg_name'] }}</td>
                                                   <td>{{ $u->from_date }}</td>
                                                   <td>{{ $u->to_date }}</td>
                                       
                                       </tr>
                                    @endforeach

                                    </tbody>
                                 </table>
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
            <!--<footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer>-->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper --><!-- jQuery  -->
      <x-footer />