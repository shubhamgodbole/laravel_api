<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PgPriceDetail;
use App\Models\Pgdetail;

class DiscountController extends Controller
{
    function getDiscounts() {
        $discountDetail = Pgdetail::where('is_active',1)->with('pg_pricing')->get();

        return view('/managediscount/discounts')->with('discountDetail',$discountDetail); 
    }

    function editDiscount($id) {
        $discountDetail = Pgdetail::where('id',$id)->with('pg_pricing')->first();

        return view('/managediscount/editdiscount')->with('edit_data',$discountDetail); 
    }

    function updateDiscount(Request $request) {
        $validator = $request->validate([
            'id' => 'required',
        ]);
        $priceDetail = PgPriceDetail::where('pg_id',$request->get('id'))->first();
        $priceDetail->discount = $request->get('discount');
        $priceDetail->save();

        $notification = array(
            'message' => 'PG is update successfully', 
            'alert-type' => 'success'
        );  
        return redirect('/discounts')->with($notification);
    }
}
