<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\LoaiSp;
use App\Models\Cate;
use App\Models\Customer;
use App\Models\ProductImg;
use App\Models\MetaData;
use App\Models\Tag;
use App\Models\TagObjects;

use Helper, File, Session, Auth, Hash, URL, Image;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {        
        
        $arrSearch['status'] = $status = isset($request->status) ? $request->status : 1; 
        $arrSearch['is_hot'] = $is_hot = isset($request->is_hot) ? $request->is_hot : null;              
        $arrSearch['loai_id'] = $loai_id = isset($request->loai_id) ? $request->loai_id : null;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : null;
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';        
        $cateArr = (object) [];


        $query = Product::where('product.status', $status);
       
        if( $loai_id ){
            $query->where('product.loai_id', $loai_id);
            $cateArr = Cate::where('loai_id', $loai_id)->orderBy('display_order', 'desc')->get();        
        }
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $is_hot ){
            $query->where('product.is_hot', $is_hot);
        }        
        
        if(Auth::user()->role == 1){
            $query->where('product.created_user', Auth::user()->id);
        }
        if( $name != ''){
            $query->where('product.name', 'LIKE', '%'.$name.'%');            
        }        

        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id'); 
        $query->join('loai_sp', 'product.loai_id', '=','loai_sp.id');
        $query->leftJoin('cate', 'product.cate_id', '=','cate.id'); 
        if($is_hot == 1){
            $query->orderBy('product.display_order', 'asc'); 
        }        
        $query->orderBy('product.id', 'desc');   
        $items = $query->select(['product_img.image_url as image_url','product.*', 
                'loai_sp.slug as slug_loai','loai_sp.name as ten_loai', 
                'cate.slug as slug_cate','cate.name as ten_cate'])->paginate(50);

       
        $loaiSpArr = LoaiSp::where('status', 1)->get(); 
        
        return view('backend.product.index', compact( 'items', 'arrSearch', 'loaiSpArr', 'cateArr'));        
    }

    public function kygui(Request $request)
    {

        $arrSearch['status'] = $status = 2; 
        
        $arrSearch['loai_id'] = $loai_id = isset($request->loai_id) ? $request->loai_id : null;
        $arrSearch['customer_id'] = $customer_id = isset($request->customer_id) ? $request->customer_id : null;
        $arrSearch['cate_id'] = $cate_id = isset($request->cate_id) ? $request->cate_id : null;
        $arrSearch['name'] = $name = isset($request->name) && trim($request->name) != '' ? trim($request->name) : '';        
        $cateArr = (object) [];


        $query = Product::where('product.status', $status);
       
        if( $loai_id ){
            $query->where('product.loai_id', $loai_id);
            $cateArr = Cate::where('loai_id', $loai_id)->orderBy('display_order', 'desc')->get();        
        }
        if( $cate_id ){
            $query->where('product.cate_id', $cate_id);
        }
        if( $customer_id ){
            $query->where('product.customer_id', $customer_id);
        }        
        if(Auth::user()->role == 1){
            $query->where('product.created_user', Auth::user()->id);
        }
        if( $name != ''){
            $query->where('product.name', 'LIKE', '%'.$name.'%');            
        }        

        $query->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id'); 
        $query->join('loai_sp', 'product.loai_id', '=','loai_sp.id');
        $query->join('customers', 'product.customer_id', '=','customers.id');
        $query->leftJoin('cate', 'product.cate_id', '=','cate.id'); 
           
        $query->orderBy('product.id', 'desc');   
        $items = $query->select(['product_img.image_url as image_url','product.*', 
                'loai_sp.slug as slug_loai','loai_sp.name as ten_loai', 
                'cate.slug as slug_cate','cate.name as ten_cate', 'customers.full_name'])->paginate(50);

       
        $loaiSpArr = LoaiSp::where('status', 1)->get(); 
        $memberList = Customer::all();
        return view('backend.product.kygui', compact( 'items', 'arrSearch', 'loaiSpArr', 'cateArr', 'memberList'));   
    }
    public function saveOrderHot(Request $request){
        $data = $request->all();
        if(!empty($data['display_order'])){
            foreach ($data['display_order'] as $id => $display_order) {
                $model = Product::find($id);
                $model->display_order = $display_order;
                $model->save();
            }
        }
        Session::flash('message', 'Cập nhật thứ tự tin HOT thành công');

        return redirect()->route('product.index', ['loai_id' => $data['loai_id'], 'cate_id' => $data['cate_id'], 'is_hot' => 1]);
    }
   

   
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
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
        return view('backend.product.create', compact('loaiSpArr', 'cateArr', 'loai_id', 'cate_id', 'tagArr'));
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
        $dataArr['created_user'] = Auth::user()->id;
        $dataArr['updated_user'] = Auth::user()->id;        
        
        $rs = Product::create($dataArr);

        $product_id = $rs->id;        

        $this->storeImage( $product_id, $dataArr);
        $this->storeMeta($product_id, 0, $dataArr);
        $this->processRelation($dataArr, $product_id);
        Session::flash('message', 'Add new success');

        return redirect()->route('product.index', ['loai_id' => $dataArr['loai_id'], 'cate_id' => $dataArr['cate_id']]);
    }
    private function processRelation($dataArr, $object_id, $type = 'add'){
    
        if( $type == 'edit'){
          
            TagObjects::deleteTags( $object_id, 1);            

        }
        // xu ly tags
        if( !empty( $dataArr['tags'] ) && $object_id ){
            foreach ($dataArr['tags'] as $tag_id) {
                TagObjects::create(['object_id' => $object_id, 'tag_id' => $tag_id, 'type' => 1]);
            }
        }
      
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
        //process old image
        $imageIdArr = isset($dataArr['image_id']) ? $dataArr['image_id'] : [];
        $hinhXoaArr = ProductImg::where('product_id', $id)->whereNotIn('id', $imageIdArr)->lists('id');
        if( $hinhXoaArr )
        {
            foreach ($hinhXoaArr as $image_id_xoa) {
                $model = ProductImg::find($image_id_xoa);
                $urlXoa = config('game.upload_path')."/".$model->image_url;
                if(is_file($urlXoa)){
                    unlink($urlXoa);
                }
                $model->delete();
            }
        }       

        //process new image
        if( isset( $dataArr['thumbnail_id'])){
            $thumbnail_id = $dataArr['thumbnail_id'];

            $imageArr = []; 

            if( !empty( $dataArr['image_tmp_url'] )){

                foreach ($dataArr['image_tmp_url'] as $k => $image_url) {

                    if( $image_url && $dataArr['image_tmp_name'][$k] ){

                        $tmp = explode('/', $image_url);

                        if(!is_dir('public/uploads/'.date('Y/m/d'))){
                            mkdir('public/uploads/'.date('Y/m/d'), 0777, true);
                        }
                        if(!is_dir('public/uploads/thumbs/'.date('Y/m/d'))){
                            mkdir('public/uploads/thumbs/'.date('Y/m/d'), 0777, true);
                        }

                        $destionation = date('Y/m/d'). '/'. end($tmp);
                        
                        File::move(config('game.upload_path').$image_url, config('game.upload_path').$destionation);

                        $imageArr['is_thumbnail'][] = $is_thumbnail = $dataArr['thumbnail_id'] == $image_url  ? 1 : 0;

                        if($is_thumbnail == 1){
                            $img = Image::make(config('game.upload_path').$destionation);
                            $w_img = $img->width();
                            $h_img = $img->height();
                            $tile = 0;
                            $w_tile = $w_img/170;
                            $h_tile = $h_img/170;
                         
                            if($w_tile - $h_tile <= 0){
                                Image::make(config('game.upload_path').$destionation)->resize(170, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                })->crop(170, 170)->save(config('game.upload_path').$destionation);
                            }else{
                                Image::make(config('game.upload_path').$destionation)->resize(null, 170, function ($constraint) {
                                        $constraint->aspectRatio();
                                })->crop(170, 170)->save(config('game.upload_path').$destionation);
                            }
                        }
                        $imageArr['name'][] = $destionation;

                        $imageArr['is_thumbnail'][] = $dataArr['thumbnail_id'] == $image_url  ? 1 : 0;
                    }
                }
            }
            if( !empty($imageArr['name']) ){
                foreach ($imageArr['name'] as $key => $name) {
                    $rs = ProductImg::create(['product_id' => $id, 'image_url' => $name, 'display_order' => 1]);                
                    $image_id = $rs->id;
                    if( $imageArr['is_thumbnail'][$key] == 1){
                        $thumbnail_id = $image_id;
                    }
                }
            }
            $model = Product::find( $id );
            $model->thumbnail_id = $thumbnail_id;
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
       

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
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
}
