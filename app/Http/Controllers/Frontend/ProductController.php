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
use App\Models\Pages;
use Helper, File, Session, Auth;
use Mail;

class ProductController extends Controller
{
    public function cate(Request $request)
    {
        $slug = $request->slug;
        if($slug == 'san-pham'){
            $rs = (object) [];
            $rs->name = 'Sản phẩm';
            
            $query = Product::where('product.status', 1)
                ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id') 
                ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')                
                ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai') 
                ->orderBy('product.id', 'desc');
                $productList  = $query->limit(36)->get();              
            
            
            $seo['title'] = $seo['description'] = $seo['keywords'] = $rs->name;
                                                              
            return view('frontend.cate.parent', compact('productList', 'rs', 'socialImage', 'seo', 'loai_id'));
        }
        $rs = LoaiSp::where('slug', $slug)->first();        

        if($rs){//danh muc cha
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
            return view('frontend.cate.parent', compact('productList', 'rs', 'socialImage', 'seo', 'loai_id'));
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
    
    public function search(Request $request)
    {        
        $tu_khoa = $request->keyword;       
        
        $sql = Product::where('product.alias', 'LIKE', '%'.$tu_khoa.'%');            
        
         $sql->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id') 
                ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')                
                ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai')
                ->orderBy('id', 'desc');
        $productList = $sql->paginate(25);
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Tìm kiếm sản phẩm theo từ khóa '".$tu_khoa."'";       
        return view('frontend.cate.search', compact('productList', 'tu_khoa', 'seo'));
    }       

    
}

