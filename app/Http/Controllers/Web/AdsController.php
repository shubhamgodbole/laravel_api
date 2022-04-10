<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ads;
class AdsController extends Controller
{
    function getAds() {
        $ads = Ads::with('category')->get();
        return view('ads/ads')->with('ads',$ads); 
    }
    
    function add_ads() {
        $category = Category::all();
        return view('ads/addads')->with('category',$category); 
    }
    
    function addAds(Request $request) {
        $validator = $request->validate([
            'title' => 'required',
        ]);

        $ads = Ads::where('title',$request->get('title'))->first();
        if($ads) {
            $notification = array(
                'message' => $request->get('title') ." this ads is already exist", 
                'alert-type' => 'error'
            );  

            return redirect()->back()->with($notification);
        }
        $ads = new Ads();
        $ads->category_id = $request->get('category');
        $ads->title = $request->get('title');
        $ads->description = $request->get('description');

        if($request->file('image')) {
            $t=time();
            $file_name = $t."_ads.jpg";
            $path = $request->file('image')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            //return $file_uri;
            $ads->image = $file_uri;
        }
        
        $ads->save();
        
        
        $notification = array(
            'message' => 'New Ads is add successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('ads')->with($notification);

    }
    
    function editAds($id) {
        $ads = Ads::find($id);
        $category = Category::all();
        return view('/ads/editads')->with('edit_data',$ads)->with('category',$category);
    }
    
    function updateAds(Request $request) {
        $validator = $request->validate([
            'id' => 'required',
            'title' => 'required',
        ]);

        $ads = Ads::find($request->get('id'));
        $ads->title = $request->get('title');
        $ads->description = $request->get('description');
        $ads->category_id = $request->get('category');
        if($request->file('image')) {
            $t=time();
            $file_name = $t."_ads.jpg";
            $path = $request->file('image')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            //return $file_uri;
            $ads->image = $file_uri;
        }
        
        $ads->save();
        

        $notification = array(
            'message' => 'Ads is updated successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('ads')->with($notification);

    }
    
    function deletAds($id) {
        $ads = Ads::find($id);
        $ads->delete();
        
        
        $notification = array(
            'message' => 'Ads is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/ads')->with($notification);
    }
    
    function changeRecommandedStatus($id) {
        $ads = Ads::find($id);
        $ads->is_recommanded = !$ads->is_recommanded;
        $ads->save();
        
        $notification = array(
            'message' => 'Change status successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/ads')->with($notification);
    }
    
    function changeActivationStatus($id) {
        $ads = Ads::find($id);
        $ads->is_active = !$ads->is_active;
        $ads->save();
        
        $notification = array(
            'message' => 'Change status successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/ads')->with($notification);
    }
}
