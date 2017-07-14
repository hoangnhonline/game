<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\LoaiSp;
use App\Models\Cate;
use App\Models\ProductImg;
use App\Models\MetaData;
use App\Models\Tag;
use App\Models\TagObjects;

use Helper, File, Session, Auth, Hash, URL, Image;

class UsersController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    { 
        $customer_id = Session::get('userId');
        $query = Product::where('product.customer_id', $customer_id);

        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id'); 
        $query->join('loai_sp', 'product.loai_id', '=','loai_sp.id');
        $query->leftJoin('cate', 'product.cate_id', '=','cate.id'); 
             
        $query->orderBy('product.id', 'desc');   
        $items = $query->select(['product_img.image_url as image_url','product.*', 
                'loai_sp.slug as slug_loai','loai_sp.name as ten_loai', 
                'cate.slug as slug_cate','cate.name as ten_cate'])->paginate(50);
        
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Manage game";   

        return view('frontend.users.list', compact( 'items', 'seo'));        
    }
   
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function upload(Request $request)
    {
        $tagArr = Tag::where('type', 1)->get();        
        
        $loai_id = $request->loai_id ? $request->loai_id : null;
        $cate_id = $request->cate_id ? $request->cate_id : null;
        $cateArr = (object) [];        
        $loaiSpArr = LoaiSp::where('status', 1)->get();
        $tagArr = Tag::where('type', 1)->get();
        if( $loai_id ){
            
            $cateArr = Cate::where('loai_id', $loai_id)->select('id', 'name')->orderBy('display_order', 'desc')->get();           
            
        }      

        $seo['title'] = $seo['description'] = $seo['keywords'] = "Upload";       
        return view('frontend.users.upload', compact('loaiSpArr', 'cateArr', 'loai_id', 'cate_id', 'tagArr', 'seo'));
    }
    public function destroy($id)
    {
        // delete
        $model = Product::find($id);        
        $model->delete();
        ProductImg::where('product_id', $id)->delete();
        TagObjects::deleteTags( $id, 1);        
        // redirect
        Session::flash('message', 'Delete success.');
        
        return redirect(URL::previous());//->route('product.short');
        
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
            'loai_id' => 'required',
            'cate_id' => 'required',            
            'name' => 'required'            
        ],
        [            
            'loai_id.required' => 'Please select type',           
            'cate_id.required' => 'Please select category',           
            'name.required' => 'Please input name'                      
        ]);
        $dataArr['slug'] = str_slug($dataArr['slug']);
        $dataArr['slug'] = str_replace(".", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace("(", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace(")", "", $dataArr['slug']);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;
        
        $dataArr['status'] = 2; // chua duyet        
        $dataArr['customer_id'] = Session::get('userId');        
        
        $rs = Product::create($dataArr);

        $product_id = $rs->id;        

        $this->storeImage( $product_id, $dataArr);

        Session::flash('message', 'Upload success.');

        return redirect()->route('upload');
    }
    
    public function storeMeta( $id, $meta_id, $dataArr ){
       
        $arrData = ['title' => $dataArr['meta_title'], 'description' => $dataArr['meta_description'], 'keywords'=> $dataArr['meta_keywords'], 'custom_text' => $dataArr['custom_text'], 'updated_user' => Auth::user()->id];
        if( $meta_id == 0){
            $arrData['created_user'] = Auth::user()->id;
            //var_dump(MetaData::create( $arrData ));die;
            $rs = MetaData::create( $arrData );
            $meta_id = $rs->id;
            //var_dump($meta_id);die;
            $modelSp = Product::find( $id );
            $modelSp->meta_id = $meta_id;
            $modelSp->save();
        }else {
            $model = MetaData::find($meta_id);           
            $model->update( $arrData );
        }              
    }   

    public function storeImage($id, $dataArr){ 

        if($dataArr['image_url'] && $dataArr['image_name']){
        
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }
            
            $destionation = date('Y/m/d'). '/'. end($tmp);
            File::move(config('game.upload_path').$dataArr['image_url'], config('game.upload_path').$destionation);
            Image::make(config('game.upload_path').$destionation)->resize(170, 170)->save(config('game.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
            
            $rs = ProductImg::create(['product_id' => $id, 'image_url' => $dataArr['image_url'], 'display_order' => 1]);                
            $image_id = $rs->id;         
            
            $model = Product::find( $id );
            $model->thumbnail_id = $image_id;
            $model->save();
        }

   
    
       
    }
   
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {        
        $tagArr = Tag::where('type', 1)->get();
        $hinhArr = (object) [];
        $detail = Product::find($id);
       
        $hinhArr = ProductImg::where('product_id', $id)->lists('image_url', 'id');     
        $loaiSpArr = LoaiSp::where('status', 1)->get();
        
        $loai_id = $detail->loai_id;             
        $detailLoai = LoaiSp::find($loai_id);
        if( $loai_id ){
            
            $cateArr = Cate::where('loai_id', $loai_id)->select('id', 'name')->orderBy('display_order', 'desc')->get();           
            
        }    
        $meta = (object) [];
        if ( $detail->meta_id > 0){
            $meta = MetaData::find( $detail->meta_id );
        }               

        $tagSelected = Product::productTag($id);                
        
        return view('backend.product.edit', compact( 'detail', 'hinhArr', 'loaiSpArr',  'meta', 'tagSelected', 'tagArr', 'detailLoai', 'cateArr'));
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
            'loai_id' => 'required',
            'cate_id' => 'required',            
            'name' => 'required',
            'slug' => 'required'            
        ],
        [            
            'loai_id.required' => 'Please select type',           
            'cate_id.required' => 'Please select category',           
            'name.required' => 'Please input name',
            'slug.required' => 'Please input slug'           
        ]);
           
        $dataArr['slug'] = str_replace(".", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace("(", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace(")", "", $dataArr['slug']);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        $dataArr['is_hot'] = isset($dataArr['is_hot']) ? 1 : 0;        
        $dataArr['status'] = 1;
        
        $dataArr['updated_user'] = Auth::user()->id;   
        
        
        $model = Product::find($dataArr['id']);

        $model->update($dataArr);
        
        $product_id = $dataArr['id'];
        
        $this->storeMeta( $product_id, $dataArr['meta_id'], $dataArr);
        $this->storeImage( $product_id, $dataArr);
        $this->processRelation($dataArr, $product_id, 'edit');

        Session::flash('message', 'Update success.');

        return redirect()->route('product.edit', $product_id);
        
    }      

}
