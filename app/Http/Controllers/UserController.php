<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function userposts($id)
    {
        $posts = Posts::where('author_id', $id)->where('active', '1')->orderBy('created_at', 'desc')->paginate(5);
        $title = User::find($id)->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }

    public function profile(Request $request, $id)
  {
        $data['user'] = User::find($id);
        if (!$data['user'])
        return redirect('/');

        if ($request->user() && $data['user']->id == $request->user()->id) {
        $data['author'] = true;
        } else {
        $data['author'] = null;
        }
        $data['comments_count'] = $data['user']->comments->count();
        $data['posts_count'] = $data['user']->posts->count();
        $data['posts_active_count'] = $data['user']->posts->where('active', 1)->count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        $data['latest_posts'] = $data['user']->posts->where('active', 1)->take(5);
        $data['latest_comments'] = $data['user']->comments->take(5);
        return view('auths.profile', $data);
  }

  public function userpostsall(Request $request)
  {
    //
    $user = $request->user();
    $posts = Posts::where('author_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }

  public function userpostsdraft(Request $request)
  {
    //
    $user = $request->user();
    $posts = Posts::where('author_id', $user->id)->where('active', '0')->orderBy('created_at', 'desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }

  public function getLogin()
  {
    return view('auths.login');
  }

  public function getRegister()
  {
      return view('auths.register');
  }

  public function postRegister(Request $request)
  {
      $this->validate($request,
      [
          'name'=>'required|min:3',
          'email'=>'required|email|unique:users,email',
          'password'=>'required|min:3|max:32',
          'password_confirmation'=>'required|same:password',
      ],
      [
          'name.required'=>'B???n ch??a nh???p t??n ng?????i d??ng',
          'name.min'=>'T??n ng?????i d??ng ph???i c?? ??t nh???t 3 k?? t???',
          'email.required'=>'B???n ch??a nh???p email',
          'email.email'=>'B???n ch??a nh???p ????ng ?????nh d???ng email',
          'email.unique'=>'Email ???? t???n t???i',
          'password.required'=>'B???n ch??a nh???p m???t kh???u',
          'password.min'=>'M???t kh???u ph???i c?? ??t nh???t 3 k?? t???',
          'password.max'=>'M???t kh???u c?? t???i ??a 32 k?? t???',
          'password_confirmation.required'=>'B???n ch??a nh???p l???i m???t kh???u',
          'password_confirmation.same'=>'M???t kh???u nh???p l???i ch??a kh???p',
      ]);
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
      return redirect('register')->with('thongbao','Register Successfully');
      
  }

  public function postLogin(Request $request)
  {
      $this->validate($request,[
          'email'=>'required',
          'password'=>'required|min:3|max:32'
      ],[
          'email.required'=>'B???n ch??a nh???p email',
          'password.required'=>'B???n ch??a nh???p password',
          'password.min'=>'Password kh??ng ???????c nh??? h??n 3 k?? t???',
          'password.max'=>'Password kh??ng ???????c l???n h??n 32 k?? t???'
      ]);
      if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
      {
          return redirect('app')->with('thongbao','????ng nh???p th??nh c??ng');
      }else{
          return redirect('auth/login')->with('thongbao','????ng nh???p th???t b???i');
      }
  }

  public function getLogout()
  {
      Auth::logout();
      return redirect('app');
  }
}
