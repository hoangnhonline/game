<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Newsletter;
use Helper, File, Session, Auth;
use Mail;

class NewsletterController extends Controller
{
    public function registerNews(Request $request)
    {
dd($request);
        $register = 0; 
        $email = $request->email;
        $newsletter = Newsletter::where('email', $email)->first();
        if(is_null($newsletter)) {
           $newsletter = new Newsletter;
           $newsletter->email = $email;
           $newsletter->is_member = Customer::where('email', $email)->first() ? 1 : 0;
           $newsletter->save();
           $register = 1;
        }

        return $register;
    }
}

