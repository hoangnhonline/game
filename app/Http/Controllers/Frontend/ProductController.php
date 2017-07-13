<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cate;
use App\Models\LoaiSp;
use App\Models\MetaData;
use App\Models\Pages;
use Helper, File, Session, Auth;
use Mail;

class ProductController extends Controller
{
    
    
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

