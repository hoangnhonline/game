<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\City;
use App\Models\CustomerNotification;
use Helper, File, Session, Auth, Hash, Validator;
use Mail;

class CustomerController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->all();

        $customer_id = Session::get('userId');
        if(isset($request->vang_lai) && $request->vang_lai == 1){
            Session::set('vanglai', $data);
        }else{
            $customer = Customer::find($customer_id)->update($data);
        }

        if(Session::has('new-register')) {
          Session::forget('new-register');
        }

        if(Session::has('fb_name')) {
          Session::forget('fb_name');
        }

        if(Session::has('fb_email')) {
          Session::forget('fb_email');
        }

        if(Session::has('fb_id')) {
          Session::forget('fb_id');
        }

        return 'sucess';
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $email = $request->email;

        $customer = Customer::where('email', $email)->first();
        $full_name = $request->full_name;
        $password = $request->password;

        if(!is_null($customer)) {
          Session::flash('validate', 'Email đã tồn tại');
          return 0;
        }

        $data['password'] = bcrypt($data['password']);
        $data['status'] = 1;
        $customer = Customer::create($data);

        //set Session user for login here
        Session::put('login', true);
        Session::put('userId', $customer->id);
        Session::put('username', $customer->full_name);
        Session::put('new-register', true);
        Session::forget('vanglai');
        Session::forget('is_vanglai');
        return "1";
    }
    public function forgetPassword(Request $request){        
        $this->validate($request, [
            'email_reset' => 'bail|required|email|exists:customers,email',            
        ],[
            'email_reset.required' => 'Vui lòng nhập email.',
            'email_reset.email' => 'Vui lòng nhập email hợp lệ.',
            'email_reset.exists' => 'Email không tồn tại trong hệ thống NhaDat.',
        ]);
        $email = $request->email_reset;
        $key = md5($request->email_reset.time().'NhaDat');
        $customer = Customer::where('email', $email)->first();
        $customer->key_reset = $key;
        $customer->save();
        Mail::send('frontend.account.forgot',
            [
                'key'  => $key
            ],
            function($message) use ($email) {
                $message->subject('Yêu cầu thay đổi mật khẩu');
                $message->to($email);
                $message->from('icho.vn@gmail.com', 'NhaDat');
                $message->sender('icho.vn@gmail.com', 'NhaDat');
        });
    }
    public function resetPassword(Request $request){
        $key = $request->key;
        $detailCustomer = Customer::where('key_reset', $key)->first();
        if(!$detailCustomer){
            return redirect()->route('home');
        }
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Cập nhật mật khẩu mới";

        return view('frontend.account.reset-password', compact('seo', 'detailCustomer'));
    }
    public function registerAjax(Request $request)
    {
        $data = $request->all();

        $email = $request->email;
        $customer = Customer::where('email', $email)->first();

        if(!is_null($customer)) {
          return response()->json(['error' => 'email']);
        }


        $data['password'] = bcrypt($data['password']);
        $data['status'] = 1;
        $customer = Customer::create($data);

        //set Session user for login here
        Session::put('login', true);
        Session::put('userId', $customer->id);
        Session::put('new-register', true);
        Session::put('username', $customer->full_name);
        Session::forget('vanglai');
        Session::forget('is_vanglai');
        return response()->json(['error' => 0]);
    }

    public function notification(){
        if(!Session::get('userId')){
            return redirect()->route('home');
        }
        $notiSale = $notiOrder = [];
        $tmpArr = CustomerNotification::where(['customer_id' => Session::get('userId')])->get();
        if($tmpArr){
            foreach($tmpArr as $tp){
                if($tp->type == 1){
                    $notiSale[] = $tp->toArray();
                }else{
                    $notiOrder[] = $tp->toArray();
                }                
            }
        }
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Thông báo của tôi";

        return view('frontend.account.notification', compact('notiSale', 'notiOrder', 'seo'));
    }
    public function accountInfo(){
        if(!Session::get('userId')){
            return redirect()->route('home');
        }
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Thông tin tài khoản";     
        $customer_id = Session::get('userId');
        $customer = Customer::find($customer_id);
        $listCity = City::orderBy('display_order')->get();
        return view('frontend.account.update-info', compact('seo', 'customer', 'listCity'));
    }
    public function changePassword(Request $request){
        if(!Session::get('userId')){
            return redirect()->route('home');
        }
        $errors = $request->errors ? $request->errors : [];
        $customerDetail = Customer::find(Session::get('userId'));
        if($customerDetail->facebook_id > 0){
            return redirect()->route('home');   
        }
        $seo['title'] = $seo['description'] = $seo['keywords'] = "Đổi mật khẩu";     
        $customer_id = Session::get('userId');
        $customer = Customer::find($customer_id);        
        return view('frontend.account.change-password', compact('seo', 'customer'));
    }
    public function saveNewPassword(Request $request){        
        if(!Session::get('userId')){
            return redirect()->route('home');
        }
        $customerDetail = Customer::find(Session::get('userId'));
        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $re_new_pass = $request->re_new_pass;
        $errors = [];
        if(!password_verify($old_pass,$customerDetail->password)){             
             $request->session()->flash('error', 'Mật khẩu cũ không đúng.');
             return redirect()->route('change-password');
        }else{
            if($new_pass == $re_new_pass){
                $password = bcrypt($new_pass);
                $customerDetail->password = $password;
                $customerDetail->save();
                $request->session()->flash('success', 'Đổi mật khẩu thành công.');
                return redirect()->route('change-password');
            }else{
                $request->session()->flash('error', 'Mật khẩu mới nhập lại không đúng.');
                return redirect()->route('change-password');  
            }
        }
    }

    public function saveResetPassword(Request $request){
        $email = $request->email;
        $customerDetail = Customer::where('email', $email)->first();        
        $new_pass = $request->new_pass;
        $re_new_pass = $request->re_new_pass;
        $errors = [];
        
        if($new_pass == $re_new_pass){
            $password = bcrypt($new_pass);
            $customerDetail->password = $password;
            $customerDetail->save();
            $request->session()->flash('success', 'Đổi mật khẩu thành công.');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Mật khẩu mới nhập lại không đúng.');
            return redirect()->back();  
        }
        
    }

    public function isEmailExist(Request $request)
    {
       $email = $request->email;
       $customer = Customer::where('email', $email)->first();

       return is_null($customer) ? 0 : 1;
    }
}

