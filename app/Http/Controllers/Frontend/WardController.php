<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ward;
use Helper, File, Session, Auth;
use Mail;

class WardController extends Controller
{

    /**
    * Session products define array [ id => quantity ]
    *
    */

    public function __construct(){

    }
    public function getWard(Request $request)
    {
        $district_id = $request->id;
        $listward = Ward::where('district_id', $district_id)->orderBy('display_order')->get();
        return response()->json($listward);
    }

}
