<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ArticlesCate;
use App\Models\Articles;
use Helper, File, Session, Auth;
use Mail;

class NewsController extends Controller
{
    public function newsList(Request $request)
    {
        $slug = $request->slug;
        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $cateDetail = ArticlesCate::where('slug' , $slug)->first();

        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;

        $articlesArr = Articles::where('cate_id', $cateDetail->id)->orderBy('id', 'desc')->paginate(10);

        $hotArr = Articles::where( ['cate_id' => $cateDetail->id, 'is_hot' => 1] )->orderBy('id', 'desc')->limit(5)->get();
        $seo['title'] = $cateDetail->meta_title ? $cateDetail->meta_title : $cateDetail->title;
        $seo['description'] = $cateDetail->meta_description ? $cateDetail->meta_description : $cateDetail->title;
        $seo['keywords'] = $cateDetail->meta_keywords ? $cateDetail->meta_keywords : $cateDetail->title;
        $socialImage = $cateDetail->image_url;       
        return view('frontend.news.index', compact('title', 'hotArr', 'articlesArr', 'cateDetail', 'seo', 'socialImage'));
    }      

     public function newsDetail(Request $request)
    { 
        $id = $request->id;

        $detail = Articles::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_id', 'created_at', 'cate_id')
                ->first();
        
        if( $detail ){           

            $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;

            $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(5)->get();
            $otherArr = Articles::where( ['cate_id' => 1] )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(4)->get();
            $seo['title'] = $detail->meta_title ? $detail->meta_title : $detail->title;
            $seo['description'] = $detail->meta_description ? $detail->meta_description : $detail->title;
            $seo['keywords'] = $detail->meta_keywords ? $detail->meta_keywords : $detail->title;
            $socialImage = $detail->image_url; 
          
            $tagSelected = Articles::getListTag($id);
            $cateDetail = ArticlesCate::find($detail->cate_id);
            return view('frontend.news.news-detail', compact('title',  'hotArr', 'detail', 'otherArr', 'seo', 'socialImage', 'tagSelected', 'cateDetail'));
        }else{
            return view('erros.404');
        }
    }
}

