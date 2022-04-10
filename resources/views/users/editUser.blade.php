<x-header />
<body class="cbp-spmenu-push">
	<div class="main-content">
	
		<!--left-fixed -navigation-->
        <x-sidebar />
        <!--left-fixed -navigation-end-->
		<!-- header-starts -->
		<x-topbar />
		<!-- //header-ends -->
		<!-- main content start-->
        <div id="page-wrapper">
			<div class="main-page">
                <div class="forms">
                    <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                        <div class="form-title">
                            <h4>Update User </h4>
                        </div>
                        <div class="form-body">
                            <form method="post" action="{{ url('users/updateUser') }}" enctype="multipart/form-data"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label> 
                                            <input type="hidden"  value="{{ $edit_data->id }}" name="id">
                                            @error('first_name')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror                                            <input type="text" class="form-control" value="{{ $edit_data->first_name }}" required name="first_name" id="first_name" placeholder="Enter first name">

                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label> 
                                            <input type="text" class="form-control" value="{{ $edit_data->last_name }}" required name="last_name" id="last_name" placeholder="Enter last name"> 
                                            @error('last_name')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Name</label> 
                                            <input type="email" class="form-control" value="{{ $edit_data->email }}"  required name="email" id="email" placeholder="Enter email"> 
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label> 
                                            <input type="number" class="form-control" required name="mobile" id="mobile" placeholder="Enter mobile number"> 
                                        </div>    
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="radio">Gender</label><br/> 
                                            <div class="radio-inline"><label><input type="radio" name="gender" value="male"   {{ $edit_data->gender == 'male' ? 'checked' : '' }} > Male</label></div>
    										<div class="radio-inline"><label><input type="radio" name="gender" value="female" {{ $edit_data->gender == 'female' ? 'checked' : '' }}> Female</label></div> 
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" id="user_type" class="form-control" required value="{{ $edit_data->user_type }}">					
                                                <option value=2 {{ $edit_data->user_type == '2' ? 'selected' : '' }}>PG Owner</option>
                                                <option value=3 {{ $edit_data->user_type == '3' ? 'selected' : '' }}>Tanent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="address">
                                <label for="exampleInputFile" style="margin-left:17px">Address</label> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required name="line1" value="{{ $edit_data->line1 }}" id="line1" placeholder="Address line 1">  
                                                @error('line1')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="line2" id="line2" value="{{ $edit_data->line2 }}" placeholder="Address line 2">  
                                                @error('line2')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="city" id="city" value="{{ $edit_data->city }}" placeholder="City">  
                                                @error('city')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="taluka" id="taluka" value="{{ $edit_data->taluka }}" placeholder="Taluka">   
                                                @error('taluka')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" maxlength="6" class="form-control" required name="pincode" id="pincode" value="{{ $edit_data->pincode }}" onChange="changePindoe(this.value)" placeholder="Pin code">  
                                                @error('pincode')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required name="district" id="district" value="{{ $edit_data->district }}"  placeholder="District">  
                                                @error('district')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required name="state" id="state" value="{{ $edit_data->state }}"  placeholder="State">  
                                                @error('state')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="radio">Activation Status</label><br/> 
                                                <div class="radio-inline"><label><input type="radio" name="is_active" value="1"   {{ $edit_data->is_active == '1' ? 'checked' : '' }} > Active</label></div>
                                                <div class="radio-inline"><label><input type="radio" name="is_active" value="0" {{ $edit_data->is_active == '0' ? 'checked' : '' }}> Deactive</label></div> 
                                            </div>    
                                        </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" required name="password" id="password" placeholder="Enter password">  
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="exampleInputFile">Profile Image</label> 
                                            <input type="file" name="profile" accept="image/*" id="exampleInputFile" required >
                                        </div>
                                    </div>
                                </div> -->
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-default">Submit</button> 
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
	    </div>
    </div>
    <script type="text/javascript">
  		function changePindoe(pincode) {
              console.log(pincode)
            if (pincode.length == 6) {
                $.ajax({
                    type: "GET",
                    url : "{{url('/users/pincode_details')}}" + "/"+pincode,
                    success: function (data) {
                        if(data) {
                            console.log('pincodeData',data)
                            $('#district').val(data.district_name);
                            $('#state').val(data.state_name);
                        }
                    }         
                });

            }
		}
</script>	
<x-footer />