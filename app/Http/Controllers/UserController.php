<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user()
    {
        $user = User::where('role', '!=', 'admin')
            ->orderBy('id', 'desc')
            ->get();

        return view('User.users',['users'=>$user]);
    }
    public function usercreate()
    {
        return view('User.usercreate');
    }
    public function useredit(User $user)
    {
        //dd($user);
        return view('User.userupdate',['user'=>$user]);
    }
    public function userupdate(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $user->name = $data['name'];
        $user->email = $data['email'];
    
        if ($request->role) {
            $user->role = $data['role'];
        }
        $user->save();
        return redirect()->back()->with('success',"Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function userstore(UserCreateRequest $request)
    {
       $data=$request->validated();

        $data['password']=Hash::make($data['password']);
        User::create($data);
        return redirect('users')->with('success',"Ma'lumot muvvafaqiyatli qo'shildi");
    }
    public function userdelete(Request $request,User $user)
    {
        //dd($user);
        $user->delete();
        return redirect()->back()->with('success',"Ma'lumot muvvafaqiyatli o'chirildi");
    }
    public function yourself()
    {
        $user=Auth::user();
        return view('User.profile',['user'=>$user]);
    }
}
