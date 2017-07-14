<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LoaiSp;
use App\Models\Cate;
use App\Models\Product;
use App\Models\MetaData;
use Helper, File, Session, Auth, DB;

class CateController extends Controller
{
    
    public function __construct(){
        
       

    }
    public function search(Request $request)
    {        
        $tu_khoa = $request->keyword;       
        $loaiList = LoaiSp::all();
        foreach($loaiList as $loai){
            $cateList[$loai->id] = Cate::where('loai_id', $loai->id)->get();
        }
        $sql = Product::where('product.alias', 'LIKE', '%'.$tu_khoa.'%');            
        
         $sql->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id') 
                ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')                
                ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai')
                ->orderBy('id', 'desc');
        $productList = $sql->paginate(25);
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Keyword: '".$tu_khoa."'";       
        return view('frontend.cate.search', compact('productList', 'tu_khoa', 'seo', 'loaiList', 'cateList'));
    } 
    public function parent(Request $request)
    {
        $slug = $request->slug;
        
        $rs = LoaiSp::where('slug', $slug)->first();        

        if($rs){//danh muc cha
            $loaiList = LoaiSp::all();
            foreach($loaiList as $loai){
                $cateList[$loai->id] = Cate::where('loai_id', $loai->id)->get();
            }
            $loai_id = $rs->id;
            
            $query = Product::where('loai_id', $loai_id)               
                ->where('product.status', 1)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id') 
                ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')                
                ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai') 
                ->orderBy('product.id', 'desc');
                $productList  = $query->limit(36)->get();              
            
            if( $rs->meta_id > 0){
               $seo = MetaData::find( $rs->meta_id )->toArray();
            }else{
                $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
            }                                                   
            return view('frontend.cate.parent', compact('productList', 'rs', 'socialImage', 'seo', 'loai_id', 'loaiList', 'cateList'));
        }else{
            $detailPage = Pages::where('slug', $slug)->first();
            if(!$detailPage){
                return redirect()->route('home');
            }
            $seo['title'] = $detailPage->meta_title ? $detailPage->meta_title : $detailPage->title;
            $seo['description'] = $detailPage->meta_description ? $detailPage->meta_description : $detailPage->title;
            $seo['keywords'] = $detailPage->meta_keywords ? $detailPage->meta_keywords : $detailPage->title;           
            return view('frontend.pages.index', compact('detailPage', 'seo'));    
        }
    }
    public function child(Request $request)
    {
        
        $slugLoaiSp = $request->slugLoaiSp;
        $slug = $request->slug;
        $rs = LoaiSp::where('slug', $slugLoaiSp)->first();
        if(!$rs){
            return redirect()->route('home');
        }
        $loaiList = LoaiSp::all();
        foreach($loaiList as $loai){
            $cateList[$loai->id] = Cate::where('loai_id', $loai->id)->get();
        }
        $loai_id = $rs->id;
        $rsCate = Cate::where(['loai_id' => $loai_id, 'slug' => $slug])->first();
        $cate_id = $rsCate->id;

        $cateArr = Cate::where('status', 1)->where('loai_id', $loai_id)->get();

        
        $query = Product::where('cate_id', $rsCate->id)->where('loai_id', $loai_id)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')  
                ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')                
                ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai'); 
                    
        $query->orderBy('product.id', 'desc');
        $productList = $query->paginate(30);        
        $socialImage = $rsCate->icon_url;
        if( $rsCate->meta_id > 0){            
           $seo = MetaData::find( $rsCate->meta_id )->toArray();           
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $rsCate->name;
        }
        $is_child = 1;
        
        return view('frontend.cate.child', compact('productList', 'cateArr', 'rs', 'rsCate', 'socialImage', 'seo', 'is_child', 'loaiList', 'cateList'));
    }    
    
    

   
}
