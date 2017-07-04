<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use Helper, File, Session, Auth;
use Mail;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
       // return $request->email;
        $email = $request->email;
        $newsletter = Newsletter::where('email', $email)->first();
        if(is_null($newsletter)) {
           $newsletter = new Newsletter;
           $newsletter->email = $email;
           $newsletter->is_member = Customer::where('email', $email)->first() ? 1 : 0;
           $newsletter->save();
        }

        return 'sucess';
    }

    public function info(Request $request){
      
    }
}

