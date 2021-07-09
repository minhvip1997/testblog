<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index(){
        return view('layouts.app');
    }

    public function getLogin(){
        return view('auths.login');
    }

    public function getRegister(){
        return view('auths.register');
    }

    public function postRegister(Request $request){
        $this->validate($request,
        [
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:32',
            'password_confirmation'=>'required|same:password',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải có ít nhất 3 ký tự',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Bạn chưa nhập đúng định dạng email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
            'password.max'=>'Mật khẩu có tối đa 32 ký tự',
            'password_confirmation.required'=>'Bạn chưa nhập lại mật khẩu',
            'password_confirmation.same'=>'Mật khẩu nhập lại chưa khớp',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'admin';
        $user->save();
        return redirect('auth/register')->with('thongbao','Register Successfully');
        
    }

    public function postLogin(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32'
        ],[
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập password',
            'password.min'=>'Password không được nhỏ hơn 3 ký tự',
            'password.max'=>'Password không được lớn hơn 32 ký tự'
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('auth/login')->with('thongbao','Đăng nhập thành công');
        }else{
            return redirect('auth/login')->with('thongbao','Đăng nhập thất bại');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('app');
    }
}
