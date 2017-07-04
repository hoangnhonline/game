<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
class UploadController extends Controller
{
    public function tmpUpload(Request $request){
        $rsUpload = [];
        if ($request->ajax())
        {
        	$dataArr = $request->all();
            $date_dir = $dataArr['date_dir'] == 1 ? true : false;
            
            if($dataArr['file']){

                $rsUpload = Helper::uploadPhoto($dataArr['file'], $dataArr['folder'], $date_dir);
            }
        }
        return response()->json($rsUpload);
    }
    public function tmpUploadMultiple(Request $request){
        $rsUpload = [];
        if ($request->ajax())
        {
            $dataArr = $request->all();
            $date_dir = $dataArr['date_dir'] == 1 ? true : false;
            
            if($dataArr['file']){
                foreach( $dataArr['file'] as $file ){
                    $rsUpload[] = Helper::uploadPhoto($file, $dataArr['folder'], $date_dir);
                }
            }
        }
        return view('backend.product.upload-image', compact( 'rsUpload' ));
    }
    public function tmpUploadMultipleFE(Request $request){
        $rsUpload = [];
        if ($request->ajax())
        {
            $dataArr = $request->all();
            $date_dir = $dataArr['date_dir'] == 1 ? true : false;
            
            if($dataArr['file']){
                foreach( $dataArr['file'] as $file ){
                    $rsUpload[] = Helper::uploadPhoto($file, $dataArr['folder'], $date_dir);
                }
            }
        }
        return view('backend.product.upload-image-fe', compact( 'rsUpload' ));
    }
    public function ckUpload(Request $request){
        $allowedExts = array("jpg", "jpeg", "gif", "png", 'JPG', 'PNG', 'JPEG', 'GIF');
        $arrResult = array();

        $dataArr = $request->all();
        $count = 0;
        if($dataArr['myfile']){
            
            $url = config('icho.upload_url');

            foreach( $dataArr['myfile'] as $file ){
                $count++;
                $tmp = Helper::uploadPhoto($file, 'post', true);
                $hinh = $url ."/". $tmp['image_path'];
                $arrReturn[]['filename'] = $hinh;  
            }
        }
        
        $arrResult['fileList'] = $arrReturn;
        
        if($count==0){
            $arrResult['fileList'] = array();
        }
        echo json_encode($arrResult);
    }
    
}
