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
                                 <h4 class="page-title mb-0">Add Category</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/categories') }}">Categories</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
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
										<h4 class="mt-0 header-title">Category</h4>
										<div class="form-body">
                            <form method="post" action="addCategory" enctype="multipart/form-data" autocomplete="off"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Title</label> 
                                            <input type="text" class="form-control" required name="title" id="first_name" placeholder="Enter title"> 
                                            @error('title')
                                                <span class="error_msg">{{$title}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Description</label> 
                                            <textarea  class="form-control" required name="description" id="description"></textarea> 
                                            @error('description')
                                                <span class="error_msg">{{$description}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Icon</label> 
                                            <input type="file" class="filestyle" name="icon" accept="image/*" data-buttonname="btn-secondary" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);"  onchange="loadFile(event)">
                                            <div class="bootstrap-filestyle input-group">
                                                <input type="text" class="form-control " placeholder="" disabled=""> 
                                                <span class="group-span-filestyle input-group-append" tabindex="0">
                                                    <label for="filestyle-0" class="btn btn-secondary ">
                                                        <span class="icon-span-filestyle fa fa-folder-open"></span> 
                                                        <span class="buttonText">Choose Icon</span>
                                                    </label>
                                                </span>
                                            </div>
                                            @error('icon')
                                                <span class="error_msg">{{$icon}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img id="output"  />
                                        <script>
                                          var loadFile = function(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                              var output = document.getElementById('output');
                                              output.src = reader.result;
                                              output.height="200";
                                              output.width = "200";
                                            };
                                            reader.readAsDataURL(event.target.files[0]);
                                          };
                                        </script>
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
            <footer class="footer">© 2018 Foxia <span class="d-none d-sm-inline-block">- Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span></footer>
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here --><!-- ============================================================== -->
      </div>
      <!-- END wrapper --><!-- jQuery  -->
      <x-footer />