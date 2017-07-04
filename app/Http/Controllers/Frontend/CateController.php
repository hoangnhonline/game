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
   
   
    public function cate(Request $request)
    {
        
        $slugLoaiSp = $request->slugLoaiSp;
        $slug = $request->slug;
        $rs = LoaiSp::where('slug', $slugLoaiSp)->first();
        if(!$rs){
            return redirect()->route('home');
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
        
        return view('frontend.cate.child', compact('productList', 'cateArr', 'rs', 'rsCate', 'socialImage', 'seo', 'is_child'));
    }    
    
    

   
}
