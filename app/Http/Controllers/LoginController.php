<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Jobs\SendMessage;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check(LoginRequest $request)
    {
        //dd($request->all());
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return view('index');
        } else {
            return redirect()->back();
        }
    }
    public function forgotpassword()
    {
        return view('Login.forgotpassword');
    }
    public function digit(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $code = rand(1000, 9999);

            VerifyUser::create([
                'user_id' => $user->id,
                'code' => $code
            ]);

            SendMessage::dispatch($user, $code);
            return view('Login.digit', ["email" => $email]);
        } else {
            return redirect()->back()->withErrors(['email' => 'E-mail topilmadi!']);
        }
    }

    public function code(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|max:6|min:4',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $userId = $user->id;

        $codeVerify = VerifyUser::where('user_id', $userId)->where('code', $request->code)->first();

        if ($codeVerify) {
            $user->email_verified_at = now();
            $user->save();

            Auth::login($user);

            $codeVerify->delete();

            return view('index')->with('success', 'Your verification code is correct!');
        } else {
            return view('Login.digit')->with('error', 'Invalid verification code')->with('email', $request->email);
            
        }
    }


    public function verifypage()
    {
        return view('Login.digit');
    }
}
