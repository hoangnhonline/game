<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use Helper, File, Session, Auth;

class AdsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $type = isset($request->type) ? $request->type : null;

        if(Auth::user()->role == 1){
            return redirect()->route('product.index');
        }
        $arrSearch['status'] = $status = isset($request->status) ? $request->status : null;      
       
        $query = Ads::where(['status'=>1]);
        if( $type ){
            $query->where('type', $type);
        }
       
        $items = $query->orderBy('id', 'desc')->get();
       // dd($items->count());die;
        return view('backend.ads.index', compact( 'items', 'type'));
    }
    public function lists(Request $request){
        return view('backend.ads.list');   
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $detail = (object) [];
        
        return view('backend.ads.create');
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
        
        $this->validate($request,[
            'type' => 'required',
            'name' => 'required',
            'ads_code' => 'required_if:type,==,2',
            'image_url' => 'required_if:type,==,1',    
        ],
        [
            'type.required' => 'Bạn chưa chọn loại ads',
            'name.required' => 'Bạn chưa nhập name',
            'ads_code.required_if' => 'Bạn chưa nhập ads code',
            'image_url.required_if' => 'Bạn chưa upload banner',
        ]);
        
        $dataArr['status'] = isset($dataArr['status'])  ? 1 : 0;
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('public/uploads/'.date('Y/m/d'))){
                mkdir('public/uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('game.upload_path').$dataArr['image_url'], config('game.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        Ads::create($dataArr);

        Session::flash('message', 'Tạo mới ads thành công');

        return redirect()->route('ads.index');
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
        $detailBanner = Ads::find($id);
        $detail = Ads::find($id);
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
        return view('backend.ads.edit', compact( 'detail', 'detailBanner', 'object_id', 'object_type'));
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

            if(!is_dir('public/uploads/'.date('Y/m/d'))){
                mkdir('public/uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('game.upload_path').$dataArr['image_url'], config('game.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }
        
        $model = Ads::find($dataArr['id']);

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật banner thành công');

        return redirect()->route('ads.index', ['object_id' => $dataArr['object_id'], 'object_type' => $dataArr['object_type']]);
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
        $model = Ads::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa banner thành công');
        return redirect()->route('ads.index', ['object_type' => $model->object_type, 'object_id' => $model->object_id]);
    }
}
