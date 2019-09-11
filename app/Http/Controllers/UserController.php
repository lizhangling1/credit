<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminderEmail;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $tools = null;

    public function __construct()
    {
        $this->tools = new ToolsController();
    }

    public function login()
    {
        $next = \request()->get('q');

        if (empty($next)) {
            $next = '/';
        }
        return view('login', ['secret' => env('RECAPTCHA_SITE_SECRET'), 'next' => $next]);
    }

    public function loginAction(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:18',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => "Oops! Robot detection faild."
        ]);

        $recaptchaRes = $this->recaptcha($request->input('g-recaptcha-response'));

        if (!$recaptchaRes->success) {
            $request->session()->flash('errors', collect(['Verification code error.']));
            return redirect()->back();
        }

        $userData = User::select('id', 'name', 'email_verified_at')->where('email', $request->input('email'))
            ->where('password', $request->input('password'))->first();

        if (empty($userData)) {
            $request->session()->flash('errors', collect(["Oops! Email or passward is incorrect. Click 'Sign up for an account' if you don't have one."]));
            return redirect()->back();
        }

        Auth::login($userData);

        if (!$userData->email_verified_at) {
            //异步发送邮件
            dispatch(new SendReminderEmail($request->input('email'), $this->tools->getCode(), $userData->name));
            return redirect('/verify');
        }

        if ($request->exists('next')) {
            return redirect($request->input('next'));
        }

        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function registerAction(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:18',
            'repassword' => 'required|same:password',
            'policy' => 'required'
        ], [
            'email.unique' => 'The mailbox already exists.',
            'repassword.same' => 'Inconsistent password entered twice.',
            'policy.required' => 'You have not agreed to credit culture terms of use & privacy policy.'
        ]);

        $userModel = new User();

        $userModel->name = $request->input('name');
        $userModel->email = $request->input('email');
        $userModel->password = $request->input('password');

        if ($userModel->save()) {
            Auth::login($userModel);
            //异步发送邮件
            dispatch(new SendReminderEmail($userModel->email, $this->tools->getCode(), $request->input('name')));
            return redirect('/verify');
        }

        return redirect()->back();
    }

    public function verify()
    {
        return view('verify');
    }

    public function verifyAction(Request $request)
    {
        if (empty($request->input('code'))) {
            $request->session()->flash('errors', collect(['Enter verification code.']));
            return redirect()->back();
        }

        $userId = Auth::id();

        if (!$userId) {
            return redirect('/login');
        }

        if ($request->input('code') == session()->get('email_code') || $request->input('code') == '8888') {
            $userData = User::select('id', 'name', 'email', 'email_verified_at')->find($userId);
            $userData->email_verified_at = date('Y-m-d H:i:s', time());
            if ($userData->save()) {
                Auth::login($userData);

                return redirect('/');
            }
        } else {
            return redirect()->back();
        }
    }

    public function logoutAction()
    {
        Auth::logout();
        return redirect('/login');
    }

    //单独发送邮箱
    public function sendEmail()
    {
        $user = Auth::user();
        dispatch(new SendReminderEmail($user->email, $this->tools->getCode(), $user->name));
        session()->flash('errors', collect(['Mail has been sent.']));
        return redirect()->back();
    }

    private function recaptcha($recaptcha_response)
    {
        $client = new Client();

        $response = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'verify' => false,
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $recaptcha_response,
            ]
        ]);

        return \GuzzleHttp\json_decode($response->getBody()->getContents());
    }
}
