<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\District;
use App\Models\MetaData;
use Helper, File, Session, Auth;

class TagController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {     
        
        $type = isset($request->type) ? $request->type : 1;

        $name = isset($request->name) && $request->name != '' ? $request->name : '';
        $district_id = isset($request->district_id) && $request->district_id != '' ? $request->district_id : 0;

        $query = Tag::where('type', $type);
        if( $name !='' ){
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        
        $items = $query->orderBy('id', 'desc')->paginate(50);
        
        return view('backend.tag.index', compact( 'items', 'type', 'name', 'district_id'));
    }
    public function ajaxList(Request $request){

        $tagSelected = (array) $request->tagSelected;
        
        $str_id = $request->str_id;
        $tmpArr = explode(",", $str_id);
        $tagSelected = array_merge($tagSelected, $tmpArr);

        $type = isset($request->type) ? $request->type : 1;

        $query = Tag::where('type', $type);
        
        $tagArr = $query->orderBy('id', 'desc')->get();
       
        return view('backend.tag.ajax-list', compact( 'tagArr', 'type', 'tagSelected'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        $type = $request->type ? $request->type : 1;
        return view('backend.tag.create', compact('type'));
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
            'slug' => 'required|unique:tag,slug,NULL,id,type,'.$dataArr['type'],
        ],
        [
            'name.required' => 'Bạn chưa nhập tag',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.',
        ]);

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        $rs = Tag::create($dataArr);
        
        $object_id = $rs->id;

        $this->storeMeta( $object_id, 0, $dataArr);

        Session::flash('message', 'Tạo mới tag thành công');

        return redirect()->route('tag.index', [ 'type' => $dataArr['type'] ]);
    }

    public function ajaxSave(Request $request)
    {
        $dataArr = $request->all();
        
        $str_tag = $request->str_tag;

        $type = $request->type;

        $tmpArr = explode(';', $str_tag);

        if( !empty($tmpArr) ){
            foreach ($tmpArr as $tag) {
                
            $tag = trim($tag);
            if( $tag != ""){
                // check xem co chua
                $arr = Tag::where('name', '=', $tag)->where('type', $type)->first();
                if( !empty( (array) $arr)) {
                    $arrId[] = $arr->id;
                }else{
                    $rs = Tag::create(['name'=> $tag, 'type' => $type, 'slug' => str_slug($tag), 'created_user' => Auth::user()->id, 'updated_user' => Auth::user()->id]);
                    $arrId[] = $rs->id;
                }

            }
            }   
        }

        return implode(',', $arrId);

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
        $detail = Tag::find($id);
        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }       

        return view('backend.tag.edit', compact( 'detail', 'meta'));
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
            'slug' => 'required|unique:tag,slug,'.$dataArr['id'].',id,type,'.$dataArr['type'],
        ],
        [
            'name.required' => 'Bạn chưa nhập tag',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.',
        ]);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        $model = Tag::find($dataArr['id']);        

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        if( $dataArr['meta_id'] != '' ){

            $this->storeMeta( $dataArr['id'], $dataArr['meta_id'], $dataArr);
        }

        Session::flash('message', 'Cập nhật tag thành công');

        return redirect()->route('tag.index', [ 'type' => $dataArr['type'] ]);
    }
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = [ 'title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id ];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;            
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            
            $modelSp = Tag::find( $id );
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
        $model = Tag::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa tag thành công');
        return redirect()->route('tag.index');
    }
}