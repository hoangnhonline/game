<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Backend\Cate;
use App\Models\Backend\LoaiSp;
use App\Models\SanPham;
use App\Models\SpHinh;
use App\Models\Backend\SpLinhKien;
use App\Models\SpThuocTinh;
use App\Models\Backend\LoaiThuocTinh;
use App\Models\Backend\ThuocTinh;
use App\Models\IchoCu\WpTerms;
use App\Models\IchoCu\WpPosts;
use App\Models\IchoCu\WpPostMeta;
use App\Models\IchoCu\WpTermRelationships;
use App\Models\IchoCu\WpTermTaxonomy;
use App\Models\IchoCu\WpAlaptopdigital;
use App\Models\IchoCu\WpAphonedigital;
use App\Models\IchoCu\WpAlcddigital;
use App\Models\IchoCu\WpAtabletdigital;


use App\Models\Pages;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use App\Models\TinhThanh;


use Helper, File, Session, Auth;

class ConvertController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {       
        set_time_limit(10000);
        $rs = SanPham::all();
        foreach($rs as $sp){
            echo $sp->id; 
            echo "<hr>";
            $model = SanPham::find($sp->id);
            $slug = $model->slug;
            $slug = str_replace(".", "-", $slug);
            $model->slug = $slug;
            $model->save();
        }
    }
    public function mapThuocTinhTablet(){
         set_time_limit(10000);
        $arr = WpATabletdigital::whereRaw('1')->get()->toArray();
        $data = [];
        foreach($arr as $value){
            $external_id = $value['id_product'];
            //var_dump($external_id);die;
            $rs = SanPham::where('external_id', $external_id)->get()->toArray();
            if(!empty($rs)){
                $id = $rs[0]['id'];

                //bo_mach
                $column = $value['man_hinh'];
               
                $tmp= explode('\_/', $column);
                 
                $data[$id][104] = $tmp[0];
                $data[$id][105] = $tmp[1];
                $data[$id][106] = $tmp[2];
                //$data[$id][] = $tmp[3];
                //$data[$id][] = $tmp[4];
                

                
                // bo_xu_ly
                $column = $value['cpu'];
                $tmp = explode('\_/', $column);
                
                $data[$id][111] = $tmp[0];
                $data[$id][112] = $tmp[1];
                $data[$id][114] = $tmp[2];
                $data[$id][113] = $tmp[3];
                $data[$id][115] = $tmp[4];              
          

                //bo_nho
                $column = $value['bo_nho'];
                $tmp= explode('\_/', $column);
            
                $data[$id][116] = $tmp[0];
                $data[$id][117] = $tmp[1];
                $data[$id][118] = $tmp[2];


                //man_hinh
                $column = $value['chup_anh'];
                $tmp= explode('\_/', $column);

                $data[$id][107] = $tmp[0];
                $data[$id][110] = $tmp[1];
                $data[$id][109] = $tmp[2];
                $data[$id][108] = $tmp[3];

                
                $column = $value['network'];
                $tmp= explode('\_/', $column);
              //  var_dump("<pre>", $tmp);
                $data[$id][121] = $tmp[0];
                $data[$id][128] = $tmp[1];
                $data[$id][129] = $tmp[2];
                $data[$id][122] = $tmp[3];

                $data[$id][119] = $tmp[4];
                $data[$id][132] = $tmp[5];
                $data[$id][130] = $tmp[6];
                $data[$id][131] = $tmp[7];
                $data[$id][135] = $tmp[8];
                $data[$id][133] = $tmp[9];
                $data[$id][134] = $tmp[10];


                $column = $value['thiet_ke'];
                $tmp= explode('\_/', $column);
                $data[$id][123] = $tmp[0];
                $data[$id][124] = $tmp[1];

                $column = $value['pin'];
                $tmp= explode('\_/', $column);
                $data[$id][125] = $tmp[0];
                $data[$id][126] = $tmp[1];
               
            }      
        } /// end foreach      
        foreach ($data as $sp_id => $arrValue) {
            echo $sp_id;
            echo "<hr>";
            $model = new SpThuocTinh;
            $model->sp_id = $sp_id;
            $model->thuoc_tinh = json_encode($arrValue);
            $model->save();
        } 
    }
    public function chuyenContent(){
        $a = SanPham::all();
        foreach ($a as $key => $value) {
            $id = $value->id;
            $content = $value->chi_tiet;            
            $content = $this->nl2p($content);

            $model = SanPham::find($id);
            $model->chi_tiet = $content;
            $model->save();
            echo $id; 
            echo "<hr>";            
        }
    }
    public function nl2p($string, $line_breaks = true, $xml = true) {

        $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);

        // It is conceivable that people might still want single line-breaks
        // without breaking into a new paragraph.
        if ($line_breaks == true)
            return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'), trim($string)).'</p>';
        else 
            return '<p>'.preg_replace(
            array("/([\n]{2,})/i", "/([\r\n]{3,})/i","/([^>])\n([^<])/i"),
            array("</p>\n<p>", "</p>\n<p>", '$1<br'.($xml == true ? ' /' : '').'>$2'),

            trim($string)).'</p>'; 
        }
  
    public function mapDistrictTiki(){
        $arrCity = City::all();
        foreach( $arrCity as $city){
            unset($city_id);
            $city_id = $city->id;
            $a = $this->curlDistrict($city_id);
            $tmp = json_decode($a, true);
            $i = 0;            
            foreach($tmp as $district){            
                $i++;
                $arr['id'] = $district['id'];
                $arr['name'] = $district['name'];
                $arr['alias'] = Helper::stripUnicode($arr['name']);
                $arr['city_id'] = $city_id;                
                $arr['display_order'] = $i;               
                District::create($arr);
            }
           // echo "<pre>";
           // print_r($tmp);die;
        }
    }
    public function mapWardTiki(){
        $arrDistrict = District::all();
        foreach( $arrDistrict as $district){
            
            $city_id = $district->city_id;
            $district_id = $district->id;
            $a = $this->curlWard($district_id);
            $tmp = json_decode($a, true);
            //var_dump("<pre>", $tmp);die;
            $i = 0;            
            foreach($tmp as $b){            
                $i++;
                $arr['id'] = $b['id'];
                $arr['name'] = $b['name'];
                $arr['alias'] = Helper::stripUnicode($arr['name']);
                $arr['city_id'] = $city_id;
                $arr['district_id'] = $district_id;
                $arr['display_order'] = $i;               
                Ward::create($arr);
            }
           // echo "<pre>";
           // print_r($tmp);die;
        }
    }
    public function curlWard($district_id){
        $post = [
            'city_id' => $district_id
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tiki.vn/customer/address/ajaxWard');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $response = curl_exec($ch);
    return $response;
    }
    public function curlDistrict($region_id){
        $post = [
            'region_id' => $region_id
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://tiki.vn/customer/address/ajaxDistrict');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        $response = curl_exec($ch);
    return $response;
    }
    public function processPage(){
        $arr = WpPosts::where('post_type', 'page')->where('post_status', 'publish')->get();

        foreach($arr as $value){
            if( in_array($value->ID, [3057, 3061, 3063, 3066, 3069, 3070, 3071])){                  
                echo $value->ID;
                echo "<hr>";
                $data['created_at'] = $value['post_date'];
                $data['updated_at'] = $value['post_modified'];
                $data['title'] = $value['post_title'];
                $data['meta_title'] = $value['post_title'];
                $data['slug'] = $value['post_name'];
                $data['description'] = $value['post_excerpt'];
                $data['alias'] = Helper::stripUnicode($data['title']);               
                $data['content'] = $value['post_content'];
                $data['created_user'] = Auth::user()->id;
                $data['updated_user'] = Auth::user()->id;
                
                $rs = Pages::create($data);
            }
        }
    }
    public function updateIsSale(){
        $arr = SanPham::all();
        foreach( $arr as $sp ){
            $id = $sp->id;
            echo $id;
            echo "<hr>";
            $model = SanPham::find( $id );
            if( $sp->price_sale > 0 ){
                $model->is_sale = 1;
            }else{
                $model->is_sale = 0;
            }
            $model->save();
        }
    }
    public function mapThuocTinhLcd(){
        set_time_limit(10000);
        $arr = WpAlcddigital::whereRaw('1')->get()->toArray();
        //var_dump($arr);die;
        $arrData = [];
        foreach($arr as $value){
            $external_id = $value['id_product'];
            //var_dump($external_id);die;
            $rs = SanPham::where('external_id', $external_id)->get()->toArray();
            if(!empty($rs)){
                $id = $rs[0]['id'];
                                
                $arrData[$id] = [
                    86 => $value['kich_thuoc_man_hinh'],
                    87 => $value['do_phan_giai'],
                    88 => $value['ho_tro_mau_sac'],
                    89 => $value['ty_le_tuong_phan'],
                    90 => $value['do_sang'],
                    91 => $value['thoi_gian_dap_ung'],
                    92 => $value['goc_nhin'],
                    93 => $value['ket_noi']
                ];      
                            
                
            }      
        }          
        foreach ($arrData as $sp_id => $arrValue) {
            echo $sp_id;
            echo "<hr>";
            $model = new SpThuocTinh;
            $model->sp_id = $sp_id;
            $model->thuoc_tinh = json_encode($arrValue);
            $model->save();
        } 
    }
    public function processPrice( ){
        set_time_limit(10000);
        $arrSP = SanPham::lists('external_id')->toArray();
       
        foreach( $arrSP as $external_id){
            //var_dump($external_id);die;
            $tmp = WpPostMeta::where('post_id', $external_id)->get();
           
            foreach ($tmp as $k => $v){
                $is_sale = 0;
                if( $v['meta_key'] == '_regular_price'){                
                    $price = $v['meta_value'];
                }
                if( $v['meta_key'] == '_sale_price'){                
                    $price_sale = $v['meta_value'];
                }
                if(isset($price) && isset($price_sale) && $price != $price_sale ){
                    $is_sale = 1;
                }
                $rs = SanPham::where('external_id', $external_id)->get()->toArray();
                if(!empty($rs)){
                    //var_dump($rs);die;
                    $id = $rs[0]['id'];
                    echo "-----".$id;
                    $model = SanPham::find($id);
                    if( isset($price)) {
                        $model->price = $price;
                    }
                    if( isset($price_sale)) {
                        $model->price_sale = $price_sale;
                    }
                    $model->is_sale = $is_sale;
                    $model->save();
                }
            }
        }
        
    }
    public function processPhuKien( ){
        $arrSP = SanPham::lists('external_id')->toArray();
        
        foreach( $arrSP as $external_id){
            $tmp = WpPostMeta::where('post_id', $external_id)->where('meta_key', '_upsell_ids')->get();
            if( !empty($tmp->toArray())){
               $data = $tmp->toArray();
                $data = $data[0];
                $meta_value = $data['meta_value'];
                $arr = (unserialize($meta_value));
                if( !empty($arr) ){
                    $phu_kien = implode(',', $arr);
                    $rs = SanPham::where('external_id', $external_id)->get()->toArray();
                    if(!empty($rs)){
                        //var_dump($rs);die;
                        $id = $rs[0]['id'];
                        echo "-----".$id;
                        $model = SanPham::find($id);                    
                        $model->sp_phukien = $phu_kien;
                        $model->save();
                    }
                }
                
            }      
        }
    }

    public function processSpTuongTu(){
        $arrSP = SanPham::lists('external_id')->toArray();
        
        foreach( $arrSP as $external_id){

            $tmp = WpPostMeta::where('post_id', $external_id)->where('meta_key', '_crosssell_ids')->get();
            if( !empty($tmp->toArray())){
               $data = $tmp->toArray();
                $data = $data[0];
                $meta_value = $data['meta_value'];
                $arr = (unserialize($meta_value));
                if( !empty($arr) ){
                    $sp_tuongtu = implode(',', $arr);
                    $rs = SanPham::where('external_id', $external_id)->get()->toArray();
                    if(!empty($rs)){
                        //var_dump($rs);die;
                        $id = $rs[0]['id'];
                        echo "-----".$id;
                        echo "<hr>";
                        $model = SanPham::find($id);                    
                        $model->sp_tuongtu = $sp_tuongtu;
                        $model->save();
                    }
                }
                
            }  
        }    
    }

    public function processPostMeta( $post_id ){        
        echo "<hr>";
        $arrReturn = [];
        $tmp = WpPostMeta::where('post_id', $post_id)->get();
        foreach ($tmp as $k => $v){
            
            if( $v['meta_key'] == '_thumbnail_id'){                
                $arrReturn['thumbnail_id'] = $v['meta_value'];
            }            
            if( $v['meta_key'] == '_weight'){                
                $arrReturn['can_nang'] = $v['meta_value'];
            }
            if( $v['meta_key'] == '_length'){                
                $arrReturn['chieu_dai'] = $v['meta_value'];
            }
            if( $v['meta_key'] == '_width'){                
                $arrReturn['chieu_rong'] = $v['meta_value'];
            }
            if( $v['meta_key'] == '_height'){                
                $arrReturn['chieu_cao'] = $v['meta_value'];
            }
             if( $v['meta_key'] == '_stock'){                
                $arrReturn['so_luong_ton'] = (int) $v['meta_value'];
            }
            if( $v['meta_key'] == '_stock_status'){                
                if($v['meta_value'] == 'instock'){
                    $arrReturn['con_hang'] = 1;    
                }else{
                    $arrReturn['con_hang'] = 0;    
                }
                
            }
            
            if( $v['meta_key'] == '_price'){
                $arrReturn['price'] = $v['meta_value'];
            }
            if( $v['meta_key'] == 'wps_subtitle'){
                $arrReturn['name_extend'] = $v['meta_value'];
            }
            if( $v['meta_key'] == '_product_image_gallery' && $v['meta_value'] != ''){
                $tmp1 = explode(',', $v['meta_value']);

                if( !empty($tmp1) ){
                    foreach ($tmp1 as $p_id) {

                        $wpPost = WpPosts::where('ID', $p_id)->get()->toArray();
                        if(isset($wpPost[0])){
                            $guid = str_replace("http://www.icho.vn/wp-content/uploads/", "", $wpPost[0]['guid']);
                            $arrReturn['img']['id'][]= $p_id;
                            $arrReturn['img']['url'][] = $guid;                     
                        }
                        
                        
                    }                
                }
            }
        }
        if( empty($arrReturn['img']) && $arrReturn['thumbnail_id'] > 0){
            $arrReturn['img']['id'][]= $arrReturn['thumbnail_id'];
            $wpPost = WpPosts::where('ID',  $arrReturn['thumbnail_id'])->get()->toArray();
            $guid = str_replace("http://www.icho.vn/wp-content/uploads/", "", $wpPost[0]['guid']);
            $arrReturn['img']['url'][] = $guid;  
        }
        if(!in_array($arrReturn['thumbnail_id'], $arrReturn['img']['id'])){
          //  echo "aaaaaaaaaaa".$post_id;
            $arrReturn['img']['id'][] = $arrReturn['thumbnail_id'];
            $wpPost = WpPosts::where('ID',  $arrReturn['thumbnail_id'])->get()->toArray();
            $guid = str_replace("http://www.icho.vn/wp-content/uploads/", "", $wpPost[0]['guid']);
            $arrReturn['img']['url'][] = $guid;  
          
        }

        return $arrReturn;
    }
    public function processCate( $id ){

    }

    public function processImg( $id, $data){
        
        $thumbnail_id = isset($data['thumbnail_id']) ? $data['thumbnail_id'] : 0;
       
        if( $thumbnail_id > 0){
            if( isset( $data['img']) && !empty($data['img'])){
                $imgArr = $data['img'];

                foreach ($imgArr['url'] as $key => $value) {
                    
                    $dataHinh['sp_id'] = $id;
                    $dataHinh['image_url'] = $value;
                    $dataHinh['display_order'] = 1;
                    $rs = SpHinh::create($dataHinh);
                    $id_hinh = $rs->id;
                    if( $imgArr['id'][$key] == $thumbnail_id ){
                        $model = SanPham::find($id);
                        $model->thumbnail_id = $id_hinh;
                        $model->save();
                    }
                }
            }
        }
      

    }

    public function processThuocTinh( $id ){

    }
    
    public function chuyenLoaiSp($loai_id){
        $arrLoai = 
        [
            6 => 2,            
            30 => 8,
            33 => 10,
            58 => 1,
            62 => 4,
            67 => 5,
            69 => 3,
            76 => 6,
            116 => 7,
            117 => 11,
            17 => 9,
            118 => 12,
        ];
        return isset($arrLoai[$loai_id]) ? $arrLoai[$loai_id] : 0;
       
        
    }
    public function chuyenCate( $cate_id ){
        
        $arrCate = [
            8 => 5,
            10 => 8,
            12 => 7,
            13 => 9,
            97 => 6,
            111 => 10,
            88 => 31,
            89 => 32,
            90 => 35,
            91 => 34,
            125 => 33,
            77 => 30,
            79 => 28,
            80 => 29,
            81 => 27,
            82 => 26,
            83 => 24,
            112 => 25,
            70 => 14,
            71 => 65,
            72 => 13,
            73 => 16,
            75 => 15,
            100 => 11,
            121 => 12,
            68 => 20,
            84 => 22,
            85 => 19,
            86 => 23,
            63 => 17,
            64 => 18,
            59 => 4,
            60 => 3,
            61 => 1,
            124 => 2,

            31 => 37, //apply
            32 => 38, //
            35 => 39, //
            37 => 40, //
            38 => 41, //
            39 => 42, // 
            40 => 43, //
            41 => 44, //
            43 => 45, //
            44 => 46, //
            45 => 47, //
            46 => 48, //
            47 => 49, //
            49 => 50, //
            50 => 51, //
            51 => 52, //
            57 => 53, //
            101 => 54, //
            122 => 55, //
            34 => 56,
            36 => 57,
            42 => 58,
            48 => 59,
            53 => 60,
            54 => 61,
            55 => 62,
            56 => 63,
            99 => 64,
            102 => 66,
            107 => 67,
            109 => 68,
            113 => 69,
            115 => 70,
            119 => 71,
            120 => 72,
            123 => 73,
            22 => 74,
            65 => 75,
            66 => 76,
            87 => 77,
            106 => 78,
            108 => 79,
            110 =>  80,
            117 => 81,
            118 => 82,
            28 => 83
        ];
        return isset($arrCate[$cate_id]) ? $arrCate[$cate_id] : 0;
    }

    public function tmpProcessCate(){
        $tmp = WpTermTaxonomy::whereRaw('1')->where('taxonomy', 'product_cat')
                 ->join('wp_terms', 'wp_term_taxonomy.term_id', '=', 'wp_terms.term_id')                            
                 //->where('wp_term_taxonomy.parent', 0)
                 ->select('wp_term_taxonomy.*', 'wp_terms.name')
                 ->get()->toArray();
                 $arrParent= [];
        foreach ($tmp as $key => $value) {
            
            $parent_id = $value['parent'];
            //echo "<br >";
            //echo $parent_id."-"; 
            if($parent_id == 30){
                $detailParent = WpTerms::where('term_id', $parent_id)->get()->toArray();
              //  echo isset($detailParent[0]) ? $detailParent[0]['name'] : "";
                //echo $value['term_id']."-".$value['name']."<br >";

                $arrParent[$value['term_id']] = $value['name'];
            }
           
        }            

        echo "<pre>";
        print_r($arrParent);die;
    }

    public function mapProduct(){

         set_time_limit(10000);
         $tmp = WpPosts::where('post_type', '=', 'product')
                ->where('post_status', '=', 'trash')
                ->where('wp_term_taxonomy.taxonomy', '=', 'product_cat')
               
                ->join('wp_term_relationships', 'wp_posts.id', '=', 'wp_term_relationships.object_id')                 
                 ->leftJoin('wp_term_taxonomy', 'wp_term_taxonomy.term_taxonomy_id', '=', 'wp_term_relationships.term_taxonomy_id')
                 ->leftJoin('wp_terms', 'wp_term_taxonomy.term_id', '=', 'wp_terms.term_id')
                 ->select('wp_term_taxonomy.*', 'wp_terms.name as term_name', 'wp_posts.*')
                 ->get()->toArray();
                 $arrParent= [];
   
               //  var_dump("<pre>", $tmp);die;
        foreach ($tmp as $key => $value) {
           
            echo $id = $value['ID'];
           
            $data = $this->processPostMeta( $id );
            /*
            echo "<pre>"; print_r($data['img']['url']);
            if(empty($data['img']['url'])){
                echo "aaaaaaaaaaaaaaa".$id;
            }
             foreach($data['img']['url'] as $img){
                echo '<img src="'.Helper::showImage($img).'" width="50" />';

            }
            echo "<hr>";
           */
            $data['external_id'] = $id;   
            $data['cate_id'] = $this->chuyenCate( $value['term_id']);
            $data['loai_id'] = $this->chuyenLoaiSp( $value['parent']);
            $data['created_at'] = $value['post_date'];
            $data['updated_at'] = $value['post_modified'];
            $data['name'] = $value['post_title'];
            $data['slug'] = $value['post_name'];
            $data['mota_1'] = $value['post_excerpt'];
            $data['alias'] = Helper::stripUnicode($data['name']);
            $data['alias_extend'] = Helper::stripUnicode($data['name_extend']);
            $data['slug_extend'] = str_slug($data['name_extend']);
            $data['chi_tiet'] = $value['post_content'];
            $data['created_user'] = Auth::user()->id;
            $data['updated_user'] = Auth::user()->id;
            //echo "<pre>";print_r($data);echo "</pre>";
            //echo "<hr/>";
          
            $rs = SanPham::create($data);            
            
            $id = $rs->id;
            
            $this->processImg( $id, $data);
          

        }
    }
    
    public function mapThuocTinhLaptop(){
         set_time_limit(10000);
        $arr = WpAlaptopdigital::whereRaw('1')->get()->toArray();
        $data = [];
        foreach($arr as $value){
            $external_id = $value['id_product'];
            //var_dump($external_id);die;
            $rs = SanPham::where('external_id', $external_id)->get()->toArray();
            if(!empty($rs)){
                $id = $rs[0]['id'];
                // bo_xu_ly
                $column = $value['bo_xu_ly'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 46; $i <= 51; $i++ ){
                        $pos = $i-46;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }

                //bo_mach
                $column = $value['bo_mach'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 81; $i <= 83; $i++ ){
                        $pos = $i-81;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //bo_nho
                $column = $value['bo_nho'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 52; $i <= 54; $i++ ){
                        $pos = $i-52;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //dia_cung
                $column = $value['dia_cung'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 55; $i <= 56; $i++ ){
                        $pos = $i-55;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //man_hinh
                $column = $value['man_hinh'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 57; $i <= 60; $i++ ){
                        $pos = $i-57;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //man_hinh
                $column = $value['do_hoa'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 61; $i <= 63; $i++ ){
                        $pos = $i-61;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                 //am_thanh
                $column = $value['am_thanh'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 84; $i <= 85; $i++ ){
                        $pos = $i-84;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                 //dia_quang
                $column = $value['dia_quang'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 64; $i <= 65; $i++ ){
                        $pos = $i-64;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                 //network
                $column = $value['network'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 66; $i <= 67; $i++ ){
                        $pos = $i-66;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                 //giao_tiep_mang
                $column = $value['giao_tiep_mang'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 68; $i <= 70; $i++ ){
                        $pos = $i-68;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //card_reader
                $column = $value['card_reader'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 71; $i <= 72; $i++ ){
                        $pos = $i-71;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //webcam
                $column = $value['webcam'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 73; $i <= 74; $i++ ){
                        $pos = $i-73;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //pin
                $column = $value['pin'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 75; $i <= 75; $i++ ){
                        $pos = $i-75;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                //ios
                $column = $value['ios'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 76; $i <= 77; $i++ ){
                        $pos = $i-76;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }

                 //kich_thuoc
                $column = $value['kich_thuoc'];
                $tmp= explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 78; $i <= 80; $i++ ){
                        $pos = $i-78;
                       if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }  
                    }                    
                }
            }      
        } /// end foreach
        //echo "<pre>"; //echo count($data);
       // print_r($data);die;
        foreach ($data as $sp_id => $arrValue) {
            echo $sp_id;
            echo "<hr>";
            $model = new SpThuocTinh;
            $model->sp_id = $sp_id;
            $model->thuoc_tinh = json_encode($arrValue);
            $model->save();
        } 
    }

    public function mapThuocTinhDienThoai(){
        set_time_limit(10000);
        $arr = WpAphonedigital::whereRaw('1')->get()->toArray();
        $data = [];
        foreach($arr as $value){
            $external_id = $value['id_product'];
            //var_dump($external_id);die;
            $rs = SanPham::where('external_id', $external_id)->get()->toArray();
            if(!empty($rs)){
                $id = $rs[0]['id'];
                // bo_xu_ly
                $column = $value['monitor'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 1; $i <= 5; $i++ ){
                        $pos = $i-1;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }

                // bo_xu_ly
                $column = $value['back_camera'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 6; $i <= 9; $i++ ){
                        $pos = $i-6;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }

                // bo_xu_ly
                $column = $value['front_camera'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 10; $i <= 13; $i++ ){
                        $pos = $i-10;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
                // bo_xu_ly
                $column = $value['system'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 14; $i <= 17; $i++ ){
                        $pos = $i-14;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
                // bo_xu_ly
                $column = $value['memory'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 18; $i <= 22; $i++ ){
                        $pos = $i-18;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
                // bo_xu_ly
                $column = $value['network'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 23; $i <= 34; $i++ ){
                        $pos = $i-23;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
                // bo_xu_ly
                $column = $value['design'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 35; $i <= 38; $i++ ){
                        $pos = $i-35;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
                // bo_xu_ly
                $column = $value['cell'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 39; $i <= 40; $i++ ){
                        $pos = $i-39;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
                // bo_xu_ly
                $column = $value['entertainment'];
                $tmp = explode('\_/', $column);
                if( !empty($tmp) ){
                    for($i = 41; $i <= 45; $i++ ){
                        $pos = $i-41;
                        if( $tmp[$pos] != ''){
                            $data[$id][$i] = $tmp[$pos];
                        }                        
                    }                    
                }
               
            }      
        } /// end foreach
        //echo "<pre>"; //echo count($data);
        //print_r($data);die;
        foreach ($data as $sp_id => $arrValue) {
            echo $sp_id;
            echo "<hr>";
            $model = new SpThuocTinh;
            $model->sp_id = $sp_id;
            $model->thuoc_tinh = json_encode($arrValue);
            $model->save();
        } 
    }
}
