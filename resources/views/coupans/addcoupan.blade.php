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
                                 <h4 class="page-title mb-0">Add Coupon</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('coupans') }}">Coupons</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
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
										<h4 class="mt-0 header-title">Add Coupon</h4>
										<div class="form-body">
                                            <form method="post" action="{{ url('/coupans/addCoupan') }}" enctype="multipart/form-data" autocomplete="off"> 
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="coupan_code">Coupon Code</label> 
                                                            <input type="text" class="form-control" required name="coupan_code" id="coupan_code" placeholder="Enter coupan code"> 
                                                            @error('coupan_code')
                                                                <span style="color:red" class="help-block">{{$message}}</span>
                                                            @enderror
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Discount Persentage</label> 
                                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                                <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </span>
                                                                <input id="discount_percentage" type="text" value="0" name="discount_percentage" class="form-control">
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="minimum_transaction_amount">Minimum Transaction Amount</label> 
                                                            <input type="text" class="form-control" required name="minimum_transaction_amount" id="minimum_transaction_amount" placeholder="Enter minimum cart amount"> 
                                                            @error('minimum_transaction_amount')
                                                                <span style="color:red" class="help-block">{{$message}}</span>
                                                            @enderror
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="maximum_discount_amount">Maximum Discount Amount</label> 
                                                            <input type="text" class="form-control" required name="maximum_discount_amount" id="maximum_discount_amount" placeholder="Enter minimum cart amount"> 
                                                            @error('maximum_discount_amount')
                                                                <span style="color:red" class="help-block">{{$message}}</span>
                                                            @enderror
                                                        </div>    
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label> 
                                                            <input type="date" class="form-control datepicker" required name="start_date" id="start_date" > 
                                                            @error('start_date')
                                                                <span style="color:red" class="help-block">{{$message}}</span>
                                                            @enderror
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="end_date">End Date</label> 
                                                            <input type="date" class="form-control datepicker"  name="end_date" id="end_date" > 
                                                            @error('end_date')
                                                                <span style="color:red" class="help-block">{{$message}}</span>
                                                            @enderror
                                                        </div>    
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description">Desceription</label> 
                                                            <textarea name="description" class="form-control"></textarea>
                                                            @error('description')
                                                                <span style="color:red" class="help-block">{{$message}}</span>
                                                            @enderror
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="is_active">Status</label>
                                                            <select name="is_active" id="is_active"   class="form-control">	
                                                            <option value=1>Active</option>
                                                            <option value=0>Deactive</option>
                                                                
                                                            </select>
                                                            @error('status')
                                                                <span class="error_msg">{{$status}}</span>
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
               <!-- container-fluid -->
            </div>
            <!-- content -->
            <!-- <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer> -->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <!-- jQuery  -->
      <script type="text/javascript">
        
        </script>	
      <x-footer />