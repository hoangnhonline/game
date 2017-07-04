<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LoaiSp;
use App\Models\MetaData;
use App\Models\LoaiThuocTinh;
use App\Models\ThuocTinh;
use App\Models\HoverInfo;

use Helper, File, Session, Auth;

class LoaiSpController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {        
        $items = LoaiSp::where('status', 1)->orderBy('display_order', 'asc')->get();
        return view('backend.loai-sp.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        return view('backend.loai-sp.create');
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
            'name' => 'required',
            'slug' => 'required'            
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug'            
        ]);       
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
       
        
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;    
           
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;
        $rs = LoaiSp::create($dataArr);
        $id = $rs->id;

        $this->storeMeta( $id, 0, $dataArr);

        Session::flash('message', 'Tạo mới danh mục thành công');

        return redirect()->route('loai-sp.index');
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
    public function edit($id)
    {
        $detail = LoaiSp::find($id);

        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }

        return view('backend.loai-sp.edit', compact( 'detail', 'meta'));
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
        
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required'           
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug'            
        ]);      

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        

        $dataArr['updated_user'] = Auth::user()->id;
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;          

        $model = LoaiSp::find($dataArr['id']);
        $model->update($dataArr);

        $this->storeMeta( $dataArr['id'], $dataArr['meta_id'], $dataArr);

        Session::flash('message', 'Cập nhật danh mục thành công');

        return redirect()->route('loai-sp.edit', $dataArr['id']);
    }
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = [ 'title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id ];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;            
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            
            $modelSp = LoaiSp::find( $id );
            $modelSp->meta_id = $meta_id;
            $modelSp->save();
        }else {
            $model = MetaData::find($meta_id);           
            $model->update( $arrData );
        }              
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
        $model = LoaiSp::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa danh mục thành công');
        return redirect()->route('loai-sp.index');
    }

}
