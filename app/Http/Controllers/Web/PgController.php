<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PgPriceDetail;
use App\Models\PgAmenitie;
use App\Models\Pgdetail;
use App\Models\PgImage;
use App\Models\Address;
use App\Models\Ameniti;
use App\Models\CityMaster;
use App\Models\PropertyType;
use App\Models\RoomType;
class PgController extends Controller
{
    function getPgs(Request $request) {
        $pges= Pgdetail::with('pg_owner')->with('pg_images')->get();
 //       return $pges;
        return view('pges/pges')->with('pges',$pges); 
    }

    function pgDetail($id) {
//        $pgdetail= Pgdetail::with('address')->with('pg_images')->with('pg_owner')->where('id',$id)->first();
        $p= Pgdetail::with('address')->with('pg_owner')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->with('pg_amenities')->with('pg_pricing')->where('id',$id)->first();
        
        $data = [];
        $data['id'] = $p->id;
        $data['pg_name'] = $p->pg_name;
        $data['property_type'] = $p['pg_propertyType']['name'];
        $data['pg_room_type'] = $p['pg_roomType']['name'];
        $data['luxry_type'] = $p->booking_type_id;
        $data['is_fooding_available'] = $p->is_fooding_available ? 'Yes' : 'No';
        $data['luxry_type'] = config('constants.luxry_type')[$p->luxry_type];
        $data['guests'] = $p->guests;
        $data['bathroom'] = $p->bathroom;
        $data['bedroom'] = $p->bedroom;
        $data['beds'] = $p->beds;
        $data['description'] = $p->description;
        $data['other_details'] = $p->other_details;
        $data['size'] = $p->size;
        $data['address'] = $p->address;
        $data['pg_images'] = $p->pg_images;
        
        
        $amenities = $p->pg_amenities;
        $amenitieData = [];
        foreach( $amenities  as $a) {
            $amenitie = Ameniti::where('id',$a->amenitie_id)->first();
            if($amenitie) {
            array_push($amenitieData,array('name'=>$amenitie->name, 'icon'=>$amenitie->icon, 'description'=>$amenitie->description ));
            }
        }

        $data['pg_amenities'] = $amenitieData;

        $data['pg_owner'] = array(
            'name'=> $p['pg_owner']['first_name'] .' '. $p['pg_owner']['last_name'],
            'email'=> $p['pg_owner']['email'],
            'mobile'=> $p['pg_owner']['mobile'],
            'gender'=> $p['pg_owner']['gender'],
            'profile'=> $p['pg_owner']['profile'],
            ) ;
        
        $data['pg_pricing'] = array(
            'per_month' => $p['pg_pricing']['per_month'],
            'security_deposit' => $p['pg_pricing']['security_deposit'],
            'cleaning_fee' => $p['pg_pricing']['cleaning_fee'],
            'minimum_stay_month' => $p['pg_pricing']['minimum_stay_month'],
            'check_in' => $p['pg_pricing']['check_in'],
            'check_out' => $p['pg_pricing']['check_out'],
            'cancellation_charge' => $p['pg_pricing']['cancellation_charge'],
        );  
//        return $data;
        
        return view('pges/pgdetail')->with('pgdetail',$data); 
    }

    function pgUpdateView($id) {
//        $pgdetail= Pgdetail::with('address')->with('pg_images')->with('pg_owner')->where('id',$id)->first();
        $p= Pgdetail::with('address')->with('pg_owner')->with('pg_images')->with('pg_propertyType')->with('pg_roomType')->with('pg_amenities')->with('pg_pricing')->where('id',$id)->first();
        $cityMaster = CityMaster::where('is_active',1)->get();
        $propertyTypes = PropertyType::where('is_active',1)->get();
        $roomTypes = RoomType::where('is_active',1)->get();
        $luxry_types = config('constants.luxry_type');
        $amenities = Ameniti::where('is_active',1)->get();
        $amenitieData  = [];
        foreach($amenities as $a) {
            $amenitie = PgAmenitie::where('amenitie_id',$a->id)->where('pg_id',$p->id)->first();
            if(!$amenitie) {
                array_push($amenitieData,array('id'=>$a->id, 'name'=>$a->name, 'icon'=>$a->icon, 'description'=>$a->description ));
            }
        }

        $data = [];
        $data['id'] = $p->id;
        $data['pg_name'] = $p->pg_name;
        $data['property_type'] = $p['pg_propertyType']['name'];
        $data['pg_room_type'] = $p['pg_roomType']['name'];
        $data['luxry_type'] = $p->booking_type_id;
        $data['is_fooding_available'] = $p->is_fooding_available ? 'Yes' : 'No';
        $data['luxry_type'] = config('constants.luxry_type')[$p->luxry_type];
        $data['guests'] = $p->guests;
        $data['bathroom'] = $p->bathroom;
        $data['bedroom'] = $p->bedroom;
        $data['beds'] = $p->beds;
        $data['description'] = $p->description;
        $data['other_details'] = $p->other_details;
        $data['size'] = $p->size;
        $data['address'] = $p->address;
        $data['pg_images'] = $p->pg_images;
        $data['cityMaster'] = $cityMaster;
        $data['propertyTypes'] = $propertyTypes;
        $data['roomTypes'] = $roomTypes;
        $data['luxry_types'] = $luxry_types;
        $data['amenities'] = $amenitieData;
        $amenities = $p->pg_amenities;
        $amenitieData = [];
        foreach($amenities as $a) {
            $amenitie = Ameniti::where('id',$a->amenitie_id)->first();
            array_push($amenitieData,array('id'=>$amenitie->id, 'name'=>$amenitie->name, 'icon'=>$amenitie->icon, 'description'=>$amenitie->description ));
        }

        $data['pg_amenities'] = $amenitieData;

        $data['pg_owner'] = array(
            'name'=> $p['pg_owner']['first_name'] .' '. $p['pg_owner']['last_name'],
            'email'=> $p['pg_owner']['email'],
            'mobile'=> $p['pg_owner']['mobile'],
            'gender'=> $p['pg_owner']['gender'],
            'profile'=> $p['pg_owner']['profile'] ?$p['pg_owner']['profile'] : asset('public/images/image-preview.png'),
            ) ;
        
        $data['pg_pricing'] = array(
            'per_month' => $p['pg_pricing']['per_month'],
            'security_deposit' => $p['pg_pricing']['security_deposit'],
            'cleaning_fee' => $p['pg_pricing']['cleaning_fee'],
            'minimum_stay_month' => $p['pg_pricing']['minimum_stay_month'],
            'check_in' => $p['pg_pricing']['check_in'],
            'check_out' => $p['pg_pricing']['check_out'],
            'cancellation_charge' => $p['pg_pricing']['cancellation_charge'],
        );  
//        return $data;
        
        return view('pges/editpg')->with('pgdetail',$data); 
    }

    
    function UpdatePGDetail(Request $request) {
        
          // $validator = $request->validate(array(
        //     'id' => 'required',
        //     'pg_name' => 'required',
        //     'property_type_id' => 'required',
        //     'room_type_id' => 'required',
        //     'size' => 'required',
        //     'guests' => 'required',
        //     'bathroom' => 'required',
        //     'bedroom' => 'required',
        //     'beds' => 'required',
        //     'is_fooding_available' => 'required',
        //     'description' => 'required',
        //     'other_details' => 'required',
        //     'service_city_code' => 'required',
        // ));
        if(!$request->get('id')) {
            $notification = array(
                'message' => 'PG id is required', 
                'alert-type' => 'error'
            );  
            return redirect()->back()->with($notification);            
        }
        $pgDetail = Pgdetail::where('id',$request->get('id'))->first();
      
      
        $pgDetail->pg_name = $request->get('pg_name');
        $pgDetail->property_type_id = $request->get('property_type_id');
        $pgDetail->room_type_id = $request->get('room_type_id');
        $pgDetail->size = $request->get('size');
        $pgDetail->guests = $request->get('guests');
        $pgDetail->bathroom = $request->get('bathroom');
        $pgDetail->bedroom = $request->get('bedroom');
        $pgDetail->beds = $request->get('beds');
        $pgDetail->is_fooding_available =$request->get('is_fooding_available');
        $pgDetail->description = $request->get('description');
        $pgDetail->other_details = $request->get('other_details');
        $pgDetail->service_city_code = $request->get('service_city_code');
        $pgDetail->save();

        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges/update_pg/'. $request->get('id'))->with($notification);
    }

    function addPGAmenity(Request $request) {
        $validator = $request->validate(array(
            'id' => 'required',
            'amenitie_id' => 'required',
           
        ));
        $amenitie = new PgAmenitie();
        $amenitie->pg_id = $request->get('id');
        $amenitie->amenitie_id = $request->get('amenitie_id');
        $amenitie->save();
        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges/update_pg/'. $request->get('id'))->with($notification);
    }
    function findAmenity($id) {
        $amenity = "";
        if($id) {
            $amenity = Ameniti::where('id',$id)->first();
        }
        return $amenity;

    }
    function removeAmenity(Request $request) {
        $amenity = PgAmenitie::where('pg_id',$request->get('pg_id'))->where('amenitie_id',$request->get('amenity_id'))->first();
        $amenity->delete();
        return true;
        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges/update_pg/'.$request->get('pg_id'))->with($notification);

    }

    function updatePGPriceDetail(Request $request) {
        $validator = $request->validate(array(
            'id' => 'required',           
        ));

        $PgPriceDetail = PgPriceDetail::where('pg_id',$request->get('id'))->first();
        $PgPriceDetail->per_month = $request->get('per_month');
        $PgPriceDetail->security_deposit = $request->get('security_deposit');
        $PgPriceDetail->cleaning_fee = $request->get('cleaning_fee');
        $PgPriceDetail->minimum_stay_month = $request->get('minimum_stay_month');
        $PgPriceDetail->save();

        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges/update_pg/'.$request->get('id'))->with($notification);

    }

    function deletePGImage(Request $request) {
        // $validator = $request->validate([
        //     'pg_id' => 'required',
        //     'id' => 'required'
        // ]);

        $pgImage = PgImage::find($request->get('id'));
        $pgImage->delete();

        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return true;
    }

    function addPGImage(Request $request) {
        $validator = $request->validate([
            'pg_id' => 'required',
            'image_name' => 'required',
            'image_title' => 'required',
            'image_description' => 'required',
            'image' => 'required|file|max:2048|mimes:jpg,jpeg,png,svg,bmp,gif,webp'
        ]);


        $t=time();
        $str = $request->get('image_name');
        if (strpos($str, ' ') != false) {
            $str = str_replace(' ', '_', $str);
        }
        $file_name = $t."_".$str.".jpg";
        $path = $request->file('image')->move(public_path("/image/"),$file_name);
        $file_uri = url('/public/image/'.$file_name);
       
        $pgImage = new PgImage();
        $pgImage->pg_id = $request->get('pg_id'); 
        $pgImage->image_name = $request->get('image_name');
        $pgImage->title = $request->get('image_title');
        $pgImage->description = $request->get('image_description');
        $pgImage->image = $file_uri;
        $pgImage->save();

        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges/update_pg/'.$request->get('pg_id'))->with($notification);
        
    }
    function changeActivationStatus($id) {
        $pgdetail = Pgdetail::find($id);
        $pgdetail->is_active = !$pgdetail->is_active;
        $pgdetail->save();
        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges')->with($notification);
    }
    
    function changeIsRecommendedStatus($id) {
        $pgdetail = Pgdetail::find($id);
        $pgdetail->is_recommended = !$pgdetail->is_recommended;
        $pgdetail->save();
        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/pges')->with($notification);
    }
}
