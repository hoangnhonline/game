<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\District;
use Helper, File, Session, Auth;
use Mail;

class DistrictController extends Controller
{

    /**
    * Session products define array [ id => quantity ]
    *
    */

    public function __construct(){

    }
    public function getDistrict(Request $request)
    {
        $city_id = $request->id;
        $listward = District::where('city_id', $city_id)->orderBy('display_order')->get();
        return response()->json($listward);
    }

}
