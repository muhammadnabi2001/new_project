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
        $data=$request->validated();
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
    public function digit()
    {
        //dd(123);
        $user=Auth::user();
        $code = rand(1000, 9999);
        VerifyUser::create([
            'user_id' => Auth::id(),
            'code' => $code
        ]);
        SendMessage::dispatch($user, $code);
        return view('Login.digit');
    }
    public function code(Request $request)
    {
          //dd($request->code);
        $request->validate([

            'code' => 'required|digits:4',
        ]);
        $userId = Auth::id();
        $codeVerify = VerifyUser::where('user_id', $userId)
            ->where('code', $request->code)
            ->first();
        if ($codeVerify) {
            $user = User::find($userId);
            $user->email_verified_at = now();
            $user->save();
            return view('index')->with('success', 'Your verification code is correct!');
        } else {
            return view('Login.digit');
        }
    }
}
