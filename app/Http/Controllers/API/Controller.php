<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use App\Models\MetaDataChange;
class Controller extends BaseController
{
    var $success_code = 200;
    public function sendResultJSON($status, $msg = null, $data = array())
    {
        $MetaDataChange = MetaDataChange::first();
      if($status) {
            return response()->json(['status' => $status, 'message' => $msg,'meta_data_change_date' => $MetaDataChange->meta_data_change_date,'latest_meta_data_change_date' => $MetaDataChange->latest_meta_data_change_date, 'data' => $data], $this->success_code);
        }
        else {
            return response()->json(['status' => $status, 'message' => $msg], $this->success_code);
        }
    }
}