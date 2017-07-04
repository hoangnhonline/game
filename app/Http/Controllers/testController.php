<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Backend\Banner;

class testController extends Controller
{
	public function index()
	{
		dd('you get here');
	}
}
