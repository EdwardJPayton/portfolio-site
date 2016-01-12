<?php

namespace App\Http\Controllers;

use Input;
use Session;
use Illuminate\Support\Facades\Request;

use App\User;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
  public function index()
  {

    if( Request::ajax() ) {
      return view('ajax.ajaxAboutNew');
    } else {
      return view('about');
    }

  }

}
