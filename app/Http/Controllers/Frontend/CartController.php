<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\LoaiSp;
use App\Models\Cate;
use App\Models\Product;
use App\Models\SpThuocTinh;
use App\Models\SpHinh;
use App\Models\ThuocTinh;
use App\Models\City;
use App\Models\LoaiThuocTinh;
use App\Models\Banner;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Events;
use App\Models\ProductEvent;
use Helper, File, Session, Auth;
use Mail;

class CartController extends Controller
{

    public static $loaiSp = [];
    public static $loaiSpArrKey = [];


    /**
    * Session products define array [ id => quantity ]
    *
    */

    public function __construct(){
        // Session::put('products', [
        //     '1' => 2,
        //     '3' => 3
        // ]);
        // Session::put('login', true);
        // Session::put('userId', 1);
        // Session::forget('login');
        // Session::forget('userId');

    }
    public function index(Request $request)
    {
        if(!Session::has('products')) {
            return redirect()->route('home');
        }

        $getlistProduct = Session::get('products');
        $listProductId = array_keys($getlistProduct);
        $arrProductInfo = Product::whereIn('product.id', $listProductId)
                            ->leftJoin('sp_hinh', 'sp_hinh.id', '=','product.thumbnail_id')
                            ->select('sp_hinh.image_url', 'product.*')->get();
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Giỏ hàng";
        return view('frontend.cart.index', compact('arrProductInfo', 'getlistProduct', 'seo'));
    }

    public function update(Request $request)
    {
        $listProduct = Session::get('products');
        if($request->quantity) {
            $listProduct[$request->id] = $request->quantity;
        } else {
            unset($listProduct[$request->id]);
        }
        Session::put('products', $listProduct);
        return 'sucess';
    }

    public function addProduct(Request $request)
    {
        $listProduct = Session::get('products');



        if(!empty($listProduct[$request->id])) {
            $listProduct[$request->id] += 1;
        } else {
            $listProduct[$request->id] = 1;
        }

        Session::put('products', $listProduct);

        return 'sucess';
    }

    public function shippingStep1(Request $request)
    {
        $getlistProduct = Session::get('products');
        //$chon_dich_vu = $request->chon_dich_vu;
        $so_dich_vu = $request->so_dich_vu;
        $phi_dich_vu = $request->phi_dich_vu;        
        $listProductId = array_keys($getlistProduct);
        /*
        $service_fee = [];
        $totalServiceFee = 0;
        foreach($listProductId as $product_id){
            if(isset($chon_dich_vu[$product_id]) && $chon_dich_vu[$product_id] == 1){
                $service_fee[$product_id]['fee'] = $so_dich_vu[$product_id]*$phi_dich_vu[$product_id];
                $service_fee[$product_id]['so_luong'] = $so_dich_vu[$product_id];
                $service_fee[$product_id]['don_gia_dich_vu'] = $phi_dich_vu[$product_id];
                $totalServiceFee+= $service_fee[$product_id]['fee'];
            }
        }
        */
        //Session::set('service_fee', $service_fee);
        //Session::set('totalServiceFee', $totalServiceFee);
        
        if(Session::get('login') || Session::get('new-register')) {
            return redirect()->route('shipping-step-2');
        }

        if(empty($getlistProduct)) {
            return redirect()->route('home');
        }
        
        $listProductId = array_keys($getlistProduct);

        /*$chon_dich_vu = $request->chon_dich_vu;
        $so_dich_vu = $request->so_dich_vu;
        $phi_dich_vu = $request->phi_dich_vu;

        
        $service_fee = [];
        $totalServiceFee = 0;
        foreach($listProductId as $product_id){
            if(isset($chon_dich_vu[$product_id]) && $chon_dich_vu[$product_id] == 1){
                $service_fee[$product_id]['fee'] = $so_dich_vu[$product_id]*$phi_dich_vu[$product_id];
                $service_fee[$product_id]['so_luong'] = $so_dich_vu[$product_id];
                $service_fee[$product_id]['don_gia_dich_vu'] = $phi_dich_vu[$product_id];
                $totalServiceFee+= $service_fee[$product_id]['fee'];
            }
        }
        */
        $arrProductInfo = Product::whereIn('product.id', $listProductId)
                            ->leftJoin('sp_hinh', 'sp_hinh.id', '=','product.thumbnail_id')
                            ->select('sp_hinh.image_url', 'product.*')->get();

        //$service_fee = Session::get('service_fee') ? Session::get('service_fee') : 0;
        $seo = Helper::seo();
        return view('frontend.cart.shipping-step-1', compact('arrProductInfo', 'getlistProduct' , 'seo' ));
    }

    public function shippingStep2(Request $request)
    {
        $is_vanglai = Session::get('is_vanglai') ? Session::get('is_vanglai') : 0;
        $getlistProduct = Session::get('products');
        if($is_vanglai == 0){
            if((empty($getlistProduct) || !Session::get('login')) && !Session::has('new-register') )  {
                return redirect()->route('home');
            }
        }

        $listProductId = $getlistProduct ? array_keys($getlistProduct) : [];
        $arrProductInfo = Product::whereIn('product.id', $listProductId)
                            ->leftJoin('sp_hinh', 'sp_hinh.id', '=','product.thumbnail_id')
                            ->select('sp_hinh.image_url', 'product.*')->get();
        $listCity = City::orderBy('display_order')->get();

        $userId = Session::get('userId');
        $customer = Customer::find($userId);

        // check info
        // if(!$customer->full_name ||
        //    !$customer->email ||
        //    !$customer->address ||
        //    !$customer->phone ||
        //    !$customer->district_id ||
        //    !$customer->city_id ||
        //    !$customer->ward_id
        // ) {
        //     Session::flash('update-information', true);
        //     return redirect()->route('cap-nhat-thong-tin');
        // }
        // end
        //$totalServiceFee = Session::get('totalServiceFee') ? Session::get('totalServiceFee') : 0;
        $totalServiceFee = 0;
        if(is_null($customer)) $customer = new Customer;
        $seo = Helper::seo();
        
        return view('frontend.cart.shipping-step-2', compact('customer', 'listCity', 'seo', 'is_vanglai', 'getlistProduct', 'arrProductInfo'));
    }

    public function updateUserInformation(Request $request)
    {
        $getlistProduct = Session::get('products');

        $listProductId = $getlistProduct ? array_keys($getlistProduct) : [];

        $listCity = City::orderBy('display_order')->get();

        $userId = Session::get('userId');
        $customer = Customer::find($userId);

        if(is_null($customer)) $customer = new Customer;
        $seo = Helper::seo();
        return view('frontend.cart.register-infor', compact('customer', 'listCity', 'seo'));
    }

    public function setService(Request $request){
        
        Session::set('is_vanglai', 1);

    }

    public function shippingStep3(Request $request)
    {
        $userId = Session::get('userId');
        $customer = Customer::find($userId);
        

        $getlistProduct = Session::get('products');
        $is_vanglai = Session::get('is_vanglai') ? Session::get('is_vanglai') : 0;

        if($is_vanglai == 0){
            
            if(empty($getlistProduct) || !Session::get('login') || Session::has('new-register')) {
                return redirect()->route('home');
            }
            // check info
            if(!$customer->full_name ||
               !$customer->email ||
               !$customer->address ||
               !$customer->phone ||
               !$customer->district_id ||
               !$customer->city_id ||
               !$customer->ward_id
            ) {
                Session::flash('update-information', true);
                return redirect()->route('cap-nhat-thong-tin');
            }
        }        
        // end

        $listProductId = array_keys($getlistProduct);

        $arrProductInfo = Product::whereIn('product.id', $listProductId)
                            ->leftJoin('sp_hinh', 'sp_hinh.id', '=','product.thumbnail_id')
                            ->select('sp_hinh.image_url', 'product.*')->get();
        $totalCanNang = 0;
        foreach( $arrProductInfo as $product ){
            $canNangCongKenh = ($product->chieu_dai * $product->chieu_cao * $product->chieu_rong)/6000;
            $tmpCanNang =  $canNangCongKenh > $product->can_nang ? $canNangCongKenh : $product->can_nang;
            $totalCanNang += $tmpCanNang;
        }
        $vangLaiArr = Session::get('vanglai');
        $city_id = $is_vanglai == 1 && isset($vangLaiArr['city_id']) ? $vangLaiArr['city_id'] : $customer->city_id;
        $district_id = $is_vanglai == 1 && isset($vangLaiArr['district_id']) ? $vangLaiArr['district_id'] : $customer->district_id;    

        $phi_giao_hang = Helper::phiVanChuyen( $totalCanNang, $city_id, $district_id );
       
        //$totalServiceFee = Session::get('totalServiceFee') ? Session::get('totalServiceFee') : 0;
        $totalServiceFee = 0;
        
        $seo = Helper::seo();
        $total = 0;
        foreach($arrProductInfo as $product){
            $price = $product->is_sale ? $product->price_sale : $product->price;                
            $total += $getlistProduct[$product->id]*$price;                            
        }        
        $totalAmount = $total + $totalServiceFee + $phi_giao_hang;        
        $phi_cod = Helper::calCod($totalAmount, $city_id);                
        
        return view('frontend.cart.shipping-step-3', compact('arrProductInfo', 'getlistProduct', 'customer', 'phi_giao_hang', 'seo', 'is_vanglai', 'phi_cod', 'totalAmount'));
    }

    public function order(Request $request)
    {
        
        $getlistProduct = Session::get('products');
        $listProductId = array_keys($getlistProduct);
        $customer_id = Session::get('userId');
        $customer = Customer::find($customer_id);
        $is_vanglai = Session::get('is_vanglai') ? Session::get('is_vanglai') : 0;
        if($is_vanglai == 0){
            if(empty($listProductId) || !Session::get('login') || Session::has('new-register')) {
                return redirect()->route('home');
            }
        }
        
        

        $vangLaiArr = Session::get('vanglai');
        $arrProductInfo = Product::whereIn('product.id', $listProductId)
                            ->leftJoin('sp_hinh', 'sp_hinh.id', '=','product.thumbnail_id')
                            ->select('sp_hinh.image_url', 'product.*')->get();
        $order['tong_tien'] = 0;
        $order['tong_sp'] = array_sum($getlistProduct);
        $order['giam_gia'] = 0;
        $order['tien_thanh_toan'] = 0;
        $order['customer_id'] = Session::get('userId') ?  Session::get('userId') : 0;
        $order['status'] = 0;
        $order['coupon_id'] = 0;
        $order['district_id'] = isset($vangLaiArr['district_id']) ? $vangLaiArr['district_id'] : $customer->district_id;
        $order['city_id']  = isset($vangLaiArr['city_id']) ? $vangLaiArr['city_id'] : $customer->city_id;
        $order['ward_id']  = isset($vangLaiArr['ward_id']) ? $vangLaiArr['ward_id'] : $customer->ward_id;
        $order['address']  = isset($vangLaiArr['address']) ? $vangLaiArr['address'] : $customer->address;        
        $order['full_name']  = isset($vangLaiArr['full_name']) ? $vangLaiArr['full_name'] : $customer->full_name;
        $order['email']  = isset($vangLaiArr['email']) ? $vangLaiArr['email'] : $customer->email;
        $order['phone']  = isset($vangLaiArr['phone']) ? $vangLaiArr['phone'] : $customer->phone;
        $order['address_type']  = isset($vangLaiArr['address_type']) ? $vangLaiArr['address_type'] : $customer->address_type;
        $order['method_id'] = isset($vangLaiArr['payment_method']) ? $vangLaiArr['payment_method'] : $request->payment_method;

        // check if ho chi minh free else 150k

        $order['phi_giao_hang'] = (int) $request->phi_giao_hang;
        $order['phi_cod'] = (int) $request->phi_cod;
        //$order['service_fee'] = Session::get('totalServiceFee') ? Session::get('totalServiceFee') : 0;
        $order['service_fee'] = 0;
        foreach ($arrProductInfo as $product) {
            $price = $product->is_sale ? $product->price_sale : $product->price;        
            $order['tong_tien'] += $price * $getlistProduct[$product->id];
        }

        $order['tong_tien'] = $order['tien_thanh_toan'] = $order['tong_tien'] + $order['phi_giao_hang'] + $order['service_fee'] + $order['phi_cod'];
        $city_id = isset($vangLaiArr['city_id']) ? $vangLaiArr['city_id'] :  $customer->city_id;
        $arrDate = Helper::calDayDelivery( $city_id );
        
        $order['ngay_giao_du_kien'] = implode(" - ", $arrDate);


        $getOrder = Orders::create($order);

        $order_id = $getOrder->id;

        Session::put('order_id', $order_id);

        $orderDetail['order_id'] = $order_id;
        //$service_fee = Session::get('service_fee');
       
        foreach ($arrProductInfo as $product) {            
            # code...
            $orderDetail['sp_id']        = $product->id;
            $orderDetail['so_luong']     = $getlistProduct[$product->id];
            $orderDetail['don_gia']      = $product->price;
            $orderDetail['tong_tien']    = $getlistProduct[$product->id]*$product->price;
            //$orderDetail['so_dich_vu']    = isset($service_fee[$product->id]) ? $service_fee[$product->id]['so_luong'] : 0;
            $orderDetail['so_dich_vu']    =  0;
            //$orderDetail['don_gia_dich_vu']    = isset($service_fee[$product->id]) ? $service_fee[$product->id]['don_gia_dich_vu'] : 0;
            $orderDetail['don_gia_dich_vu']    = 0;
            //$orderDetail['tong_dich_vu']    = isset($service_fee[$product->id]) ? $service_fee[$product->id]['fee'] : 0;
            $orderDetail['tong_dich_vu']    = 0;
            OrderDetail::create($orderDetail); 

            //  check so luong
            if($product->is_event == 1){ // san pham event
                $event_id = Session::get('event_id') ? Session::get('event_id') : 0;
                if($event_id == 0){
                    $dt = Carbon::now()->format('Y-m-d H:i:s');
                    $tmpEvent = Events::where('from_date', '<=', $dt)->where('to_date', '>=', $dt)->where('status', 1)->join('product_event', 'sp_id', '=', 'events.id')->select('event_id')->first();
                    if($tmpEvent){
                        $event_id = $tmpEvent->event_id;
                    }
                }

                $tmpPE = ProductEvent::where('sp_id', $product->id)->where('event_id', $event_id)->first();
                if($tmpPE){                    
                    $tmpSL = $tmpPE->so_luong_tam > 0 ? $tmpPE->so_luong_tam - 1 : 0;
                    $tmpPE->update(['so_luong_tam' => $tmpSL]);
                }                

            }else{
                $tmpModelProduct = Product::find($product->id);
                $tmpSL = $tmpModelProduct->so_luong_tam > 0 ? $tmpModelProduct->so_luong_tam - 1 : 0;
                $tmpModelProduct->update(['so_luong_tam' => $tmpSL]);
            }
        }

        $customer_id = Session::get('userId');
        $customer = Customer::find($customer_id);

        $email = isset($vangLaiArr['email']) ? $vangLaiArr['email'] :  $customer->email;
        if($email != ''){
            $emailArr = array_merge([$email], ['tundq.ipl@gmail.com', 'tundq@icare.center', 'hiepvv.ipl@gmail.com', 'lamhuong77@gmail.com', 'chamsoc@icho.vn', 'hoangnhonline@gmail.com']);
        }else{
            $emailArr = ['tundq.ipl@gmail.com', 'tundq@icare.center', 'hiepvv.ipl@gmail.com', 'lamhuong77@gmail.com', 'chamsoc@icho.vn', 'hoangnhonline@gmail.com'];
        }
        // send email
        $order_id =str_pad($order_id, 6, "0", STR_PAD_LEFT);
        $emailArr = [];
        if(!empty($emailArr)){
            Mail::send('frontend.email.cart',
                [
                    'customer'          => $customer,
                    'order'             => $getOrder,
                    'arrProductInfo'    => $arrProductInfo,
                    'getlistProduct'    => $getlistProduct,
                    'arrDate' => $arrDate,
                    'phi_giao_hang' => $order['phi_giao_hang'],
                    'method_id' => $order['method_id'],
                    'order_id' => $order_id,
                    'is_vanglai' => $is_vanglai
                ],
                function($message) use ($emailArr, $order_id) {
                    $message->subject('Xác nhận đơn hàng hàng #'.$order_id);
                    $message->to($emailArr);
                    $message->from('icho.vn@gmail.com', 'NhaDat');
                    $message->sender('icho.vn@gmail.com', 'NhaDat');
            });
        }
        
        return 'success';

    }

    public function success(Request $request){

        $getlistProduct = Session::get('products');
        $is_vanglai = Session::get('is_vanglai') ? Session::get('is_vanglai') : 0;
        $vangLaiArr = Session::get('vanglai');
        if(empty($getlistProduct)) {
            return redirect()->route('home');
        }
        $customer_id = Session::get('userId');

        $customer = Customer::find($customer_id);
        $vangLaiArr = Session::get('vanglai');
        $city_id = $is_vanglai == 1 && isset($vangLaiArr['city_id']) ? $vangLaiArr['city_id'] : $customer->city_id;
        $arrDate = Helper::calDayDelivery( $city_id );

        $order_id = Session::get('order_id');

        $order_id =str_pad($order_id, 6, "0", STR_PAD_LEFT);
        Session::put('products', []);
        Session::put('order_id', '');
        Session::forget('is_vanglai');
        Session::forget('vanglai');
        //Session::forget('service_fee');
        //Session::forget('totalServiceFee');
        Session::forget('event_id');
        Session::forget('order_id');


        $seo = Helper::seo();

        return view('frontend.cart.success', compact('order_id', 'customer', 'arrDate', 'seo', 'is_vanglai', 'vangLaiArr'));
    }

    public function deleteAll(){
        Session::put('products', []);
        return redirect()->route('gio-hang');
    }
}

