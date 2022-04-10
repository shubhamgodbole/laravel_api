<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CancellationPloicy;

class CancellationPolicyController extends Controller
{
    function getPolicy() {
        $ploicies = CancellationPloicy::all();
        return view('/cancellationpolicy/cancellationpolicy')->with('ploicies',$ploicies);
    }

    function editPolicyView($id) {
        $ploicies = CancellationPloicy::find($id);
        return view('/cancellationpolicy/editpolicy')->with('edit_data',$ploicies);
    }

    function updatePolicy(Request $request) {
        $ploicies = CancellationPloicy::find($request->get('id'));
        $ploicies->title = $request->get('title');
        $ploicies->day1 = $request->get('day1');
        $ploicies->day15 = $request->get('day15');
        $ploicies->day30 = $request->get('day30');
        $ploicies->save();

        $notification = array(
            'message' => 'Policy is update successfully', 
            'alert-type' => 'success'
        );  
        
        return redirect('cancellation_policy')->with($notification);
    }
}
