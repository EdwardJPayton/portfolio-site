<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;


use Input;
use Session;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Mail;


class ContactController extends Controller
{

  public function index()
  {
    // Return arrays
    if( Request::ajax() ) {
      return view('ajax.ajaxContact');
    } else {
      return view('contact');
    }
  }


  //http://xwerocode.blogspot.co.uk/2015/02/an-alternative-to-laravel-5-contact-form.html
  //http://laravelblog.com/how-to-create-a-basic-contact-form-validate-input-and-send-mail
  public function submitForm(ContactRequest $r)
  {
    //if(Request::ajax()) {
      $data = Input::all();

      $messageData = array(
        'fromEmail'       => 'no-reply@website.co.uk',
        'toEmail'         => 'edwardjpayton@gmail.com',
        //
        'name'            => $data['name'],
        'email'           => $data['email'],
        'msg'             => $data['msg']
      );

      // Send form TODO - Mail not sending
      Mail::send('email.contact-form', $data, function($message) use ($messageData) {
          $message->to( $messageData['toEmail'], 'Me' )->subject( 'Contact Form' );
          $message->from( $messageData['fromEmail'], 'You' );
      });

      if(count(Mail::failures()) > 0) {
        return response()->json( [
          'sentStatus' => false,
          'sentMsg'    => 'The message did not send'
        ]);

      } else {
        return response()->json([
          'sentStatus' => true,
          'sentMsg'    => 'Message sent',
          'name'       => $data['name'],
          'email'      => $data['email'],
          'msg'        => $data['msg']
        ]);
      }
    //}
  }
  
}
