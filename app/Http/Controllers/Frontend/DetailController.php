<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Product;
use App\Models\District;
use App\Models\Ward;
use App\Models\Street;
use App\Models\Project;
use App\Models\LoaiSp;
use App\Models\MetaData;
use App\Models\ProductImg;
use App\Models\Tag;
use App\Models\TagObjects;
use App\Models\Direction;
use App\Models\PriceUnit;
use App\Models\Articles;


use Helper, File, Session, Auth, Image;

class DetailController extends Controller
{
    
    public static $loaiSp = []; 
    public static $loaiSpArrKey = [];    

    public function __construct(){
        
       

    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        $spThuocTinhArr = $productArr = [];
        $slug = $request->slug;
        $id = $request->id;
        $detail = Product::find($id);
        if(!$detail){
            return redirect()->route('home');
        }
        $rsLoai = LoaiSp::find( $detail->loai_id );

        $hinhArr = ProductImg::where('product_id', $detail->id)->get()->toArray();

        $district_id = $detail->district_id;
        if( $detail->meta_id > 0){
           $meta = MetaData::find( $detail->meta_id )->toArray();
           $seo['title'] = $meta['title'] != '' ? $meta['title'] : $detail->title;
           $seo['description'] = $meta['description'] != '' ? $meta['description'] : $detail->title;
           $seo['keywords'] = $meta['keywords'] != '' ? $meta['keywords'] : $detail->title;
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $detail->title;
        }               
        
        if($detail->thumbnail_id > 0){
            $socialImage = ProductImg::find($detail->thumbnail_id)->image_url;
        }

        $otherList = Product::where('product.slug', '<>', '')                  
                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')            
                    ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')      
                    ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai', 'loai_sp.name as ten_loai')
                    ->where('product.id', '<>', $detail->id)
                    ->orderBy('product.id', 'desc')->limit(5)->get();
        return view('frontend.detail.index', compact('detail', 'rsLoai', 'hinhArr', 'productArr', 'seo', 'socialImage', 'otherList', 'tagSelected' ));
    }
    public function tagDetail(Request $request){
        $slug = $request->slug;
        $detail = Tag::where('slug', $slug)->first();
        if($detail->type == 1 || $detail->type == 3){ // product           
            $productList = (object)[];
            $listId = [];
            $listId = TagObjects::where(['type' => $detail->type, 'tag_id' => $detail->id])->lists('object_id');
            if($listId){
                $listId = $listId->toArray();
            }
            if(!empty($listId)){
            $query = Product::where('product.status', 1)            
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id') 
                ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')
                ->select('product_img.image_url as image_urls', 'product.*', 'loai_sp.slug as slug_loai')
                ->where('product_img.image_url', '<>', '')
                ->whereIn('product.id', $listId)
                ->orderBy('product.cart_status', 'asc')
                ->orderBy('product.id', 'desc');
                $productList  = $query->limit(36)->get();

            }
            
            if( $detail->meta_id > 0){
               $seo = MetaData::find( $detail->meta_id )->toArray();
               $seo['title'] = $seo['title'] != '' ? $seo['title'] : 'Tag - '. $detail->name;
               $seo['description'] = $seo['description'] != '' ? $seo['description'] : 'Tag - '. $detail->name;
               $seo['keywords'] = $seo['keywords'] != '' ? $seo['keywords'] : 'Tag - '. $detail->name;
               $seo['custom_text'] = $seo['custom_text'];
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = 'Tag - '. $detail->name;
            }
            
            return view('frontend.cate.tag', compact('productList', 'socialImage', 'seo', 'detail'));
        }elseif($detail->type == 2){ // articles
            $articlesArr = (object)[];
            $listId = [];
            $listId = TagObjects::where(['type' => 2, 'tag_id' => $detail->id])->lists('object_id');
            if($listId){
                $listId = $listId->toArray();
            }
            if(!empty($listId)){
                $articlesArr = Articles::whereIn('id', $listId)->orderBy('id', 'desc')->where('cate_id', '<>', 999)->paginate(20);
            }  

            if( $detail->meta_id > 0){
               $seo = MetaData::find( $detail->meta_id )->toArray();
               $seo['title'] = $seo['title'] != '' ? $seo['title'] : 'Tag - '. $detail->name;
               $seo['description'] = $seo['description'] != '' ? $seo['description'] : 'Tag - '. $detail->name;
               $seo['keywords'] = $seo['keywords'] != '' ? $seo['keywords'] : 'Tag - '. $detail->name;
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = 'Tag - '. $detail->name;
            }  
                  
            return view('frontend.news.tag', compact('title', 'articlesArr', 'seo', 'socialImage', 'detail'));
        }
    }
    public function ajaxTab(Request $request){
        $table = $request->type ? $request->type : 'category';
        $id = $request->id;

        $arr = Film::getFilmHomeTab( $table, $id);

        return view('frontend.index.ajax-tab', compact('arr'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */    

    public function kygui(Request $request)
    {
        $tagArr = Tag::where('type', 1)->get();
        $directionArr = Direction::all();
        $loai_id = $request->loai_id ? $request->loai_id : null;
        $type = $request->type ? $request->type : 1;    
        
        if( $type ){
            
            $estateTypeArr = LoaiSp::where('type', $type)->select('id', 'name')->orderBy('display_order', 'desc')->get();            
            
        }       
        $priceUnitList = PriceUnit::all();
        $districtList = District::where('city_id', 1)->get();
       // var_dump($detail->district_id);die;
        $district_id = $request->district_id ? $request->district_id : 2;
        $wardList = Ward::where('district_id', $district_id)->get();
        $streetList = Street::where('district_id', $district_id)->get();
        $projectList = Project::where('district_id', $district_id)->get();

        $tienIchLists = Tag::where(['type' => 3, 'district_id' => $district_id])->get();
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Đăng tin ký gửi";
        return view('frontend.ky-gui.index', compact('estateTypeArr',   'loai_id', 'type', 'district_id', 'districtList', 'wardList', 'streetList', 'projectList', 'priceUnitList', 'tagArr', 'tienIchLists', 'directionArr', 'seo'));
    }
    public function postKygui(Request $request){
        $dataArr = $request->all();        
        
        $this->validate($request,[
            'type' => 'required',
            'loai_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'street_id' => 'required',
            'full_address' => 'required',
            'title' => 'required',            
            'price' => 'required|numeric',
            'price_unit_id' => 'required',
            'area' => 'required|numeric',
            'contact_name' => 'required',
            'contact_mobile' => 'required'
        ],
        [            
            'loai_id.required' => 'Bạn chưa chọn loại bất động sản',
            'district_id.required' => 'Bạn chưa chọn quận',
            'ward_id.required' => 'Bạn chưa chọn phường',
            'street_id.required' => 'Bạn chưa chọn đường phố',
            'full_address.required' => 'Bạn chưa nhập địa điểm',
            'title.required' => 'Bạn chưa nhập tiêu đề',            
            'price.required' => 'Bạn chưa nhập giá',
            'price.numeric' => 'Bạn nhập giá không hợp lệ',
            'price_unit_id.required' => 'Bạn chưa chọn đơn vị giá',            
            'area.required' => 'Bạn chưa nhập diện tích',
            'contact_name.required' => 'Bạn chưa nhập tên liên hệ',            
            'contact_mobile.required' => 'Bạn chưa nhập số di động liên hệ'
        ]);
        
        $dataArr['slug'] = Helper::changeFileName($dataArr['title']); 
        $dataArr['slug'] = str_replace(".", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace("(", "-", $dataArr['slug']);
        $dataArr['slug'] = str_replace(")", "", $dataArr['slug']);
        $dataArr['alias'] = Helper::stripUnicode($dataArr['title']);

        $dataArr['status'] = 2;          
        $dataArr['city_id'] = 1;      
        $dataArr['price_id'] = Helper::getPriceId($dataArr['price'], $dataArr['price_unit_id'], $dataArr['type']);
        $dataArr['area_id'] = Helper::getAreaId($dataArr['area']);   
        $rs = Product::create($dataArr);
        $product_id = $rs->id;         
        $this->storeImage( $product_id, $dataArr);       
        
        Session::flash('message', 'Đăng tin ký gửi thành công');

        return redirect()->route('ky-gui-thanh-cong');
    }
    public function kyguiSuccess(){
        $seo['title'] = $seo['description'] = $seo['keywords'] = 'Đăng tin ký gửi thành công';
        return view('frontend.ky-gui.success', compact('seo'));
    }
    public function storeImage($id, $dataArr){        
        //process old image
        $imageIdArr = isset($dataArr['image_id']) ? $dataArr['image_id'] : [];
        $hinhXoaArr = ProductImg::where('product_id', $id)->whereNotIn('id', $imageIdArr)->lists('id');
        if( $hinhXoaArr )
        {
            foreach ($hinhXoaArr as $image_id_xoa) {
                $model = ProductImg::find($image_id_xoa);
                $urlXoa = config('icho.upload_path')."/".$model->image_url;
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

                        if(!is_dir('uploads/'.date('Y/m/d'))){
                            mkdir('uploads/'.date('Y/m/d'), 0777, true);
                        }
                        if(!is_dir('uploads/thumbs/'.date('Y/m/d'))){
                            mkdir('uploads/thumbs/'.date('Y/m/d'), 0777, true);
                        }
                        $destionation = date('Y/m/d'). '/'. end($tmp);
                        
                        File::move(config('icho.upload_path').$image_url, config('icho.upload_path').$destionation);

                        Image::make(config('icho.upload_path').$destionation)->resize(170, null, function ($constraint) {
                                $constraint->aspectRatio();
                        })->crop(170, 128)->save(config('icho.upload_thumbs_path').$destionation);
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

}
