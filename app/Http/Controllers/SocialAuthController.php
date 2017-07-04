<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\Customer;
use Helper, File, Session, Auth;
use App;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $providerUser = Socialite::driver('facebook')->user();
        $data['email'] = $providerUser->getEmail();

        $getCustomer = Customer::where('email', $data['email'])->first();

        if(is_null($getCustomer)) {
            Session::put('fb_id', $providerUser->getId());

            if(!$providerUser->getName()) {
                Session::put('fb_name', $providerUser->getName());
            }

            if(!$providerUser->getEmail()) {
                Session::put('fb_email', $providerUser->getEmail());
            }

            $customer = new Customer;
            $customer->full_name = $providerUser->getName();
            $customer->email = $providerUser->getEmail();
            $customer->facebook_id = $providerUser->getId();
            $customer->save();

            Session::flash('register', 'true');
            Session::put('login', true);
            Session::put('userId', $customer->id);
            Session::put('facebook_id', $customer->facebook_id);
            Session::put('username', $customer->full_name);
            Session::put('avatar', $customer->image_url);
            Session::put('new-register', true);
            Session::forget('vanglai');
            Session::forget('is_vanglai');
            return redirect()->route('shipping-step-2');


        } else {
            Session::put('login', true);
            Session::put('userId', $getCustomer->id);
            Session::put('username', $getCustomer->full_name);
            Session::put('facebook_id', $customer->facebook_id);
            Session::put('avatar', $getCustomer->image_url);
            Session::forget('vanglai');
            Session::forget('is_vanglai');
            return redirect()->route('shipping-step-2');
            // return redirect()->back();
        }

        // $data['id'] = $providerUser->getId();
        // $data['nickname'] = $providerUser->getNickname();
        // $data['name'] = $providerUser->getName();
        // $data['email'] = $providerUser->getEmail();
        // $data['avatar'] = $providerUser->getAvatar();
        // dd($data);
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $providerUser = Socialite::driver('google')->user();
        $data['email'] = $providerUser->email;

        $getCustomer = Customer::where('email', $data['email'])->first();

        if(is_null($getCustomer)) {
            Session::put('gg_id', $providerUser->user);

            if(!$providerUser->getName()) {
                 Session::put('gg_name', $providerUser->user['name']['familyName'] . $providerUser->user['name']['givenName']);
            }

            if(!$providerUser->getEmail()) {
                Session::put('gg_email', $providerUser->email);
            }

            return redirect()->route('shipping-step-1');

        } else {
            Session::put('login', true);
            Session::put('userId', $getCustomer->id);

            return redirect()->route('shipping-step-2');
        }
    }

    public function fbLogin(Request $request)
    {
        $fb_token = $request->token;

        $fb            = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
        $response      = $fb->get('/me?fields=id,name,email,picture.width(200).height(200)', $fb_token);
        $facebook_user = $response->getGraphUser();

        $facebook['email'] = $facebook_user['email'];
        $facebook['id']    = $facebook_user['id'];
        $facebook['name']  = $facebook_user['name'];
        $facebook['avatar']= $facebook_user['picture']['url'];

        $getCustomer = Customer::where('email', $facebook['email'])->first();

        if(is_null($getCustomer)) {
            Session::put('fb_id', $facebook['id']);

            if(!$facebook['name']) {
                Session::put('fb_name',  $facebook['name']);
            }

            if(!$facebook['email']) {
                Session::put('fb_email',  $facebook['email']);
            }

            $customer = new Customer;
            $customer->full_name    =  $facebook['name'];
            $customer->email        =  $facebook['email'];
            $customer->facebook_id  =  $facebook['id'];
            $customer->image_url    =  $facebook['avatar'];
            $customer->save();

            Session::flash('register', 'true');
            Session::put('login', true);
            Session::put('userId', $customer->id);
            Session::put('facebook_id', $customer->facebook_id);
            Session::put('username', $customer->full_name);
            Session::put('new-register', true);
            Session::flash('new-register-fb', 'true');
            return response()->json([
                'sucess' => 1
            ]);


        } else {

            if(!$getCustomer->image_url) {
                $getCustomer->image_url = $facebook['avatar'];
                $getCustomer->save();
            }

            Session::put('login', true);
            Session::put('userId', $getCustomer->id);
            Session::put('facebook_id', $getCustomer->facebook_id);
            Session::put('username', $getCustomer->full_name);
            Session::put('avatar', $getCustomer->image_url);
            
            return response()->json([
                'sucess' => 0
            ]);
        }




        return response()->json(['fb_token' => $fb_token, 'fbUser' => $facebook]);
    }

}
