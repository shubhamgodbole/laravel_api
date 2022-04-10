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
                            <h4>Add User </h4>
                        </div>
                        <div class="form-body">
                            <form method="post" action="addUser" enctype="multipart/form-data" autocomplete="off"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label> 
                                            <input type="text" class="form-control" required name="first_name" id="first_name" placeholder="Enter first name"> 
                                            @error('first_name')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label> 
                                            <input type="text" class="form-control" required name="last_name" id="last_name" placeholder="Enter last name"> 
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
                                            <input type="email" class="form-control"  name="email" id="email" placeholder="Enter email"> 
                                            @error('email')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label> 
                                            <input type="number" class="form-control" required name="mobile" id="mobile" placeholder="Enter mobile number"> 
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
                                            <div class="radio-inline"><label><input type="radio" name="gender" value="male" checked> Male</label></div>
    										<div class="radio-inline"><label><input type="radio" name="gender" value="female"> Female</label></div> 
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_type">User Type</label>
                                            <select name="user_type" id="user_type" class="form-control" required>
                                                <option value="">---- Select ----</option>						
                                                <option value=2>PG Owner</option>
                                                <option value=3>Tanent</option>
                                            </select>
                                            @error('user_type')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="address">
                                <label for="exampleInputFile" style="margin-left:17px">Address</label> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  required name="line1" id="line1" placeholder="Address line 1">  
                                                @error('line1')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="line2" id="line2" placeholder="Address line 2">  
                                                @error('line2')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror    
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="city" id="city" placeholder="City">  
                                                @error('city')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"  name="taluka" id="taluka" placeholder="Taluka">  
                                                @error('taluka')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror   
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" maxlength="6" class="form-control" required name="pincode" id="pincode" onChange="changePindoe(this.value)" placeholder="Pin code">  
                                                @error('pincode')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required name="district" id="district"  placeholder="District">  
                                                @error('district')
                                                    <span style="color:red" class="help-block">{{$message}}</span>
                                                @enderror
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" required name="state" id="state"  placeholder="State">  
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
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" required name="password" id="password" placeholder="Enter password">  
                                            @error('password')
                                                <span style="color:red" class="help-block">{{$message}}</span>
                                            @enderror
                                        </div>    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="exampleInputFile">Profile Image</label> 
                                            <input type="file" name="profile" accept="image/*" id="exampleInputFile"  >
                                        </div>
                                    </div>
                                </div>
                                
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