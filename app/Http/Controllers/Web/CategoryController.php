<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    function getCategory() {
        $category = Category::all();
        return view('category/category')->with('category',$category); 
    }

function addCategory(Request $request) {
        $validator = $request->validate([
            'title' => 'required',
        ]);

        $category = Category::where('title',$request->get('title'))->first();
        if($category) {
            $notification = array(
                'message' => $request->get('title') ." this category is already exist", 
                'alert-type' => 'error'
            );  

            return redirect()->back()->with($notification);
        }
        $category = new Category();
        $category->title = $request->get('title');
        $category->description = $request->get('description');

        if($request->file('icon')) {
            $t=time();
            $file_name = $t."_category.jpg";
            $path = $request->file('icon')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            //return $file_uri;
            $category->icon = $file_uri;
        }
        
        $category->save();
        
        
        $notification = array(
            'message' => 'New category is add successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('categories')->with($notification);

    }
    
    function editCategory($id) {
        $category = Category::find($id);
        return view('/category/editcategory')->with('edit_data',$category);
    }
    function updateCategory(Request $request) {
        $validator = $request->validate([
            'id' => 'required',
            'title' => 'required',
        ]);

        $category = Category::find($request->get('id'));
                $category->title = $request->get('title');
        $category->description = $request->get('description');

        if($request->file('icon')) {
            $t=time();
            $file_name = $t."_category.jpg";
            $path = $request->file('icon')->move(public_path("/image/"),$file_name);
            $file_uri = url('/public/image/'.$file_name);
            //return $file_uri;
            $category->icon = $file_uri;
        }
        
        $category->save();
        

        $notification = array(
            'message' => 'Category is updated successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('categories')->with($notification);

    }
    
    function deletCategory($id) {
        $category = Category::find($id);
        $category->delete();
        
        // meta_data change
        updateMetaData();
        
        $notification = array(
            'message' => 'Category is deleted successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/categories')->with($notification);
    }
}
