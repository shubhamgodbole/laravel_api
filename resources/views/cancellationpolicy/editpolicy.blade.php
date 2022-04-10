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
                                 <h4 class="page-title mb-0">Update Cancellation Policy</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/citymaster') }}">Cancellation Policy</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Cancellation Policy</li>
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
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<h4 class="mt-0 header-title">Cancellation Policy</h4>
										<div class="form-body">
                            <form method="post" action="{{ url('/cancellation_policy/update_policy') }}" enctype="multipart/form-data" autocomplete="off"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="hidden"  value="{{ $edit_data->id }}" name="id"> 
                                            <input type="text" class="form-control" value="{{ $edit_data->title }}" required name="title" id="title" placeholder="Enter city name"> 
                                            @error('title')
                                                <span class="error_msg">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">1 Day</label> 
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </span>
                                                <input id="day1" data-parsley-type="number" type="text" value="{{ $edit_data->day1 }}" name="day1" class="form-control">
                                            </div>
                                            @error('day1')
                                                <span class="error_msg">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">15 Day</label> 
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </span>
                                                <input id="day15" data-parsley-type="number" type="text" value="{{ $edit_data->day15 }}" name="day15" class="form-control">
                                            </div>
                                            @error('day15')
                                                <span class="error_msg">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">30 Day</label> 
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </span>
                                                <input id="day30" data-parsley-type="number" type="text" value="{{ $edit_data->day30 }}" name="day30" class="form-control">
                                            </div>
                                            @error('day30')
                                                <span class="error_msg">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                <!-- <button type="reset" class="btn btn-secondary waves-effect waves-light">Reset</button>  -->
                            </form> 
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
            <!-- <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer> -->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper --><!-- jQuery  -->
      <x-footer />