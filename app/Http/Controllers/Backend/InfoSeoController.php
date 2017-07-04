<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\InfoSeo;
use Helper, File, Session, Auth;

class InfoSeoController extends Controller
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
        $query = InfoSeo::whereRaw('1');

       
        $items = $query->orderBy('id', 'desc')->paginate(20);
        
      
        return view('backend.info-seo.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {          

        return view('backend.info-seo.create');
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
            'title' => 'required',
            'url' => 'required|unique:info_seo,url',
        ],
        [               
            'title.required' => 'Bạn chưa nhập meta title',
            'url.required' => 'Bạn chưa nhập URL',
            'url.unique' => 'URL đã được tồn tại.'
        ]);       
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('icho.upload_path').$dataArr['image_url'], config('icho.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }                
      
        $rs = InfoSeo::create($dataArr);        

        Session::flash('message', 'Tạo mới thông tin SEO thành công');

        return redirect()->route('info-seo.index');
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

        $detail = InfoSeo::find($id);

        return view('backend.info-seo.edit', compact('detail'));
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
            'title' => 'required',            
            'url' => 'required|unique:info_seo,url,'.$dataArr['id'],
        ],
        [               
            'title.required' => 'Bạn chưa nhập meta title',           
            'url.required' => 'Bạn chưa nhập URL',
            'url.unique' => 'URL đã được tồn tại.'
        ]); 

        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('icho.upload_path').$dataArr['image_url'], config('icho.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }       

        $model = InfoSeo::find($dataArr['id']);

        $model->update($dataArr);
       
        Session::flash('message', 'Cập nhật thông tin SEO thành công');        

        return redirect()->route('info-seo.edit', $dataArr['id']);
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
        $model = InfoSeo::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa thông tin SEO thành công');
        return redirect()->route('info-seo.index');
    }
}