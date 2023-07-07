<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
     {
        $request->validate([
            // "name" => "required|max:255",
            "email" => "required|email:filter,dns",
        ]);

         $this->validateUserName($request);
         $response = $this->broker()->sendResetLink(
             $request-> only('email')
         );
         return $response == Password::RESET_LINK_SENT
             ? $this->sendResetLinkResponse($request, $response)
             : $this->sendResetLinkFailedResponse($request, $response);
     }
 
     protected function validateUserName(Request $request)
     {
         $request->validate(['email' => 'required|email:filter,dns']);
     }

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
}
