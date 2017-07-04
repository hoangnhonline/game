<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ArticlesCate;
use Helper, File, Session, Auth;

class ArticlesCateController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        $items = ArticlesCate::all()->sortBy('display_order');
        return view('backend.articles-cate.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {
        return view('backend.articles-cate.create');
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
            'slug' => 'required|unique:articles_cate,slug',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.',
        ]);

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        ArticlesCate::create($dataArr);

        Session::flash('message', 'Tạo mới danh mục thành công');

        return redirect()->route('articles-cate.index');
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
        $detail = ArticlesCate::find($id);

        return view('backend.articles-cate.edit', compact( 'detail' ));
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
            'slug' => 'required|unique:articles_cate,slug,'.$dataArr['id'],
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.'
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
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        $model = ArticlesCate::find($dataArr['id']);
        
        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật danh mục thành công');

        return redirect()->route('articles-cate.edit', $dataArr['id']);
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
        $model = ArticlesCate::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa danh mục thành công');
        return redirect()->route('articles-cate.index');
    }
}
