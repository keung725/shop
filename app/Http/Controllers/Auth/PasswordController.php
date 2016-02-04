<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Response;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        if (property_exists($this, 'linkRequestView')) {
            return view($this->linkRequestView);
        }

        if (view()->exists('auth.passwords.email')) {
            return view('auth.passwords.email');
        }

        return view('auth.password');
    }

    public function sendResetLinkEmail(Request $request)
    {

        $inputData = Input::all();

        $rules = array(
            'email'     =>  'required|email',
        );
        $validator = Validator::make($inputData,$rules);

        if ($validator->fails()) {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {

            $broker = $this->getBroker();

            $response = Password::broker($broker)->sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    $this->getSendResetLinkEmailSuccessResponse($response);
                    return Response::json(['success' => true, 'message' => '更改密碼的方法已發送到你的電子郵件']);
                case Password::INVALID_USER:
                default:
                    $this->getSendResetLinkEmailFailureResponse($response);
                    $emailErrorArr = array('email' => ['沒有這個會員！']);
                    return Response::json(['success' => false, 'errors' => $emailErrorArr]);
            }
        }
    }

    public function reset(Request $request)
    {

        $inputData = Input::all();

        $rules = array(
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        );

        $validator = Validator::make($inputData,$rules);


        if ($validator->fails()) {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        } else {

            $credentials = $request->only(
                'email', 'password', 'password_confirmation', 'token'
            );

            $broker = $this->getBroker();

            $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
                $this->resetPassword($user, $password);
            });

            switch ($response) {
                case Password::PASSWORD_RESET:
                    $this->getResetSuccessResponse($response);
                    return Response::json(['success' => true, 'message' => '成功更改密碼！']);

                default:
                    $this->getResetFailureResponse($request, $response);
                    return Response::json(['success' => false, 'errors' => '異常錯誤, 請更新頁面再重試！']);
            }
        }
    }

}
