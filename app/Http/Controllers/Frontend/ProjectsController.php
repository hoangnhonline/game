<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LandingProjects;
use App\Models\ProContent;
use App\Models\MetaData;
use App\Models\Tab;
use App\Models\Articles;


use Helper, File, Session, Auth;
use Mail;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        
        $projectList = LandingProjects::orderBy('id', 'desc')->get();
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Dự án";                
        
        $socialImage = "";
        return view('frontend.projects.index', compact('seo', 'socialImage', 'projectList'));
    }

    public function detail(Request $request){

        $slug = $request->slug;        
        $detail = LandingProjects::where('slug', $slug)->first();
        $project_id = $detail->id;
        $tabList = LandingProjects::getListTabProject($project_id); 
        $tabArr = [];
        $i = 0;
        foreach($tabList as $tmp) {
            if($i == 0){
                $tab_id = $tmp->id;
            }
            $tabArr[] = $tmp->id;
            $i++;
        }
        $detailTab = Articles::where('project_id', $project_id)->where('tab_id', $tab_id)->first();
           
        $socialImage = $detail->image_url;
        if( $detail->meta_id > 0){
           $seo = MetaData::find( $detail->meta_id )->toArray();
           $seo['title'] = $seo['title'] != '' ? $seo['title'] : $detail->name;
           $seo['description'] = $seo['description'] != '' ? $seo['description'] : $detail->name;
           $seo['keywords'] = $seo['keywords'] != '' ? $seo['keywords'] : $detail->name;
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $detail->name;
        }  
        $tab_id = 1;
        return view('frontend.projects.detail', compact('seo', 'socialImage', 'detail', 'tabList', 'tabArr', 'detailTab', 'project_id', 'tab_id'));
    }
    public function tab(Request $request){

        $slug = $request->slug;        
        $detail = LandingProjects::where('slug', $slug)->first();
        $slugtab = $request->slugtab;
        $rs = Tab::where('slug', $slugtab)->first();
        if($rs){
            $tab_id = $rs->id;
        }else{
            redirect()->route('home');
        }

        $project_id = $detail->id;

        $tabList = LandingProjects::getListTabProject($project_id); 

        $tabArr = [];
        foreach($tabList as $tmp) {
            $tabArr[] = $tmp->id;
        }
       
        $detailTab = Articles::where('project_id', $project_id)->where('tab_id', $tab_id)->first();
        
        $socialImage = $detail->image_url;
        if($detailTab &&  $detailTab->meta_id > 0){
           $seo = MetaData::find( $detailTab->meta_id )->toArray();
           $seo['title'] = $seo['title'] != '' ? $seo['title'] : $detail->name;
           $seo['description'] = $seo['description'] != '' ? $seo['description'] : $detail->name;
           $seo['keywords'] = $seo['keywords'] != '' ? $seo['keywords'] : $detail->name;
        }else{
            $seo['title'] = $seo['description'] = $seo['keywords'] = $detail->name;
        }        
        return view('frontend.projects.detail', compact('seo', 'socialImage', 'detail', 'tabList', 'tabArr', 'detailTab', 'project_id', 'tab_id'));
    }

}

