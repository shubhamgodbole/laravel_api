<x-header />
<style>
.img_container {
  position: relative;
  width: 50%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.img_middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.img_container:hover .image {
  opacity: 0.3;
}

.img_container:hover .img_middle {
  opacity: 1;
}

.text {
  background-color: #4CAF50;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}
</style>
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
                                 <h4 class="page-title mb-0">Edit PG Detail</h4>
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ url('/pges') }}">PGs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit PG Detail</li>
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
                              <h4 class="mt-0 header-title">Edit PG Detail</h4>
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
                                    <form method="post" action=" {{ url('pges/update_pg_detail') }}" enctype="multipart/form-data" autocomplete="off"> 
                                        <table class="table table-hover">
                                            <tr>
                                                <th> <strong class="error_msg">PG Name</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['pg_name'] }}</span>  -->
                                                    <div class="form-group edit_box">
                                                        <input type="hidden"  value="{{ $pgdetail['id'] }}" name="id">
                                                        <input type="text" class="form-control" value="{{$pgdetail['pg_name']}}" required name="pg_name" id="pg_name" placeholder="Enter pg name"> 
                                                        @error('pg_name')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <th> <strong class="error_msg">PG Type</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['property_type'] }}</span>   -->
                                                    <div class="form-group edit_box">
                                                        <select name="property_type_id" id="property_type_id"   class="form-control">	
                                                            @foreach ($pgdetail['propertyTypes'] as $type)
                                                                <option value="{{$type->id}}" {{ $pgdetail['property_type'] == $type->name ? 'selected' : ''}} >{{$type->name}}</option>
                                                            @endforeach                  
                                                        </select>
                                                        @error('property_type_id')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> <strong class="error_msg">Address</strong> </th>
                                                <td> {{ $pgdetail['address']['line1'].' '. $pgdetail['address']['line2'].' '. $pgdetail['address']['city'].', '.  $pgdetail['address']['state'].', '.  $pgdetail['address']['country'] }} </td>
                                                <th> <strong class="error_msg">Room Type</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['pg_room_type'] }} </span> -->
                                                    <div class="form-group edit_box">
                                                        <select name="room_type_id" id="room_type_id"   class="form-control">	
                                                            @foreach ($pgdetail['roomTypes'] as $type)
                                                                <option value="{{$type->id}}" {{ $pgdetail['property_type'] == $type->name ? 'selected' : ''}} >{{$type->name}}</option>
                                                            @endforeach                  
                                                        </select>
                                                        @error('room_type_id')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> <strong class="error_msg">Food Available</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['is_fooding_available'] }}</span>  -->
                                                    <div class="form-group edit_box">
                                                        <select name="is_fooding_available" id="is_fooding_available"   class="form-control">	
                                                            <option value=1 {{ $pgdetail['is_fooding_available'] == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value=0 {{ $pgdetail['is_fooding_available'] == 'No' ? 'selected' : '' }}>No</option>
                                                                                
                                                        </select>
                                                        @error('is_fooding_available')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <th> <strong class="error_msg">Luxry Type</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['luxry_type'] }} </span> -->
                                                    <div class="form-group edit_box">
                                                        <select name="luxry_type" id="luxry_type"   class="form-control">	
                                                            @foreach ($pgdetail['luxry_types'] as $key => $value)
                                                                <option value={{$key}} {{ $pgdetail['luxry_type'] == $value ? 'selected' : ''}} >{{$value}}</option>
                                                            @endforeach  
                                                        </select>
                                                        @error('is_fooding_available')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> <strong class="error_msg">Guest</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['guests'] ? $pgdetail['guests'] : '-' }} </span>  -->
                                                    <div class="form-group edit_box">
                                                        <input type="text" data-parsley-type="number" class="form-control" required name="guests" value="{{$pgdetail['guests']}}" id="guests" placeholder="Enter number of guests"> 
                                                        @error('guests')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div> 
                                                </td>
                                                <th> <strong class="error_msg">Bathroom</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['bathroom'] ? $pgdetail['bathroom'] : '-' }}</span> -->
                                                    <div class="form-group edit_box">
                                                        <input type="text" data-parsley-type="number" class="form-control" required name="bathroom" value="{{$pgdetail['bathroom']}}" id="bathroom" placeholder="Enter number of bathroom"> 
                                                        @error('bathroom')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> <strong class="error_msg">Bedroom</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['bedroom'] ? $pgdetail['bedroom'] : '-' }}</span> -->
                                                    <div class="form-group edit_box">
                                                        <input type="text" data-parsley-type="number" class="form-control" required name="bedroom" value="{{$pgdetail['bedroom']}}" id="bedroom" placeholder="Enter number of bedroom"> 
                                                        @error('bedroom')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <th> <strong class="error_msg">Beds</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['beds'] ? $pgdetail['beds'] : '-' }}</span> -->
                                                    <div class="form-group edit_box">
                                                        <input type="text" data-parsley-type="number" class="form-control" required name="beds" id="beds" value="{{$pgdetail['beds'] }}" placeholder="Enter number of beds"> 
                                                        @error('beds')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>   
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> <strong class="error_msg">Size</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['size'] ? $pgdetail['size'] . ' Square Feet' : '-' }} </span> -->
                                                    <div class="form-group edit_box">
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                                <span class="input-group-text">Square feets</span>
                                                            </span>
                                                            <input id="size" data-parsley-type="number" type="text" value="{{ $pgdetail['size'] }}" name="size" class="form-control">
                                                        </div> 
                                                        @error('size')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <th> </th>
                                                <td>  </td>
                                            </tr>
                                            
                                            <tr>
                                                <th> <strong class="error_msg">Description</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['description'] ? $pgdetail['description'] : '-' }}</span> -->
                                                    <div class="form-group edit_box">
                                                        <textarea name="description" id="description"   class="form-control">{{$pgdetail['description']}}</textarea> 
                                                        @error('description')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div> 
                                                </td>
                                                <th> <strong class="error_msg">Other Details</strong> </th>
                                                <td> 
                                                    <!-- <span class="pg_basic_data">{{ $pgdetail['other_details'] ? $pgdetail['other_details'] : '-' }} </span> -->
                                                    <div class="form-group">
                                                        <textarea name="other_details" id="other_details"   class="form-control">{{ $pgdetail['other_details'] }}</textarea> 
                                                        @error('other_details')
                                                            <span class="error_msg">{{$message}}</span>
                                                        @enderror
                                                    </div> 
                                                </td>
                                            </tr>
                                        </table>
                                        {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary waves-effect waves-light" style="float: right;">Update</button>
                                    </form>
                                 </div>
                                 <div class="tab-pane p-3" id="profile" role="tabpanel">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-center" style="float: right;">Add New</button>
                                    <br /><br /><br />
                                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title mt-0">Add New Amenity</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                             </div>
                                             <div class="modal-body">
                                                <form method="post" action=" {{ url('pges/add_pg_amenity') }}" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="is_active">Select Amenity</label>
                                                                <input type="hidden"  value="{{ $pgdetail['id'] }}" name="id">
                                                                <select name="amenitie_id" id="amenitie_id" required  class="form-control" onchange="changeAmenity()">	
                                                                    <option value=>Select</option> 
                                                                    @foreach ($pgdetail['amenities'] as $type)
                                                                        <option value="{{$type['id']}}"  >{{$type['name']}}</option>
                                                                    @endforeach      
                                                                </select>
                                                                @error('amenitie_id')
                                                                    <span class="error_msg">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="select_amenity_description">Description</label>
                                                                <textarea class="form-control" disbled  id="select_amenity_description"  placeholder="Enter Description"></textarea>  
                                                            </div> 
                                                        </div>  
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <img class="img-thumbnail" id="output" src="{{ asset('public/images/image-preview.png') }}"  alt="200x200" width="200"  data-holder-rendered="true">
                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                    <script>
                                                       function changeAmenity() {
                                                            var id = $('#amenitie_id').val();
                                                            if(id) {
                                                                $.ajax({
                                                                    type: "GET",
                                                                    url : "{{url('pges/find_amenity/')}}" + "/" + id,
                                                                    success: function (data) {
                                                                        if(data) {
                                                                            $('#select_amenity_description').val(data.description);
                                                                            
                                                                            $("#output").attr("src",data.icon);
                                                                        }
                                                                    }         
                                                                });
                                                            }
                                                            else {
                                                                $('#select_amenity_description').val('');
                                                                            
                                                                            $("#output").attr("src",'https://paypgroom.com/public/images/image-preview.png');
                                                            }
                                                       }
                                                    </script>
                                                </form>
                                             </div>
                                          </div>
                                          <!-- /.modal-content -->
                                       </div>
                                       <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    <table class="table table-hover table-sm">
                                       @foreach($pgdetail['pg_amenities'] as  $index => $p)
                                          <!-- <li><img src="{{ $p['icon'] }}" class="img-fluid img-thumbnail" alt="" height="30" width="50"> {{   $p['name'] }}</li> -->

                                            <tr>
                                                <td> <img src="{{ $p['icon'] }}" class="img-fluid img-thumbnail" alt="" height="30" width="50"></td>
                                                <td>{{ $p['name'] }}</td>
                                                <td> {{ $p['description'] ? $p['description'] : '-' }} </td>
                                                <td><button type="submit" onclick="removeAmenity({{$p['id']}},{{$pgdetail['id']}})" class="btn btn-primary waves-effect waves-light" style="float: right;"><i class="fa fa-trash"></i></button></td>
               								</tr>
                                       @endforeach
                                    </table>
                                 </div>
                                 <div class="tab-pane p-3" id="messages" role="tabpanel">
                                    <form method="post" action=" {{ url('pges/update_pg_pricedetail') }}" enctype="multipart/form-data" autocomplete="off"> 
                                        <table class="table table-hover">
                                        <tr>
                                            <th> <strong class="error_msg">Per Month</strong> </th>
                                            <td> 
                                                <div class="form-group edit_box">
                                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                        <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                            <span class="input-group-text">₹</span>
                                                        </span>
                                                        <input type="hidden"  value="{{ $pgdetail['id'] }}" name="id">
                                                        <input id="per_month" type="text" value="{{ $pgdetail['pg_pricing']['per_month'] }}" name="per_month" class="form-control">
                                                    </div> 
                                                    @error('per_month')
                                                        <span class="error_msg">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <th> <strong class="error_msg">Security Deposit</strong> </th>
                                            <td> 
                                                <div class="form-group edit_box">
                                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                        <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                            <span class="input-group-text">₹</span>
                                                        </span>
                                                        <input id="security_deposit" type="text" value="{{ $pgdetail['pg_pricing']['security_deposit'] }}" name="security_deposit" class="form-control">
                                                    </div> 
                                                    @error('security_deposit')
                                                        <span class="error_msg">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th> <strong class="error_msg">Cleaning Fee</strong> </th>
                                            <td> 
                                                <div class="form-group edit_box">
                                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                        <span class=" bootstrap-touchspin-prefix input-group-prepend">
                                                            <span class="input-group-text">₹</span>
                                                        </span>
                                                        <input id="cleaning_fee" type="text" value="{{ $pgdetail['pg_pricing']['cleaning_fee'] }}" name="cleaning_fee" class="form-control">
                                                    </div> 
                                                    @error('cleaning_fee')
                                                        <span class="error_msg">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                            <th> <strong class="error_msg">Minimum Stay Month</strong> </th>
                                            <td> 

                                                <div class="form-group edit_box">
                                                    <input type="text" class="form-control" required name="minimum_stay_month" id="minimum_stay_month" value="{{$pgdetail['pg_pricing']['minimum_stay_month'] }}" placeholder="Enter number of beds"> 
                                                    @error('minimum_stay_month')
                                                        <span class="error_msg">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- <tr>
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
                                        </tr>  -->
                                        </table>
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" style="float: right;">Update</button>
                                    </form>
                                 </div>
                                 <div class="tab-pane p-3" id="settings" role="tabpanel">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".pg_image_model" style="float: right;">Add New</button>
                                        <div class="modal fade bs-example-modal-center pg_image_model" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title mt-0">Center modal</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action=" {{ url('pges/add_pg_image') }}" enctype="multipart/form-data" autocomplete="off">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="hidden"  value="{{ $pgdetail['id'] }}" name="pg_id">
                                                                    <input type="text" class="form-control" required name="image_name" id="image_name"  placeholder="Enter Name">  
                                                                    @error('image_name')
                                                                        <span style="color:red" class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" required name="image_title" id="image_title"  placeholder="Enter Title">  
                                                                    @error('image_title')
                                                                        <span style="color:red" class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" required name="image_description" id="image_description"  placeholder="Enter Description"></textarea>  
                                                                    @error('image_description')
                                                                        <span style="color:red" class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div> 
                                                            </div>  
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input type="file" class="filestyle" required name="image" accept="image/*" data-buttonname="btn-secondary" id="filestyle-0" tabindex="-1" onchange="loadFile(event)" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                                                    <div class="bootstrap-filestyle input-group">
                                                                        <input type="text" class="form-control " placeholder="" disabled=""> 
                                                                        <span class="group-span-filestyle input-group-append" tabindex="0">
                                                                            <label for="filestyle-0" class="btn btn-secondary ">
                                                                                <span class="icon-span-filestyle fa fa-folder-open"></span> 
                                                                                <span class="buttonText">Choose Image</span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                    @error('image')
                                                                        <span class="error_msg">{{$message}}</span>
                                                                    @enderror
                                                                </div>  
                                                            </div> 
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img class="img-thumbnail" id="output1" src="{{ asset('public/images/image-preview.png') }}" alt="200x200" width="200"  data-holder-rendered="true">
                                                                <script>
                                                                    var loadFile = function(event) {
                                                                        var reader = new FileReader();
                                                                        reader.onload = function(){
                                                                        var output = document.getElementById('output1');
                                                                        output.src = reader.result;
                                                                        };
                                                                        reader.readAsDataURL(event.target.files[0]);
                                                                    };
                                                                </script>
                                                            </div>

                                                        </div>
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <div class="row">
                                        @foreach($pgdetail['pg_images'] as  $index => $p)
                                            <div class="col-md-3 img_container" >
                                                <img src="{{ $p['image'] }}" class="img-fluid img-thumbnail image" alt="" style="height:300px;width:300px" >
                                                <div class="img_middle">
                                                    <div class="img_text"> <button type="submit" onclick="removeImage({{$p['id']}},{{$pgdetail['id']}})" class="btn btn-primary waves-effect waves-light"><i class="fa fa-trash"></i></button></div>
                                                </div>
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
                  <script type="text/javascript">
                    function removeAmenity(amenity_id,pg_id) {
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
                                        url : "{{url('pges/delete_amenity')}}",
                                        data: {"amenity_id" : amenity_id,"pg_id":pg_id},
                                        contentType: "application/json; charset=utf-8",
                                        dataType: "json",
                                        success: function (data) {
                                            if(data) {
                                                //swal("Deleted Successfully");
                                                toastr.options = {
                                                    "positionClass": "toast-top-center",
                                                };
                                                toastr.success('Amenity is deleted successfully')
                                                window.location.reload();
                                            }
                                        }         
                                    });

                                }
                            });
                    }
                    function removeImage(id,pg_id) {
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
                                        url : "{{url('pges/delete_pgimage')}}",
                                        data: {"id" : id,"pg_id":pg_id},
                                        contentType: "application/json; charset=utf-8",
                                        dataType: "json",
                                        success: function (data) {
                                            // console.log(data);
                                            // if(data) {
                                                //swal("Deleted Successfully");
                                                toastr.options = {
                                                    "positionClass": "toast-top-center",
                                                };
                                                toastr.success('Property type is deleted successfully')
                                                window.location.reload();
                                            //}
                                        }       
                                    });

                                }
                            });
                    }
                    </script>
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