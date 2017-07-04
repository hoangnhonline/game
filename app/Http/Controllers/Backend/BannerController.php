<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\LoaiSp;
use App\Models\Cate;
use App\Models\LandingProjects;
use Helper, File, Session, Auth;

class BannerController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        if(Auth::user()->role == 1){
            return redirect()->route('product.index');
        }
        $arrSearch['status'] = $status = isset($request->status) ? $request->status : null;
        $arrSearch['object_id'] = $object_id = $request->object_id;
        $arrSearch['object_type'] = $object_type = $request->object_type;
        $detail = (object) [];
        if( $object_type == 1){
            $detail = LoaiSp::find( $object_id );
        }
        if( $object_type == 2){
            $detail = Cate::find( $object_id );
        }
        
        if( $object_type == 3){
            if( $object_id == 1){
                $detail->name = "Slide trang chủ";
            }elseif( $object_id == 2){
                $detail->name = "Album ảnh trang chủ";
            }elseif( $object_id == 3){
                $detail->name = "Banner trượt bên phải";
            }elseif( $object_id == 4){
                $detail->name = "Banner top ( cạnh logo )";
            }            
        }
        if($object_type == 4){
            $detail = LandingProjects::find($object_id);
        }
        $query = Banner::where(['object_id'=>$object_id, 'object_type' => $object_type]);
        if( $status ){
            $query->where('status', $status);
        }
       
        $items = $query->orderBy('display_order')->get();
       // dd($items->count());die;
        return view('backend.banner.index', compact( 'items', 'detail', 'arrSearch'));
    }
    public function lists(Request $request){
        return view('backend.banner.list');   
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $detail = (object) [];
        $object_id = $request->object_id;
        $object_type = $request->object_type;
        if( $object_type == 1){
            $detail = LoaiSp::find( $object_id );
        }
        if( $object_type == 2){
            $detail = Cate::find( $object_id );
        }
         if( $object_type == 3){
            if( $object_id == 1){
                $detail->name = "Slide trang chủ";
            }elseif( $object_id == 2){
                $detail->name = "Album ảnh trang chủ";
            }elseif( $object_id == 3){
                $detail->name = "Banner trượt bên phải";
            }elseif( $object_id == 4){
                $detail->name = "Banner top ( cạnh logo )";
            }               
        }
        if($object_type == 4){
            $detail = LandingProjects::find($object_id);
        }
        return view('backend.banner.create', compact('object_id', 'object_type', 'detail'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        /*$this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
        ]);
        */
        $dataArr['status'] = isset($dataArr['status'])  ? 1 : 0;
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('icho.upload_path').$dataArr['image_url'], config('icho.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;
        Banner::create($dataArr);

        Session::flash('message', 'Tạo mới banner thành công');

        return redirect()->route('banner.index', ['object_id' => $dataArr['object_id'], 'object_type' => $dataArr['object_type']]);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit(Request $request)
    {
        $id = $request->id;
        $detailBanner = Banner::find($id);
        $detail = Banner::find($id);
        $object_id = $request->object_id;
        $object_type = $request->object_type;
        if( $object_type == 1){
            $detail = LoaiSp::find( $object_id );
        }
        if( $object_type == 2){
            $detail = Cate::find( $object_id );
        }
        if($object_type == 4){
            $detail = LandingProjects::find($object_id);
        }
        return view('backend.banner.edit', compact( 'detail', 'detailBanner', 'object_id', 'object_type'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        
        $dataArr['updated_user'] = Auth::user()->id;
        $dataArr['status'] = isset($dataArr['status'])  ? 1 : 0;

        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('icho.upload_path').$dataArr['image_url'], config('icho.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }
        
        $model = Banner::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật banner thành công');

        return redirect()->route('banner.index', ['object_id' => $dataArr['object_id'], 'object_type' => $dataArr['object_type']]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Banner::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa banner thành công');
        return redirect()->route('banner.index', ['object_type' => $model->object_type, 'object_id' => $model->object_id]);
    }
}
