<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ads;
use App\Models\User;
use App\Models\AdsMenuImage;
use Validator;
class AdsController extends Controller
{
    function geCategories() {
        try {
            $category = Category::all();
            return $this->sendResultJSON(true, _("Fetch catrgories successfully.") ,$category);
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
    
    function addAds(Request $request) {
        try {
             $element_array = array(
                'category'=> "required",
                'title'=> "required",
                'image'=> "required",
                'created_by'=> "required",
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $ads = Ads::where('title',$request->get('title'))->first();
            if($ads) {
                return $this->sendResultJSON(false, $request->get('title') ." this ads is already exist");
            }
            
            $ads = new Ads();
            $ads->category_id = $request->get('category');
            $ads->title = $request->get('title');
            $ads->description = $request->get('description');
            $ads->created_by = $request->get('created_by');
    
            if($request->file('image')) {
                $t=time();
                $file_name = $t."_ads.jpg";
                $path = $request->file('image')->move(public_path("/image/"),$file_name);
                $file_uri = url('/public/image/'.$file_name);
                $ads->image = $file_uri;
            }
            
            $ads->save();
            return $this->sendResultJSON(true, _("New Ads is add successfully.") ,$ads);
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
    
    function geCategoryAds(Request $request) {
        try {
             $element_array = array(
                'category_id'=> "required",
                'active_page' => "required"
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $total_records = Ads::where('category_id',$request->get('category_id'))->count();
            $ads = [];
            $total_records_to_fetch = request("per_page") ? (int)request("per_page") : 10;
            if(request("active_page")){
                $page = request("active_page") ? (int)request("active_page") : 1;
                $ads =  Ads::where('category_id',$request->get('category_id'))->skip((($page - 1) * $total_records_to_fetch))->take($total_records_to_fetch)->orderBy("created_at","desc")->get();
                
                foreach($ads as $ad) {
                    $category = Category::where("id",$request->get("category_id"))->first();
                    $user = User::where("id",$ad->created_by)->first();
                    $ad->category = $category->title;
                    $ad->created_by_user = $user->first_name .' '. $user->last_name;
                    
                }
            }
            return $this->sendResultJSON(true, __("Fetch catrgory ads successfully."),['ads' => $ads, 'total_records'=> $total_records, 'active_page' => $page]);
            
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
    
    function geMyAds(Request $request) {
        try {
             $element_array = array(
                'user_id'=> "required",
                'active_page' => "required"
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $total_records = Ads::where('created_by',$request->get('user_id'))->count();
            $ads = [];
            $total_records_to_fetch = request("per_page") ? (int)request("per_page") : 10;
            if(request("active_page")){
                $page = request("active_page") ? (int)request("active_page") : 1;
                $ads =  Ads::where('created_by',$request->get('user_id'))->skip((($page - 1) * $total_records_to_fetch))->take($total_records_to_fetch)->orderBy("created_at","desc")->get();
                
                foreach($ads as $ad) {
                    $category = Category::where("id",$ad->category_id)->first();
                    $user = User::where("id",$request->get('user_id'))->first();
                    $ad->category = $category->title;
                    $ad->created_by_user = $user->first_name .' '. $user->last_name;
                    
                }
            }
            return $this->sendResultJSON(true, __("Fetch catrgory ads successfully."),['ads' => $ads, 'total_records'=> $total_records, 'active_page' => $page]);
            
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
    
    function addAdsMenuImage(Request $request) {
        try {
             $element_array = array(
                'ads_id'=> "required",
                "image" => "required|image|mimes:jpeg,png,jpg|max:2048",
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $ads = AdsMenuImage::where('ads_id',$request->get('ads_id'))->first();
            if(!$ads) {
                $ads = new AdsMenuImage();
            }
            

            $t=time();
            $file_name = $t."_ads_menu.jpg";
            $path = $request->file('image')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            $ads->image = $file_uri;
            $ads->ads_id = $request->get('ads_id');
            $ads->save();
            return $this->sendResultJSON(true, _("New Ads image is add successfully.") ,$ads);
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
    
    function getAdsDetail(Request $request) {
        try {
             $element_array = array(
                'ads_id'=> "required"
             );
            $validator = Validator::make($request->all(), $element_array);

            if ($validator->fails()) {
                return $this->sendResultJSON(false, $validator->errors()->first());
            }
            
            $ads = Ads::with(['category','menu_images'])->where('id',$request->get('ads_id'))->first();
            if($ads) {
                return $this->sendResultJSON(true, _("Fetch ads detail.") ,$ads);
            }
            return $this->sendResultJSON(false, _("Invalid ads ID."));
            
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
}
