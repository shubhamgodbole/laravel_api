<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PgPriceDetail;
use App\Models\PropertyType;
use App\Models\CityMaster;
use App\Models\PgAmenitie;
use App\Models\FavoritePg;
use App\Models\RoomType;
use App\Models\Pgdetail;
use App\Models\PgImage;
use App\Models\Address;
use App\Models\Ameniti;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\CancellationPloicy;
class PgController extends Controller
{    
    function pgMetaDeta() {
        try {
            $propertyType = PropertyType::where('is_active',1)->get();            
            $roomTtype    = RoomType::where('is_active',1)->get();
            $amenitie = Ameniti::where('is_active',1)->get();
            $cityMaster = CityMaster::where('is_active',1)->get();
            $ploicies = CancellationPloicy::all();
            $luxryType = config('constants.luxry_type'); 
            return $this->sendResultJSON(true, _("Pg Meta Deta"), array('property_types' => $propertyType, 'room_types' => $roomTtype, 'amenities' => $amenitie, 'cityMaster' => $cityMaster,'cancellation_policy' => $ploicies,  'luxryTypes' => $luxryType) );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function addPG(Request $request) {
        try {
            $element_array = array(
                'owner_id'=> "required",
                'location' => 'required',
                'pg_detail' => 'required',
                'amenities' => 'required',
                'pricing_detail' => 'required',
                'visit_schedule_detail' => 'required',
                'pg_images' => 'required',
            );
            $element_array['location.line1'] = 'required';
            $element_array['location.pincode'] = 'required';
            $element_array['location.city'] = 'required';
            $element_array['location.state'] = 'required';
            $element_array['location.country'] = 'required';
            $element_array['location.latitude'] = 'required';
            $element_array['location.longitude'] = 'required';

            $element_array['pg_detail.pg_name'] = 'required';
            $element_array['pg_detail.property_type_id'] = 'required';
            $element_array['pg_detail.room_type_id'] = 'required';
            $element_array['pg_detail.size'] = 'required';
            $element_array['pg_detail.guests'] = 'required';
            $element_array['pg_detail.bathroom'] = 'required';
            $element_array['pg_detail.bedroom'] = 'required';
            $element_array['pg_detail.beds'] = 'required';
            $element_array['pg_detail.is_fooding_available'] = 'required';
            $element_array['pg_detail.description'] = 'required';
            $element_array['pg_detail.other_details'] = 'required';
            $element_array['pg_detail.service_city_code'] = 'required';
            $element_array['pg_detail.luxry_type'] = 'required';
            //$element_array['pg_detail.cancellation_policy_id'] = 'required';
            
            $element_array['pricing_detail.per_month'] = 'required';
            $element_array['pricing_detail.security_deposit'] = 'required';
            $element_array['pricing_detail.cleaning_fee'] = 'required';
            $element_array['pricing_detail.minimum_stay_month'] = 'required';
            $element_array['pricing_detail.check_in'] = 'required';
            $element_array['pricing_detail.check_out'] = 'required';
            $element_array['pricing_detail.cancellation_charge'] = 'required';

            $element_array['visit_schedule_detail.visit_from'] = 'required';
            $element_array['visit_schedule_detail.visit_to'] = 'required';
            
            $element_array['pg_images.*.title'] = 'required';
            $element_array['pg_images.*.description'] = 'required';
            $element_array['pg_images.*.image_name'] = 'required';

            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            // return $this->sendResultJSON(true, _("PG detail added successfuly"),$request->all());
            $location = $request->get('location');
            $pg_detail = $request->get('pg_detail');
            $amenities = $request->get('amenities');
            $pricing_detail = $request->get('pricing_detail');
            $visit_schedule_detail = $request->get('visit_schedule_detail');
            $pg_images = $request->get('pg_images');

            foreach ($pg_images as $image)  { 
                $pgimage = PgImage::where('image_name',$image['image_name'])->first();
                if(!$pgimage) {
                    return $this->sendResultJSON(false, _("invalid image name ").$image['image_name']);                
                } 
            }
            
            $address = new Address();
            $address->line1 = $location['line1'];
            $address->line2 = $location['line2'];
            $address->city = $location['city'];
            $address->pincode = $location['pincode'];
            $address->state = $location['state'];
            $address->country = $location['country'];
            $address->latitude = $location['latitude'];
            $address->longitude = $location['longitude'];
            $address->save();

            $pgDetail = new Pgdetail();
            $pgDetail->owner_id = $request->get('owner_id');
            $pgDetail->pg_name = $pg_detail['pg_name'];
            $pgDetail->property_type_id = $pg_detail['property_type_id'];
            $pgDetail->room_type_id = $pg_detail['room_type_id'];
            $pgDetail->size = $pg_detail['size'];
            $pgDetail->guests = $pg_detail['guests'];
            $pgDetail->bathroom = $pg_detail['bathroom'];
            $pgDetail->bedroom = $pg_detail['bedroom'];
            $pgDetail->beds = $pg_detail['beds'];
            $pgDetail->is_fooding_available = $pg_detail['is_fooding_available'];
            $pgDetail->description = $pg_detail['description'];
            $pgDetail->other_details = $pg_detail['other_details'];
            $pgDetail->service_city_code = $pg_detail['service_city_code'];
            $pgDetail->address_id = $address->id;
            $pgDetail->latitude = $location['latitude'];
            $pgDetail->longitude = $location['longitude'];
            $pgDetail->visit_from = $visit_schedule_detail['visit_from'];
            $pgDetail->visit_to = $visit_schedule_detail['visit_to'];
            $pgDetail->luxry_type = $pg_detail['luxry_type'];
            //$pgDetail->cancellation_policy_id = $pg_detail['cancellation_policy_id'];
            $pgDetail->save();
            
           foreach($amenities as $amenitie) {
                $pgAmenitie = new PgAmenitie();
                $pgAmenitie->pg_id  = $pgDetail->id;
                $pgAmenitie->amenitie_id = $amenitie;
                $pgAmenitie->save();
            }

            $priceDetail = new PgPriceDetail();
            $priceDetail->pg_id = $pgDetail->id;
            $priceDetail->per_month = $pricing_detail['per_month'];
            $priceDetail->security_deposit = $pricing_detail['security_deposit'];
            $priceDetail->cleaning_fee = $pricing_detail['cleaning_fee'];
            $priceDetail->minimum_stay_month = $pricing_detail['minimum_stay_month'];
            $priceDetail->check_in = $pricing_detail['check_in'];
            $priceDetail->check_out = $pricing_detail['check_out'];
            $priceDetail->cancellation_charge = $pricing_detail['cancellation_charge'];
            $priceDetail->is_chargeble = $pricing_detail['cancellation_charge'] > 0 ? 1 : 0;
            $priceDetail->save();

            foreach ($pg_images as $image)  {
                $pgimage = PgImage::where('image_name',$image['image_name'])->first();
                if($pgimage) {
                    $pgimage->pg_id = $pgDetail->id;
                    $pgimage->title = $image['title'];
                    $pgimage->description = $image['description'];
                    $pgimage->save();
                }
            }
            return $this->sendResultJSON(true, _("PG detail added successfuly"));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
function addPgImages(Request $request) {
        try {
            $element_array = array(
                'image_name'=> 'required',
                'image' => 'required|file|max:5120|mimes:jpg,jpeg,png,svg,bmp,gif,webp'
                
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $t=time();
            $str = $request->get('image_name');
            if (strpos($str, ' ') != false) {
                $str = str_replace(' ', '_', $str);
            }
            $file_name = $t."_".$str.".jpg";
            $pgimage = new PgImage();
            $path = $request->file('image')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            $pgimage->image_name = $request->get('image_name');
            $pgimage->image = $file_uri;
            $pgimage->save();

            return $this->sendResultJSON(true, __("PG image has been uploaded successfully."),array('uploaded_image_name' => $request->get('image_name'),"uploaded_image_url" => $file_uri));
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    function addPgLocation(Request $request) {
        try 
        {
            $element_array = array(
                'line1' => 'required',
                'pincode' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $address = new Address();
            $address->line1 = $request->get('line1');
            $address->line2 = $request->get('line2');
            $address->city = $request->get('city');
            $address->taluka = $request->get('taluka');
            $address->pincode = $request->get('pincode');
            $address->district = $request->get('city');
            $address->state = $request->get('state');
            $address->country = $request->get('country');
            $address->latitude = $request->get('latitude');
            $address->longitude = $request->get('longitude');
            $address->save();

            return $this->sendResultJSON(true, _("PG location is save successfuly"),$address );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function addPgDetail(Request $request) {
        try 
        {
            $element_array = array(
                'owner_id'=> "required",
                'address_id'=> "required",
                'pg_name'=> "required",
                'property_type_id'=> "required",
                'room_type_id'=> "required",
                'size'=> "required",
                'guests'=> "required",
                'bathroom'=> "required",
                'bedroom'=> "required",
                'beds'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $pgDetail = new Pgdetail();
            $pgDetail->owner_id = $request->get('owner_id');
            $pgDetail->pg_name = $request->get('pg_name');
            $pgDetail->property_type_id = $request->get('property_type_id');
            $pgDetail->room_type_id = $request->get('room_type_id');
            $pgDetail->size = $request->get('size');
            $pgDetail->guests = $request->get('guests');
            $pgDetail->bathroom = $request->get('bathroom');
            $pgDetail->bedroom = $request->get('bedroom');
            $pgDetail->beds = $request->get('beds');
            $pgDetail->description = $request->get('description');
            $pgDetail->other_details = $request->get('other_details');
            $pgDetail->address_id = $request->get('address_id');
            $pgDetail->booking_type_id =1; // $request->get('booking_type_id');
            $pgDetail->latitude = $request->get('latitude');
            $pgDetail->longitude = $request->get('longitude');

            $address = Address::find($request->get('address_id'));
            if($address) {
                $pgDetail->latitude = $address->latitude ;
                $pgDetail->longitude = $address->longitude;
            }
            $pgDetail->is_available = 1;
            $pgDetail->is_active = 0;
            $pgDetail->save();

        //    if($request->file('images')) {
        //         $i=1;
        //         foreach ($request->file('images') as $image)  {
        //             $t=time();
        //             $str = $request->get('pg_name');
        //             if (strpos($str, ' ') != false) {
        //                 $str = str_replace(' ', '_', $str);
        //              }
        //             $file_name = $t.$i."_".$str.".jpg";
        //             $path = $image->move(public_path("/image/"),$file_name);
        //             $file_uri = url('/public/image/'.$file_name);
        //             $i++;
        //             $pgimage = new PgImage();
        //             $pgimage->pg_id = $pgDetail->id;
        //             $pgimage->image = $file_uri;
        //             $pgimage->save();
        //         }
        //     }

            return $this->sendResultJSON(true, _("PG detail is saved successfuly") );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function getAmenities() {
        try {
            $type= Ameniti::where('is_active',1)->get();
            return $this->sendResultJSON(true, _("Fetch amenities successfuly"), $type );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function getPgs(Request $request) {
        try {
            $pgDetail=[];
                        if($request->get('request_type') == 'pincode') {
                $pincode = $request->get('value');
                $pgDetail= Pgdetail::whereHas('address', function ($query)use($pincode) {
                    return $query->where('pincode',  $pincode);
                })->with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->get();                
            }
            else if($request->get('request_type') == 'service_city_code' && $request->get('is_recommended') == '1') {
                $pgDetail= Pgdetail::with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->where('is_active',1)->where('is_available',1)->where('service_city_code',$request->get('value'))->where('is_recommended',1)->get();
            }
            else if($request->get('request_type') == 'service_city_code') {
                $pgDetail= Pgdetail::with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->where('is_active',1)->where('is_available',1)->where('service_city_code',$request->get('value'))->where('is_recommended',0)->get();
            }
            else if($request->get('request_type') == 'owner_id') {
                $pgDetail= Pgdetail::where('owner_id',$request->get('value'))->with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->get();
            }
            else if($request->get('request_type') == 'luxry_type') {
                $pgDetail= Pgdetail::where('luxry_type',$request->get('value'))->with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->get();
            }
            else if($request->get('request_type') == 'lat_lon') {
                $latitude = $request->get('lat');
                $longitude = $request->get('lon');
            
               if(!$request->get('lat')) {
                   return $this->sendResultJSON(false, _("lat field is required") );
               }
                
              if(!$request->get('lon')) {
                   return $this->sendResultJSON(false, _("lon field is required") );
               }               
               
                    $shops=    DB::table("pgdetails")
    ->select("*"
        ,DB::raw("6371 * acos(cos(radians(" . $latitude . ")) 
        * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(" . $longitude . ")) 
        + sin(radians(" .$latitude. ")) 
        * sin(radians(latitude))) AS distance"))
        ->having('distance', '<', 20)
        ->orderBy('distance', 'asc')
        ->get();
        
        $temp_data = [];
                foreach($shops as $p) { 
                    $d= Pgdetail::where('id',$p->id)->with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->first();                    
                    array_push($temp_data,$d);
                }
                $pgDetail = $temp_data;
//                   return $this->sendResultJSON(true, _("Fetch room type successfuly"), $temp_data );
            
            }

            else {
                $pgDetail= Pgdetail::with('address')->with('pg_owner')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->with('pg_amenities')->with('pg_pricing')->where('is_active',1)->where('is_available',1)->get();
            }

            $pgData = [];
            foreach($pgDetail as $p) {
                $data = [];
                $data['id'] = $p->id;
                $data['pg_name'] = $p->pg_name;
                $data['property_type'] = $p['pg_propertyType']['name'];
                $data['pg_room_type'] = $p['pg_roomType']['name'];
                $data['size'] = $p->size;
                $data['guests'] = $p->guests;
                $data['bathroom'] = $p->bathroom;
                $data['bedroom'] = $p->bedroom;
                $data['beds'] = $p->beds;
                $data['description'] = $p->description;
                $data['other_details'] = $p->other_details;
                $data['is_fooding_available'] = $p->is_fooding_available;
                $data['luxry_type'] = config('constants.luxry_type')[$p->luxry_type];
                $data['is_active'] = $p->is_active;
                $data['is_available'] = $p->is_available;
                $data['location'] = $p->address;
                                
                $amenities = $p->pg_amenities;
                $amenitieData = [];
                foreach($amenities as $a) {
                    $amenitie = Ameniti::where('id',$a->amenitie_id)->first();
                    array_push($amenitieData,array('name'=>$amenitie->name, 'icon'=>$amenitie->icon,'description'=>$amenitie->description));
                }

                $data['pg_amenities'] = $amenitieData;

                $data['pg_owner_detail'] = array(
                    'name'=> $p['pg_owner']['first_name'] .' '. $p['pg_owner']['last_name'],
                    'email'=> $p['pg_owner']['email'],
                    'gender'=> $p['pg_owner']['gender'],
                    'profile'=> $p['pg_owner']['profile'],
                    ) ;
                
                $data['pg_pricing_detail'] = array(
                    'per_month' => $p['pg_pricing']['per_month'],
                    'security_deposit' => $p['pg_pricing']['security_deposit'],
                    'cleaning_fee' => $p['pg_pricing']['cleaning_fee'],
                    'discount' => $p['pg_pricing']['discount'],
                    'minimum_stay_month' => $p['pg_pricing']['minimum_stay_month'],
                    'check_in' => $p['pg_pricing']['check_in'],
                    'check_out' => $p['pg_pricing']['check_out'],
                    'cancellation_charge' => $p['pg_pricing']['cancellation_charge'],
                );
                
                $data['visit_schedule_detail'] = array(
                    'visit_from'=> $p->visit_from,
                    'visit_to'=> $p->visit_to,
                    ) ;
                
                $data['pg_images'] = $p->pg_images;

                array_push($pgData,$data);
            }
            return $this->sendResultJSON(true, _("Fetch pgs successfuly"), $pgData );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    function getPgs1(Request $request) {
        try {
            $pgDetail=[];
            DB::enableQueryLog();
            $pgs= Pgdetail::with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->with('pg_amenities')->with('pg_pricing')->with('favorite_pg')->where('is_available',1); //DB::table("pgdetails")->where('is_active',1)->where('is_available',1);
            if($request->get('is_active') == "1") {
                $pgs = $pgs->where('is_active',$request->get('is_active'));
            }    
            if($request->get('is_active') == "0") {
                $pgs = $pgs->where('is_active',$request->get('is_active'));
            }
            if($request->get('service_city_code')) {
                $pgs =   $pgs->where('service_city_code',$request->get('service_city_code'));
            }
            
            if($request->get('is_recommended')) {
                $pgs = $pgs->where('is_recommended',$request->get('is_recommended'));
            }
            if($request->get('is_fooding_available') != "") {
                $pgs = $pgs->where('is_fooding_available',$request->get('is_fooding_available'));
            }

            if($request->get('luxry_type')) {
                $pgs = $pgs->where('luxry_type',$request->get('luxry_type'));
            }
            if($request->get('owner_id')) {
                $pgs = $pgs->where('owner_id',$request->get('owner_id'));
            }
            if($request->get('is_fooding_available')) {
                $pgs = $pgs->where('is_fooding_available',$request->get('is_fooding_available'));
            }
            if($request->get('lat') && $request->get('lon')) {
                $latitude = $request->get('lat');
                $longitude = $request->get('lon');    
    
                $pgs          =       $pgs->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                    * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                    + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
                $pgs          =       $pgs->having('distance', '<', 20);
                $pgs          =       $pgs->orderBy('distance', 'asc');
               
            }
            if($request->get('search_key')) {
                $term = $request->get('search_key');
                $pgs  = $pgs->where('pg_name', 'LIKE', "%$term%");
                $pgs  = $pgs->orWhere('description', 'LIKE', "%$term%");
                $pgs  = $pgs->orWhere('other_details', 'LIKE', "%$term%");
                $pgs  = $pgs->whereHas('address', function ($query)use($term) {
                            $query->where('pincode'  , 'LIKE', "%$term%");
                        })->orWhereHas('address', function( $query ) use ( $term ){
                            $query->where('line1', 'LIKE', "%$term%");
                        })->orWhereHas('address', function( $query ) use ( $term ){
                            $query->where('line2', 'LIKE', "%$term%");
                        })->orWhereHas('address', function( $query ) use ( $term ){
                            $query->where('city', 'LIKE', "%$term%");
                        })->orWhereHas('address', function( $query ) use ( $term ){
                            $query->where('state', 'LIKE', "%$term%");
                        });
            }
            
            
            $pgDetail = $pgs->get();
//            return DB::getQueryLog();
            if($request->get('min_price')  && $request->get('max_price')) {
                $temp_data = [];
                foreach($pgDetail as $p) { 
                    
                    $favorites = PgPriceDetail::where('per_month','>=',$request->get('min_price'))->where('per_month','<=',$request->get('max_price'))->where('pg_id','$p->id')->first();                     
                   if($favorites) {
                       array_push($temp_data,$p);
                   }
                   
                }   
                $pgDetail = $temp_data;
            }
            if($request->get('is_favorite') == true && $request->get('user_id')) {
                $temp_data = [];
                foreach($pgDetail as $p) { 
                    
                    $favorites = FavoritePg::where('user_id',$request->get('user_id'))->where('pg_id',$p->id)->where('is_active',1)->first();                     
                   if($favorites) {
                       array_push($temp_data,$p);
                   }
                }   
                $pgDetail = $temp_data;
            }
            if($request->get('room_type') || $request->get('property_type') || $request->get('amenity') || $request->get('luxry_type')) {
                $temp_data = [];
                foreach($pgDetail as $p) { 
                   if($p->pg_roomType['id'] == $request->get('room_type') || $p->pg_propertyType['id'] == $request->get('property_type') || $p->luxry_type == $request->get('luxry_type') ) {
                       array_push($temp_data,$p);
                   }
                }   
                $pgDetail = $temp_data;
            }
  
              
           // return $this->sendResultJSON(true, _("Fetch pgsss successfuly"), $pgDetail );

            $pgData = [];
            foreach($pgDetail as $p) {
                $data = [];
                
                $data['id'] = $p->id;
                $data['pg_name'] = $p->pg_name;
                $data['property_type'] = $p['pg_propertyType']['name'];
                $data['pg_room_type'] = $p['pg_roomType']['name'];
                $data['size'] = $p->size;
                $data['guests'] = $p->guests;
                $data['bathroom'] = $p->bathroom;
                $data['bedroom'] = $p->bedroom;
                $data['beds'] = $p->beds;
                $data['description'] = $p->description;
                $data['other_details'] = $p->other_details;
                $data['is_fooding_available'] = $p->is_fooding_available;
               // $data['luxry_type'] = config('constants.luxry_type')[$p->luxry_type];
               $data['luxry_type'] = $p->luxry_type;
                $data['is_active'] = $p->is_active;
                $data['is_available'] = $p->is_available;
                
                if($request->get('user_id')) {
                    $favoritePg = FavoritePg::where('pg_id',$p->id)->where('user_id',$request->get('user_id'))->where('is_active',1)->first();                
                    $data['is_favorite'] = $favoritePg ? 1 : 0;                    
                }
                else {
                    $data['is_favorite'] =  0; 
                }

                $data['location'] = $p->address;
                
                $amenities = $p->pg_amenities;
                $amenitieData = [];
                foreach($amenities as $a) {
                    $amenitie = Ameniti::where('id',$a->amenitie_id)->first();
                    if($amenitie) {
                        array_push($amenitieData,array('name'=>$amenitie->name, 'icon'=>$amenitie->icon,'description'=>$amenitie->description));
                    }
                }

                $data['pg_amenities'] = $amenitieData;

                $data['pg_owner_detail'] = array(
                    'owner_id' =>$p['pg_owner']['id'],
                    'name'=> $p['pg_owner']['first_name'] .' '. $p['pg_owner']['last_name'],
                    'email'=> $p['pg_owner']['email'],
                    'mobile'=> $p['pg_owner']['mobile'],
                    'gender'=> $p['pg_owner']['gender'],
                    'profile'=> $p['pg_owner']['profile'],
                    ) ;
                
                $data['pg_pricing_detail'] = array(
                    'per_month' => $p['pg_pricing']['per_month'],
                    'security_deposit' => $p['pg_pricing']['security_deposit'],
                    'cleaning_fee' => $p['pg_pricing']['cleaning_fee'],
                    'discount' => $p['pg_pricing']['discount'],
                    'minimum_stay_month' => $p['pg_pricing']['minimum_stay_month'],
                    'check_in' => $p['pg_pricing']['check_in'],
                    'check_out' => $p['pg_pricing']['check_out'],
                    'cancellation_charge' => $p['pg_pricing']['cancellation_charge'],
                );
                
                $data['visit_schedule_detail'] = array(
                    'visit_from'=> $p->visit_from,
                    'visit_to'=> $p->visit_to,
                    ) ;
                
                $data['pg_images'] = $p->pg_images;

                array_push($pgData,$data);
            }
            return $this->sendResultJSON(true, _("Fetch pgs successfuly"), $pgData );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function getMyPgs(Request $request) {
        try {
            $element_array = array(
                'owner_id'=> "required"
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            //$user = User::where('id',$request->get('owner_id'))->where('user_type' ,config('constants.user_type')['owner'])->first();
            $user = User::where('id',$request->get('owner_id'))->first();
            if(!$user) {
                return $this->sendResultJSON(false, _('Invalid User'));
            }
                    
            $pgDetail= Pgdetail::where('owner_id',$request->get('owner_id'))->with('address')->with('pg_images')->with('pg_propertyType')->with('pg_roomType');
            if($request->get('is_active') == 1 || $request->get('is_active') == 0) {
                $pgDetail= $pgDetail->where('is_active',$request->get('is_active'));
            } 
            $pgDetail= $pgDetail->get();
            $pgData = [];
            if($pgDetail) {
                foreach($pgDetail as $p) {
                    $data = [];
                    $data['id'] = $p->id;
                    $data['pg_name'] = $p->pg_name;
                    $data['property_type'] = $p['pg_propertyType']['name'];
                    $data['pg_room_type'] = $p['pg_roomType']['name'];
                    $data['size'] = $p->size;
                    $data['guests'] = $p->guests;
                    $data['bathroom'] = $p->bathroom;
                    $data['bedroom'] = $p->bedroom;
                    $data['beds'] = $p->beds;
                    $data['description'] = $p->description;
                    $data['other_details'] = $p->other_details;
                    $data['is_fooding_available'] = $p->is_fooding_available;
//                    $data['luxry_type'] = config('constants.luxry_type')[$p->luxry_type];
                    $data['luxry_type'] = $p->luxry_type;
                    $data['is_active'] = $p->is_active;
                    $data['is_available'] = $p->is_available;
                    
                    if($request->get('owner_id')) {
                        $favoritePg = FavoritePg::where('pg_id',$p->id)->where('user_id',$request->get('owner_id'))->where('is_active',1)->first();                
                        $data['is_favorite'] = $favoritePg ? 1 : 0;                    
                    }
                    else {
                    $data['is_favorite'] =  0; 
                    }

                    $data['location'] = $p->address;
                                    
                    $amenities = $p->pg_amenities;
                    $amenitieData = [];
                    foreach($amenities as $a) {
                        $amenitie = Ameniti::where('id',$a->amenitie_id)->first();
                        if($amenitie) {
                            array_push($amenitieData,array('name'=>$amenitie->name, 'icon'=>$amenitie->icon,'description'=>$amenitie->description));
                        }
                    }
    
                    $data['pg_amenities'] = $amenitieData;
    
                    $data['pg_owner_detail'] = array(
                        'owner_id' =>$p['pg_owner']['id'],
                        'name'=> $p['pg_owner']['first_name'] .' '. $p['pg_owner']['last_name'],
                        'email'=> $p['pg_owner']['email'],
                        'mobile'=> $p['pg_owner']['mobile'],
                        'gender'=> $p['pg_owner']['gender'],
                        'profile'=> $p['pg_owner']['profile'],
                        ) ;
                    
                    $data['pg_pricing_detail'] = array(
                        'per_month' => $p['pg_pricing']['per_month'],
                        'security_deposit' => $p['pg_pricing']['security_deposit'],
                        'cleaning_fee' => $p['pg_pricing']['cleaning_fee'],
                        'discount' => $p['pg_pricing']['discount'],
                        'minimum_stay_month' => $p['pg_pricing']['minimum_stay_month'],
                        'check_in' => $p['pg_pricing']['check_in'],
                        'check_out' => $p['pg_pricing']['check_out'],
                        'cancellation_charge' => $p['pg_pricing']['cancellation_charge'],
                    );
                    
                    $data['visit_schedule_detail'] = array(
                        'visit_from'=> $p->visit_from,
                        'visit_to'=> $p->visit_to,
                        ) ;
                    
                    $data['pg_images'] = $p->pg_images;
    
                    array_push($pgData,$data);
                }                
            }

            return $this->sendResultJSON(true, _("Fetch pgs successfuly"), $pgData );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    function addPgAmenites(Request $request) {
        try {
            $element_array = array(
                'pg_id'=> "required",
                'amenities'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            $amenities = $request->get('amenities');
            
            // return $this->sendResultJSON(false, 'add at least 1 amenitie',count($amenities));
            // if(count($amenities) < 0) {
            //     return $this->sendResultJSON(false, 'add at least 1 amenitie');
            // }
            
            foreach($amenities as $amenitie) {
                $pgAmenitie = new PgAmenitie();
                $pgAmenitie->pg_id  = $request->get('pg_id');
                $pgAmenitie->amenitie_id = $amenitie;
                $pgAmenitie->save();
            }


            return $this->sendResultJSON(true, _("Amenities are added successfuly") );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function addPgPricingDetail(Request $request) {
        try {
            $element_array = array(
                'pg_id'=> "required"
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $priceDetail = new PgPriceDetail();
            $priceDetail->pg_id = $request->get('pg_id');
            $priceDetail->per_day = $request->get('per_day');
            $priceDetail->per_week = $request->get('per_week');
            $priceDetail->per_month = $request->get('per_month');
            $priceDetail->weekend = $request->get('weekend');
            $priceDetail->city_fee = $request->get('city_fee');
            $priceDetail->security_deposit = $request->get('security_deposit');
            $priceDetail->cleaning_fee = $request->get('cleaning_fee');
            $priceDetail->tax = $request->get('tax');
            $priceDetail->extra_guest_fee = $request->get('extra_guest_fee');
            $priceDetail->discount = $request->get('discount');
            $priceDetail->save();

            return $this->sendResultJSON(true, _("Price detail added successfuly") );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }


    function getPropertyTypes() {
        try {
            $type= PropertyType::where('is_active',1)->get();
            return $this->sendResultJSON(true, _("Fetch property type successfuly"), $type );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function getRoomTypes() {
        try {
            $type= RoomType::where('is_active',1)->get();
            return $this->sendResultJSON(true, _("Fetch room type successfuly"), $type );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }

    function nearByPg(Request $request) {
        try {
            $latitude = $request->get('lat');
            $longitude = $request->get('lon');
               


            $shops          =       DB::table("addresses");

            $shops          =       $shops->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . ")) * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
           // $shops          =       $shops->having('distance', '<', 20);
            $shops          =       $shops->orderBy('distance', 'asc');

            $shops          =       $shops->get();
            return $this->sendResultJSON(true, _("Fetch room type successfuly"), $shops );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    public function addFavaorate(Request $request) {
        try {
            $element_array = array(
                'user_id'=> "required",
                'pg_id'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            if($request->get('is_favorite') == 1) {
                $favoritePg = FavoritePg::where('pg_id',$request->get('pg_id'))->where('user_id',$request->get('user_id'))->where('is_active',1)->first();                
                if($favoritePg) {
                    return $this->sendResultJSON(false, 'this pg has been already added to favorie.');
                }
            }

            $favoritePg = FavoritePg::where('pg_id',$request->get('pg_id'))->where('user_id',$request->get('user_id'))->first();                
            if($favoritePg) {
                    $favoritePg->is_active = $request->get('is_favorite');
                    $favoritePg->save();
                    $message = $request->get('is_favorite') == 1 ? "Favaorate pg saved successfuly" : "Favaorate pg removed successfuly";
                    return $this->sendResultJSON(true, $message );
            }

            $favoritePg = new FavoritePg();
            $favoritePg->user_id = $request->get('user_id');
            $favoritePg->pg_id = $request->get('pg_id');
            $favoritePg->is_active = $request->get('is_favorite');
            $favoritePg->save();

            return $this->sendResultJSON(true, _("Favaorate pg saved successfuly") );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
    function setPGAvailable(Request $request) {
        try {
                $element_array = array(
                'user_id'=> "required",
                'pg_id'=> "required",
                'is_available'=> "required",
                
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $pgDetail= Pgdetail::where('id',$request->get('pg_id'))->first();
            
            $user = User::where('id',$request->get('user_id'))
                    ->where('user_type',1)->first();
            if(!$user && ($request->get('user_id') != $pgDetail->owner_id )) {
                return $this->sendResultJSON(false, 'invalid user id');
            }
            

            if($pgDetail) {
                $pgDetail->is_available = $request->get('is_available');
                $pgDetail->updated_by = $request->get('user_id');
                $pgDetail->save();
                
                return $this->sendResultJSON(true, _("Your PG status updated successfully"),array('pg_data' => $pgDetail) );
            }
            
            return $this->sendResultJSON(false, _("Invalid PG Id") );
            
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
    
        function deletePg(Request $request) {
        try {
            $element_array = array(
                'pg_id'=> "required",
                'owner_id'=> "required",
            );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }

            $pgdetail = Pgdetail::where('id',$request->get('pg_id'))->where('owner_id',$request->get('owner_id'))->first();
            if($pgdetail) {
                $pgdetail->delete();
                return $this->sendResultJSON(true, _("Pg deleted successfuly") );
            }
            return $this->sendResultJSON(false, _("Invalid pg data") );
        }
        catch (\Exception $e) {
            return $this->sendResultJSON(false, $e->getMessage());
        }
    }
}
