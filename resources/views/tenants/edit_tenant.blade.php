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
                                 <h4 class="page-title mb-0">Update Tenant</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('tenants') }}">Tenants</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Tenant</li>
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
										<h4 class="mt-0 header-title">Tenant</h4>
										<div class="form-body">
                            <form method="post" action="{{ url('users/updateUser') }}" enctype="multipart/form-data" autocomplete="off"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label> 
                                            <input type="hidden"  value="{{ $edit_data->id }}" name="id">
                                            <input type="text" class="form-control" value="{{ $edit_data->first_name }}" required name="first_name" id="first_name" placeholder="Enter first name"> 
                                            @error('first_name')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label> 
                                            <input type="text" class="form-control" required name="last_name" value="{{ $edit_data->last_name }}" id="last_name" placeholder="Enter last name"> 
                                            @error('last_name')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Name</label> 
                                            <input type="email" class="form-control" value="{{ $edit_data->email }}" name="email" id="email" placeholder="Enter email"> 
                                            @error('email')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label> 
                                            <input type="number" class="form-control" value="{{ $edit_data->mobile }}" required name="mobile" id="mobile" placeholder="Enter mobile number"> 
                                            @error('mobile')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="radio">Gender</label><br/> 
                                            <div class="row">
                                            <div class="radio-inline col-md-2"><label><input type="radio" name="gender" {{ $edit_data->gender == 'male' ? 'checked' : '' }}  value="male" checked> Male</label></div>
    										<div class="radio-inline col-md-3"><label><input type="radio" name="gender" {{ $edit_data->gender == 'female' ? 'checked' : '' }} value="female"> Female</label></div> 
                                            </div> 
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" id="user_type"   class="form-control">			
                                                <option value=3>Tanent</option>
                                                
                                            </select>
                                            @error('user_type')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="address">
                                <label for="exampleInputFile" style="margin-left:17px">Address</label> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ $edit_data->line1 }}" required name="line1" id="line1" placeholder="Address line 1">  
                                                @error('line1')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ $edit_data->line2 }}"  name="line2" id="line2" placeholder="Address line 2">  
                                                @error('line2')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror    
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  value="{{ $edit_data->city }}" name="city" id="city" placeholder="City">  
                                                @error('city')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ $edit_data->taluka }}"  name="taluka" id="taluka" placeholder="Taluka">  
                                                @error('taluka')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror   
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" maxlength="6" class="form-control" value="{{ $edit_data->pincode }}" required name="pincode" id="pincode" onChange="changePindoe(this.value)" placeholder="Pin code">  
                                                @error('pincode')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ $edit_data->district }}" required name="district" id="district"  placeholder="District">  
                                                @error('district')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="{{ $edit_data->state }}" required name="state" id="state"  placeholder="State">  
                                                @error('state')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="dob">DOB</label> 
                                            <input type="date" class="form-control" value="{{ $edit_data->dob }}" required name="dob" id="dob" placeholder="Enter mobile number"> 
                                            @error('dob')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                        <!-- <div class="form-group">
                                            <label>Profile</label> 
                                            <input type="file" class="filestyle" name="profile" accept="image/*" data-buttonname="btn-secondary" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                            <div class="bootstrap-filestyle input-group">
                                                <input type="text" class="form-control " placeholder="" disabled=""> 
                                                <span class="group-span-filestyle input-group-append" tabindex="0">
                                                    <label for="filestyle-0" class="btn btn-secondary ">
                                                        <span class="icon-span-filestyle fa fa-folder-open"></span> 
                                                        <span class="buttonText">Choose file</span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div> -->
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
            <!-- <footer class="footer">?? 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer> -->
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper --><!-- jQuery  -->
      <x-footer />