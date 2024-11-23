<?php

namespace App\Http\Controllers;

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
    public function userupdate(Request $request, User $user)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
        $user->name=$request->name;
        $user->email=$request->email;
        if($request->role)
        {
            $user->role=$request->role;
        }
        $user->save();
        return redirect()->back()->with('success',"Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function userstore(Request $request)
    {
       $data=$request->validate([
            'name'=>'required|max:255',
            'email'=>'required|max:255|min:5|email|unique:users,email',
            'role'=>'required|max:255',
            'password'=>'required|min:5|max:255'
        ]);

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
