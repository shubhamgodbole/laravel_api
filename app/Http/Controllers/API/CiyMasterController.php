<?php

namespace App\Http\Controllers\API;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CityMaster;
class CiyMasterController extends Controller
{
    function getCityMasterData() {
        try {
            $citymaster = CityMaster::where('is_active',1)->get();
            return $this->sendResultJSON(true, _("Fetch cities successfully.") ,$citymaster);
         }
         catch (\Exception $e) {
             return $this->sendResultJSON(false, $e->getMessage());
         }
    }
}
