<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Goutte, File, Auth;
use App\Helpers\simple_html_dom;
use App\Helpers\Helper;
use App\Models\CrawlerUrl;
use App\Models\SanPham;
use App\Models\Project;
use App\Models\Street;
use App\Models\Ward;
use App\Models\District;
use App\Models\PriceUnit;
use App\Models\Product;
use App\Models\Articles;
use App\Models\ProductImg;



class CrawlerController extends Controller
{
    public function articles(){
        $prAll = Product::all();
        foreach ($prAll as $value) {
            $pro = Product::find($value->id);
            $image_url = $pro->image_url;
            $product_id = $pro->id;
            if($image_url){
                $rs = ProductImg::create(['product_id' => $product_id, 'image_url' => $image_url, 'display_order' => 1]);
                $thumbnail_id = $rs->id;
                $pro->thumbnail_id = $thumbnail_id;
                $pro->save();
            }            
        }
        die;
        $arr = [];
        set_time_limit(10000);
        $url = 'https://dothi.net/tu-van-luat.htm';
        $crawler = Goutte::request('GET', $url);
           $crawler->filter('.news-list ul li')->each(function ($node) use ($arr){
             
                $title = $link = $price = $price_old = $sale_percent = $image_url = $description = '';  
                
                if($node->filter('.litext a')->count() > 0){
                    $title = $node->filter('.litext a')->text();
                }
                if($node->filter('.litext p')->count() > 0){
                    $description = $node->filter('.litext p')->text();
                }                                
                if($node->filter('img')->count() > 0){
                    $image_url = $node->filter('img')->attr('src');                    
                    $image_url = str_replace('crop/203x134//', '', $image_url);
                   /* if($image_url){
                        $this->saveImageDoThi($image_url);
                    }
                    */
                }                
                
                $url_dothi = "https://dothi.net".$node->filter('a')->attr('href');
            
                $this->saveArticlesDoThi($url_dothi, $title, $image_url, $url_dothi, $description);  
                echo "</hr>";              
                         
             });  
    
        return $arr;
    }
    public function saveArticlesDoThi($url, $title, $image_url, $url_dothi, $description){
      
        $crawler = Goutte::request('GET', $url);   
        echo $url;
        //price
        $content = $crawler->filter('.nd-content')->html();
        if($crawler->filter('.nd-source')->count() > 0){
            $content.= $crawler->filter('.nd-source')->html();
        }

        $arrData = [
                    'title' => $title, 
                    'description' => $description, 
                    'slug' => Helper::changeFileName($title),
                    'alias' => Helper::stripUnicode($title),
                    'image_url' => $image_url,             
                    'content' => trim($content),
                    'cate_id' => 5,
                    'status' => 1, 
                    'meta_id' => 0,
                    'created_user' => 1,
                    'updated_user' => 1
                ];

        Articles::create($arrData);
    }
    public function product(){
        $arr = [];
        set_time_limit(10000);
        $url = 'https://dothi.net/ban-nha-rieng-thu-duc.htm';
        $crawler = Goutte::request('GET', $url);
           $crawler->filter('.listProduct li')->each(function ($node) use ($arr){
             
                $title = $link = $price = $price_old = $sale_percent = $image_url = '';  
                
                if($node->filter('h3 a.vip5')->count() > 0){
                    $title = $node->filter('h3 a.vip5')->text();
                }                
                if($node->filter('img')->count() > 0){
                    $image_url = $node->filter('img')->attr('src');
                    $image_url = str_replace('crop/170x115/', '', $image_url);
                   /* if($image_url){
                        $this->saveImageDoThi($image_url);
                    }
                    */
                }                
                
                $url_dothi = "https://dothi.net".$node->filter('a')->attr('href');
                $this->saveArticlesDoThi($url_dothi, $title, $image_url, $url_dothi);  
                echo "<hr>";              
                         
             });  
    
        return $arr;
    }
    public function saveProductDoThi($url, $title, $image_url, $url_dothi){
      
        $crawler = Goutte::request('GET', $url);   

        //price
        $price = $crawler->filter('.spanprice')->text();
        $arrTmp = $this->processPrice($price, 1);
        $price = $arrTmp['price'];
        $price_unit_id = $arrTmp['price_unit_id'];

        // area
        $tmparea = $crawler->filter('.pd-price')->text();
        $tmp1 = explode('Diện tích:', $tmparea);
        $area = trim(end($tmp1));

        //description        
        $description = trim($crawler->filter('.pd-desc-content')->html());
        //no_room
        if($crawler->filter('#tbl1 tr')->eq(6)->filter('td')->eq(1)->count() > 0){
            $no_room = trim($crawler->filter('#tbl1 tr')->eq(6)->filter('td')->eq(1)->text());
        }else{
            $no_room = '';
        }
        if($crawler->filter('#tbl1 tr')->eq(7)->filter('td')->eq(1)->count() > 0){
            //street_wide
            $street_wide = trim($crawler->filter('#tbl1 tr')->eq(7)->filter('td')->eq(1)->text());
        }else{
            $street_wide = '';
        }
        //var_dump($street_wide);       
        if($crawler->filter('#tbl1 tr')->eq(9)->filter('td')->eq(1)->count() > 0){
            //no_floor
            $no_floor = trim($crawler->filter('#tbl1 tr')->eq(9)->filter('td')->eq(1)->text());
        }else{
            $no_floor = '';
        }
        //var_dump($no_floor);
        if($crawler->filter('#tbl1 tr')->eq(10)->filter('td')->eq(1)->count() > 0){
            //no_wc
            $no_wc = trim($crawler->filter('#tbl1 tr')->eq(10)->filter('td')->eq(1)->text());
        }else{
            $no_wc = '';
        }
        //var_dump($no_wc);
        if($crawler->filter('#tbl2 tr')->eq(0)->filter('td')->eq(1)->count() > 0){
            $contact_name = trim($crawler->filter('#tbl2 tr')->eq(0)->filter('td')->eq(1)->text());
        }else{
            $contact_name = '';
        }
        if($crawler->filter('#tbl2 tr')->eq(1)->filter('td')->eq(1)->count() > 0){
            $contact_address = trim($crawler->filter('#tbl2 tr')->eq(1)->filter('td')->eq(1)->text());
        }else{
            $contact_address = '';
        }
        if($crawler->filter('#tbl2 tr')->eq(2)->filter('td')->eq(1)->count() > 0){
            $contact_phone = trim($crawler->filter('#tbl2 tr')->eq(2)->filter('td')->eq(1)->text());
        }else{
            $contact_phone = '';
        }
        if($crawler->filter('#tbl2 tr')->eq(3)->filter('td')->eq(1)->count() > 0){
            $contact_mobile = trim($crawler->filter('#tbl2 tr')->eq(3)->filter('td')->eq(1)->text());
        }else{
            $contact_mobile = '';
        }
        if($crawler->filter('#tbl2 tr')->eq(4)->filter('td')->eq(1)->filter('script')->count() > 0){
            $contact_email = trim($crawler->filter('#tbl2 tr')->eq(4)->filter('td')->eq(1)->filter('script')->text());        
        }else{
            $contact_email = '';
        }

        $arrData = [
                    'title' => $title, 
                    'description' => $description, 
                    'type' => 1, 
                    'loai_sp_id' => 2, 
                    'city_id' => 1, 
                    'district_id' => 19, 
                    'ward_id' => 0, 
                    'street_id' => 0, 
                    'project_id' => 0, 
                    'price' => $price,
                    'price_unit_id' => $price_unit_id > 0 ? $price_unit_id : 0, 
                    'area' => $area, 
                    'full_address' => '', 
                    'front_face' => '', 
                    'street_wide' => $street_wide,
                    'no_floor' => $no_floor, 
                    'no_room' => $no_room, 
                    'direction_id' => 0,      
                    'no_wc' => $no_wc,
                    'image_url' => $image_url, 
                    'video_url', 
                    'contact_name' => $contact_name, 
                    'contact_address' => $contact_address, 
                    'contact_phone' => $contact_phone,
                    'contact_mobile' => $contact_mobile, 
                    'contact_email' => $contact_email, 
                    'url_dothi' => $url_dothi, 
                    'status' => 1, 
                    'meta_id' => 0,
                    'customer_id' => 0
                ];

        Product::create($arrData);
    }
    
    public function processPrice($price, $type){        
        $tmp = explode(' ', trim($price));
        
        $text = $tmp[1];
        
        $text = str_replace('m²', 'm2', $text);
        if($text != ''){
        
            $price_unit_id = PriceUnit::where('name', $text)->where('type', $type)->first()->id;
        
        }
        $price = $tmp[0];
        return ['price' => $price, 'price_unit_id' => $price_unit_id];
        
    }
    public function saveImageDoThi($image_url){
        set_time_limit(10000);
        
            if($image_url){
                $saveto = str_replace("https://img.dothi.net/", "", $image_url);
                $tmp = explode('/', $saveto);
            
                $dir = str_replace(end($tmp), "", $saveto);
                
                if(!is_dir(public_path() ."/uploads/".$dir)){
                    mkdir(public_path() ."/uploads/".$dir,0777, true);
                }
                var_dump($image_url);
                 echo "<hr>";
                var_dump('save_to', $saveto);
                 echo "<hr>";
                $this->grab_image($image_url, $saveto);
            }
         
    }
    
    public function grab_image($url,$saveto){
        
        $ch = curl_init ($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $raw=curl_exec($ch);
        
        if($raw){
            curl_close ($ch);
            if(!file_exists($saveto)){
                $fp = fopen($saveto,'x');
                fwrite($fp, $raw);
                fclose($fp);
            }
        }
        
    }
    public function crawlerProduct(){
        set_time_limit(10000);    
        $url = 'https://dothi.net/ban-nha-rieng-quan-2.htm';        
        $chs = curl_init();            
        curl_setopt($chs, CURLOPT_URL, $url);
        curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($chs, CURLOPT_HEADER, 0);
        $result = curl_exec($chs);
        curl_close($chs);
        // Create a DOM object
        $crawler = new simple_html_dom();
        // Load HTML from a string
        $crawler->load($result);
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if($crawler->find('a.vip5', 0)){
            $dataArr['title'] = trim($crawler->find('h1.item-name', 0)->innertext);
        }
        if($crawler->find('meta[property="og:image"]', 0)){
            $dataArr['img'] = $crawler->find('meta[property="og:image"]', 0)->content;
        }
        if($crawler->find('#span-price', 0)){
            $dataArr['price'] = $crawler->find('#span-price', 0)->innertext;    
        }
        if($crawler->find('.old-price-item span', 1)){
            $dataArr['price_old'] = $crawler->find('.old-price-item span', 1)->innertext;    
        }
        return $dataArr;
    }
    public function street(){
        set_time_limit(10000);
        $districtArr = [54,61,71];
        foreach ($districtArr as $dis) {
            $url = 'https://dothi.net/Handler/SearchHandler.ashx?module=GetStreet&distId='. $dis; 
            $chs = curl_init();            
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $result = curl_exec($chs);
            
            curl_close($chs);

            $data = json_decode($result, true);
            $i = 0;
            foreach($data as $street){
                
                $i++;                
                Street::create([
                    'id_dothi' => $street['Id'],
                    'name' => $street['Text'],
                    'prefix' => $street['StreetPrefix'],
                    'district_id' => $dis,
                    'city_id' => 1,
                    'display_order' => $i,
                    'slug' => Helper::changeFileName($street['Text'])
                ]);           
                
            }                        
        }
    }
    public function ward(){
        set_time_limit(10000);
        $districtArr = [54,61,71];
        foreach ($districtArr as $dis) {
            $url = 'https://dothi.net/Handler/SearchHandler.ashx?module=GetWard&distId='. $dis; 
            $chs = curl_init();            
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $result = curl_exec($chs);
            
            curl_close($chs);

            $data = json_decode($result, true);
            $i = 0;
            foreach($data as $ward){
                $i++;
                Ward::create([
                    'id_dothi' => $ward['Id'],
                    'name' => $ward['Text'],
                    'prefix' => $ward['WardPrefix'],
                    'district_id' => $dis,
                    'city_id' => 1,
                    'display_order' => $i,
                    'slug' => Helper::changeFileName($ward['Text'])
                ]);           
            }            
        }
    }
   
   public function project(Request $request){
        
        set_time_limit(10000);
        $districtArr = [54,61,71];
        foreach ($districtArr as $id) {
            $url = 'https://dothi.net/Handler/SearchHandler.ashx?module=GetProject&distId='. $id; 
            $distric_id = District::where('id_dothi', $id)->first()->id;
            $chs = curl_init();            
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);
            $result = curl_exec($chs);
            
            curl_close($chs);

            $data = json_decode($result, true);
            $i = 0;
            foreach($data as $pro){
                var_dump($pro['StreetId']);
                echo "<hr>";
                $i++;
                if($pro['WardId'] > 0){
                $wardObj = Ward::where('id_dothi', $pro['WardId'])->first();
                //echo "<pre>";
                //var_dump($wardObj->toArray());die;
                $ward_id = $wardObj->id;
            }else{
                $ward_id = 0;
            }
                if($pro['StreetId'] > 0){
                    $stObj = Street::where('id_dothi', $pro['StreetId'])->first();
                    if(!empty( (array) $stObj)){
                        $street_id = $stObj->id;
                    }
                }else{
                    $street_id = 0;
                }
                
                Project::create([
                    'id_dothi' => $pro['Id'],
                    'name' => $pro['Text'],
                    'longt' => $pro['Lng'],
                    'latt' => $pro['Lat'],
                    'district_id' => $distric_id,
                    'city_id' => 1,
                    'ward_id' => $ward_id,
                    'street_id' => $street_id,
                    'status' => 1,
                    'display_order' => $i,
                    'slug' => Helper::changeFileName($pro['Text'])
                ]);           
            }
        }     



        
    }
    public function index(Request $request){
        $dataArr = CrawlerUrl::all();
        foreach ($dataArr as $key => $value) {
            $url = $value->url;
            $site = $this->checkSite($url);

            if($site == "tiki"){

                $dataArr = $this->tiki($url, $value->loai_id, $value->cate_id, $value->type);              


            }elseif($site == "adayroi"){

                $dataArr = $this->adayroi($url, $value->loai_id, $value->cate_id, $value->type);                
            }
            elseif($site == "sendo"){

                $dataArr = $this->sendo($url, $value->loai_id, $value->cate_id, $value->type);
               
            }else{
               
                $dataArr = $this->lazada($url, $value->loai_id, $value->cate_id, $value->type);
               
            }
        }
        die;

    }
    public function lazada($url, $loai_id, $cate_id, $type){
        
        set_time_limit(10000);
        $arr = ['loai_id' => $loai_id, 'cate_id' => $cate_id, 'type' => $type];
        for($page = 1; $page <= 1; $page++){ 
                
          
             $crawler = Goutte::request('GET', $url);             
             $crawler->filter('.product-card')->each(function ($node) use ($arr){
             
                $title = $link = $price = $price_old = $sale_percent = $image_url = '';                
                    if($node->filter('.product-card__img img')->count() > 0){
                     $image_url = $node->filter('.product-card__img img')->attr('data-original');
                    }   
             
                
                    $link = $node->filter('a')->attr('href');
                if($node->filter('div.product-card__name-wrap span')->count() > 0){
                    $title = $node->filter('div.product-card__name-wrap span')->text();
                }
                if($node->filter('div.product-card__price')->count() > 0){
                    $price = $node->filter('div.product-card__price')->text();
                }
                if($node->filter('div.product-card__old-price')->count() > 0){
                    $price_old = $node->filter('div.product-card__old-price')->text();
                }
                if($node->filter('div.product-card__sale')->count() > 0){
                    $sale_percent = $node->filter('div.product-card__sale')->text();
                }  
                $params =  [
                    'name' => $title,
                    'url' => $link,
                    'aff_price' => $price,
                    'aff_price_old' => $price_old,
                    'aff_sale_percent' => $sale_percent,
                    'thumbnail_url' => $image_url,
                    'loai_id' => $arr['loai_id'],
                    'cate_id' => $arr['cate_id'],
                    'is_aff' => 1,
                    'type' => $arr['type'],
                    'site_id' => 1,
                    'status' => 1,
                    'created_user' => Auth::user()->id, 
                    'updated_user'=>Auth::user()->id

                ];   
                SanPham::create($params);
                         
             });    
            
        }
        return $arr;
    }
    public function adayroi($url, $loai_id, $cate_id, $type){        
        set_time_limit(10000);
        $arr = ['loai_id' => $loai_id, 'cate_id' => $cate_id, 'type' => $type];
        for($page = 1; $page <= 1; $page++){ 
            
            
             $crawler = Goutte::request('GET', $url);             
             $crawler->filter('.col-lg-3.col-xs-4')->each(function ($node) use ($arr){                
                if($node->filter('.out-of-stock')->count() == 0){
                $title = $link = $price = $price_old = $sale_percent = $image_url = '';
                    if($node->filter('img.imglist')->count() > 0){
                     $image_url = $node->filter('img.imglist')->attr('data-src');
                    }   
                    
                    $link = "https://www.adayroi.com".$node->filter('a')->attr('href');
                    
                    if($node->filter('.post-title')->count() > 0){
                        $title = $node->filter('.post-title')->text();
                    
                    }
                    if($node->filter('.amount-1')->count() > 0){
                         $price = $node->filter('.amount-1')->text();
                   
                    }
                if($node->filter('.amount-2')->count() > 0){
                    $price_old = $node->filter('.amount-2')->text();
                   
                }
                if($node->filter('.sale-off')->count() > 0){
                    $sale_percent = $node->filter('.sale-off')->text();
                    
                }
                    $params =  [
                    'name' => $title,
                    'url' => $link,
                    'aff_price' => $price,
                    'aff_price_old' => $price_old,
                    'aff_sale_percent' => $sale_percent,
                    'thumbnail_url' => $image_url,
                    'loai_id' => $arr['loai_id'],
                    'cate_id' => $arr['cate_id'],
                    'is_aff' => 1,
                    'type' => $arr['type'],
                    'site_id' => 3,
                    'status' => 1,
                    'created_user' => Auth::user()->id, 
                    'updated_user'=>Auth::user()->id
                ];   
                SanPham::create($params); 
               } 
               
             });
             
              
        }
        return $arr;
    }
    public function crawler(Request $request){

        $url = $request->url;        
        $site = $this->checkSite($url);

        if($site == "tiki"){

            $dataArr = $this->crawlerTiki($url);

        }elseif($site == "adayroi"){

            $dataArr = $this->crawlerAdayroi($url);

        }
        elseif($site == "sendo"){

            $dataArr = $this->crawlerSendo($url);

        }else{

            $dataArr = $this->crawlerLazada($url);

        }
        return view('crawler', compact('dataArr', 'url')); 
    }
    public function crawlerLazada($url){
         $crawler = Goutte::request('GET', $url); 
           //var_dump('http://www.lazada.vn/ao-khoac-nu/?dir=desc&page='.$page.'&sort=discountspecial');die;
   
            
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if( $crawler->filter('h1#prod_title')->count() > 0 ){
            $dataArr['title'] = trim($crawler->filter('h1#prod_title')->text());
        }
        
        if( $crawler->filter('meta[property="og:image"]')->count() > 0 ){
           $dataArr['img'] = $crawler->filter('meta[property="og:image"]')->attr('content');
        }
        if( $crawler->filter('#special_price_box')->count() > 0 ){
            $dataArr['price'] = $crawler->filter('#special_price_box')->text();
        }
        if( $crawler->filter('#price_box')->count() > 0 ){
           $dataArr['price_old'] = $crawler->filter('#price_box')->text();
        }

        return $dataArr;            
         
    }
    public function crawlerAdayroi($url){
        $crawler = Goutte::request('GET', $url);
            
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if( $crawler->filter('h1.item-title')->count() > 0 ){
            $dataArr['title'] = trim($crawler->filter('h1.item-title')->text());
        }
        
        if( $crawler->filter('meta[property="og:image"]')->count() > 0 ){
           $dataArr['img'] = $crawler->filter('meta[property="og:image"]')->attr('content');
        }
        if( $crawler->filter('div.item-price')->count() > 0 ){
            $dataArr['price'] = $crawler->filter('div.item-price')->text();
        }
        if( $crawler->filter('div.price span.original')->count() > 0 ){
           $dataArr['price_old'] = $crawler->filter('div.price span.original')->text();
        }

        return $dataArr;            
         
    }
    public function crawlerSendo($url){
        $crawler = Goutte::request('GET', $url);
            
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if( $crawler->filter('#lightbox_detail h1 strong.fn')->count() > 0 ){
            $dataArr['title'] = trim($crawler->filter('#lightbox_detail h1 strong.fn')->text());
        }
        
        if( $crawler->filter('meta[property="og:image"]')->count() > 0 ){
           $dataArr['img'] = $crawler->filter('meta[property="og:image"]')->attr('content');
        }
        if( $crawler->filter('#lightbox_detail .box-price div.cur-price span')->first()->count() > 0 ){
            $dataArr['price'] = number_format($crawler->filter('#lightbox_detail .box-price div.cur-price span')->first()->text());
        }
        if( $crawler->filter('#lightbox_detail .old-price')->count() > 0 ){
           $dataArr['price_old'] = $crawler->filter('#lightbox_detail .old-price')->text();
        }

        return $dataArr;            
         
    }

    public function crawlerTiki($url){
        set_time_limit(10000);    
        $url = $url; 
        $chs = curl_init();            
        curl_setopt($chs, CURLOPT_URL, $url);
        curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($chs, CURLOPT_HEADER, 0);
        $result = curl_exec($chs);
        curl_close($chs);
        // Create a DOM object
        $crawler = new simple_html_dom();
        // Load HTML from a string
        $crawler->load($result);
        $dataArr['title'] = "";
        $dataArr['img'] = "";
        $dataArr['price'] = "";
        $dataArr['price_old'] = "";
        
        if($crawler->find('h1.item-name', 0)){
            $dataArr['title'] = trim($crawler->find('h1.item-name', 0)->innertext);
        }
        if($crawler->find('meta[property="og:image"]', 0)){
            $dataArr['img'] = $crawler->find('meta[property="og:image"]', 0)->content;
        }
        if($crawler->find('#span-price', 0)){
            $dataArr['price'] = $crawler->find('#span-price', 0)->innertext;    
        }
        if($crawler->find('.old-price-item span', 1)){
            $dataArr['price_old'] = $crawler->find('.old-price-item span', 1)->innertext;    
        }
        return $dataArr;
    }
    public function checkSite($url){
        if( strpos($url, 'tiki.vn') > 0 ){
            $site = "tiki";
        }elseif(strpos($url, 'adayroi') > 0){
            $site = "adayroi";
        }elseif(strpos($url, 'sendo') > 0){
            $site = "sendo";
        }else{
            $site = "lazada";
        }
        return $site;
    }

    public function detail(Request $request){
    	set_time_limit(10000);
    	$all = Link::where('id', '>=', 1000)->where('id', '<', 1001)->where('status', 1)->get();

    	foreach ($all as $key => $value) {
    		$url = $value->link;
    		$id = $value->id;
    		$crawler = Goutte::request('GET', $url); 
    		$content = $crawler->filter('div.aboutus')->html();    		
    		$model = Link::find($id);
    		$model->status = 0;
    		$model->content = $content;
    		$model->save();
    	}
    }

    public function imageContent(Request $request)
    {
    	set_time_limit(10000);   	

    	$all = Link::where('status', 0)->get();
    	

    	$linkArr = [];
    	foreach($all as $link){
    		echo $link->link;
    		echo "<br>";
    		if( !in_array($link->link , ['http://www.androidgiare.vn/danh-gia-lg-f160/', 'http://www.androidgiare.vn/phablet-cao-cap-dien-thoai-sky-a920/'])){
    		//$link = Link::where('link', 'http://www.androidgiare.vn/dien-thoai-lg-gia-re-duoi-4-trieu/')->first();
    		$html = $link->content;
	    	$doc = new \DOMDocument();
			$doc->loadHTML( $html );

			$images = $doc->getElementsByTagName("img");

			for ( $i = 0; $i < $images->length; $i++ ) {
			  // Outputs: foo.jpg bar.png
			  $image_url = "http://www.androidgiare.vn".$images->item( $i )->attributes->getNamedItem( 'src' )->nodeValue;

			  echo "<br>";
			  if($image_url && strpos($image_url, 'wp-content/') && !strpos($image_url, '/wp-content/')) {
		    		$saveto = str_replace("http://www.androidgiare.vn/wp-content/", "", $image_url);
		    		$tmp = explode('/', $saveto);
		    	
		    		$dir = str_replace(end($tmp), "", $saveto);
		    		
		    		if(!is_dir(public_path() ."/".$dir)){
		    			mkdir(public_path() ."/".$dir, true);
		    		}
		    		var_dump($image_url);
		    		echo "<br>";
		    		var_dump($saveto);
		    		$this->grab_image($image_url, $saveto);
		    		echo "<br>";
		    		$i++;
		    		echo $i." - ".$link->id;
		    		
	    		}
			}	
			echo "<hr>";	
			}	
		}
    }
    public function update(Request $request){
    	$all = Link::all();
    	$linkArr = [];
    	foreach($all as $link){
    		$url = $link->link;
    		$post_name = str_replace("http://www.androidgiare.vn/", "", $url);
    		$post_name = str_replace("/", "", $post_name);
    		$id = $link->id;
    		$title = str_replace("http://www.androidgiare.vn", "", $link->title);
    		
    		$model = Link::find($id);
    		$model->title = $title;
    		$model->post_name = $post_name;
    		$model->save();
    	}  	
    	
    }
    
    public function saveImage(Request $request){
        set_time_limit(10000);
        $all = Link::all();
        $i = 0;
        foreach($all as $value){

            $image_url = $value->image_url;
            if($image_url){
                $saveto = str_replace("http://www.androidgiare.vn/wp-content/", "", $image_url);
                $tmp = explode('/', $saveto);
            
                $dir = str_replace(end($tmp), "", $saveto);
                
                if(!is_dir(public_path() ."/".$dir)){
                    mkdir(public_path() ."/".$dir,0777, true);
                }
                var_dump($image_url);
                echo "<hr>";
                var_dump($saveto);
                $this->grab_image($image_url, $saveto);
                $i++;
                echo $i." - ".$value->id;
                echo "<hr>";
            }
        }
    }
    public static function changeFileName($str) {
        $str = self::stripUnicode($str);
        $str = str_replace("?", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("  ", " ", $str);
        $str = trim($str);
        $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
        $str = str_replace(" ", "-", $str);
        $str = str_replace("---", "-", $str);
        $str = str_replace("--", "-", $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('"', "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace(",", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("%", "", $str);
        return $str;
    }

    public static function stripUnicode($str) {
        if (!$str)
            return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ',
            'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' => '?',
            '-' => '/'
        );
        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }
        return $str;
    }
}
