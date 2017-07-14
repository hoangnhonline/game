<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CustomLink;

use Helper, File, Session, Auth, Image;

class CustomLinkController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $block_id = isset($request->block_id) ? $request->block_id : 1;

        if($block_id == 1){
            $name = "Liên kết nổi bật";
        }elseif($block_id == 2){
            $name = "Link footer";
        }
        $query = CustomLink::whereRaw('1');

        if( $block_id > 0){
            $query->where('block_id', $block_id);
        }
       
        $items = $query->orderBy('display_order', 'asc')->paginate(100);
        
        return view('backend.custom-link.index', compact( 'items', 'block_id', 'name' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {

        $block_id = isset($request->block_id) ? $request->block_id : 1;
        if($block_id == 1){
            $name = "Liên kết nổi bật";
        }elseif($block_id == 2){
            $name = "Link footer";
        }
        return view('backend.custom-link.create', compact('block_id', 'name'));
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
            'link_text' => 'required',            
            'link_url' => 'required'            
        ],
        [            
            'link_text.required' => 'Bạn chưa nhập text hiển thị',            
            'link_url.required' => 'Bạn chưa nhập URL'
        ]);   

        $rs = CustomLink::create($dataArr);

        Session::flash('message', 'Tạo mới link thành công');

        return redirect()->route('custom-link.index', ['block_id' => $dataArr['block_id']]);
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
        $detail = CustomLink::find($id);
        $block_id = $detail->block_id;
        if($block_id == 1){
            $name = "Liên kết nổi bật";
        }elseif($block_id == 2){
            $name = "Link footer";
        }
        return view('backend.custom-link.edit', compact('detail', 'block_id', 'name'));
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
            'link_text' => 'required',            
            'link_url' => 'required'            
        ],
        [            
            'link_text.required' => 'Bạn chưa nhập text hiển thị',            
            'link_url.required' => 'Bạn chưa nhập URL'
        ]);       
        
        $model = CustomLink::find($dataArr['id']);

        $model->update($dataArr);        
        
        Session::flash('message', 'Cập nhật link thành công');        

        return redirect()->route('custom-link.index', ['block_id' => $dataArr['block_id']]);
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
        $model = CustomLink::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa link thành công');
        return redirect()->route('custom-link.index');
    }
}
