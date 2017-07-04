<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Goutte, File, Auth;
use App\Helpers\simple_html_dom;
use App\Models\SanPham;

class CrawlerController extends Controller
{
   
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
    public function search(Request $request){
        $name = $request->name;
        $site = $request->site;
        if($site == 'tiki'){
            $this->crawlerTiki($name);
        }
    }
    public function crawlerTiki($name){
        set_time_limit(10000);    
        $url = urlencode('https://tiki.vn/search?q='.$name); 
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
        var_dump($dataArr);die;

        return $dataArr;
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
    public function tiki($url, $loai_id, $cate_id, $type){
        $arr = [];
        set_time_limit(10000);
        for($page = 1; $page <= 1; $page++){ 
             //$crawler = Goutte::request('GET', 'https://tiki.vn/laptop/c2742?order=discount_percent%2Cdesc&page='.$page);   
             //var_dump('https://tiki.vn/laptop/c2742?order=discount_percent%2Cdesc&page='.$page);             
            
            
             $chs = curl_init();

            // set URL and other appropriate options
            curl_setopt($chs, CURLOPT_URL, $url);
            curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($chs, CURLOPT_HEADER, 0);

            // grab URL and pass it to the browser
            $result = curl_exec($chs);

            // close cURL resource, and free up system resources
            curl_close($chs);
         // Create a DOM object
            $crawler = new simple_html_dom();
            // Load HTML from a string
            $crawler->load($result);
            foreach($crawler->find('div.product-item') as $node){          
               $title = $link = $price = $price_old = $sale_percent = $image_url = '';
                $title = $content = $image_url = $link = "";
                $count_img = count($node->find('span.image img'));
                
                    if($count_img == 2){
                     $image_url = $node->find('span.image img',1)->src;
                    }
                    if($count_img == 1){
                     $image_url = $node->find('span.image img',0)->src;
                    }  
                    if($count_img == 3){
                     $image_url = $node->find('span.image img',2)->src;
                    }                  
                    
                    $link = $node->find('a', 0)->href;
                    $link = strstr($link, '?', true);
                   
                    if($node->find('span.title', 0)){
                     $title = trim($node->find('span.title', 0)->innertext);                   
                    }
                 if($node->find('.price-sale', 0)){
                    $price_tmp = $node->find('.price-sale', 0)->innertext;
                    $tmpArr = explode('<span', $price_tmp);
                    $price = $tmpArr[0];                    
                }
                if($node->find('.price-regular', 0)){
                    $price_old = $node->find('.price-regular', 0)->innertext;                   
                }
                if($node->find('.sale-tag', 0)){
                  $sale_percent = $node->find('.sale-tag', 0)->innertext;                            
              }
              $params =  [
                    'name' => $title,
                    'url' => $link,
                    'aff_price' => $price,
                    'aff_price_old' => $price_old,
                    'aff_sale_percent' => $sale_percent,
                    'thumbnail_url' => $image_url,
                    'loai_id' => $loai_id,
                    'cate_id' => $cate_id,
                    'is_aff' => 1,
                    'type' => $type,
                    'site_id' => 2,
                    'status' => 1,
                    'created_user' => Auth::user()->id, 
                    'updated_user'=>Auth::user()->id
                ];  
                  
                SanPham::create($params);
            };
              
        }
        return $arr;
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
	    			mkdir(public_path() ."/".$dir, true);
	    		}
	    		var_dump($image_url);
	    		var_dump($saveto);
	    		$this->grab_image($image_url, $saveto);
	    		$i++;
	    		echo $i." - ".$value->id;
	    		echo "<hr>";
    		}
    	}
    }
    public function grab_image($url,$saveto){
    	var_dump($url);
	    $ch = curl_init ($url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	    $raw=curl_exec($ch);
	    var_dump($raw);die;
	    if($raw){
		    curl_close ($ch);
		    if(!file_exists($saveto)){
		        $fp = fopen($saveto,'x');
			    fwrite($fp, $raw);
			    fclose($fp);
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
