<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function getDanhSach(){
    	$users = User::all();
    	return view('admin.users.danhsach',compact('users'));
    }
    public function getThem(){
    	return view('admin.users.them');
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'name'=>'required|min:3',
    			'email'=>'required|min:3',
    			'password'=>'required|min:3|max:10',
    			'passwordAgain'=>'required|same:password'
    		],
    		[
    			'name.required'=>'Bạn hãy nhập tên',
    			'email.required'=>'Bạn hãy nhập email',
    			'email.min'=>'Độ dài kí tự lớn hơn 3',
                 'password.required'=>'Bạn hãy nhập password',
    			'password.min'=>'Độ dài kí tự lớn hơn 3 nhỏ hơn 10',
    			'password.max'=>'Độ dài kí tự lớn 3 nhỏ hơn 10',
    			'passwordAgain.required'=>'Bạn hãy nhập password',
    			'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng'
    		]);
    	$users = new User();
    	$users->name = $request->name;
    	$users->email = $request->email;
    	$users->password = bcrypt($request->password);
    	$users->quyen = $request->quyen;
        $users->save();
        return redirect('admin/users/them')->with('thongbao','Bạn đã thêm thành công');

    }
    public function getSua($id){
        $users = User::find($id);
        return view('admin.users.sua',compact('users'));
    }
    public function postSua(Request $request,$id)
    {
    	$this->validate($request,
    		[
    			'name'=>'required|min:3',
    			'email'=>'required|min:3',
    			'password'=>'required|min:3|max:10',
    			'passwordAgain'=>'required|same:password'
    		],
    		[
    			'name.required'=>'Bạn hãy nhập tên',
    			'email.required'=>'Bạn hãy nhập email',
    			'email.min'=>'Độ dài kí tự lớn hơn 3',
                 'password.required'=>'Bạn hãy nhập password',
    			'password.min'=>'Độ dài kí tự lớn hơn 3 nhỏ hơn 10',
    			'password.max'=>'Độ dài kí tự lớn 3 nhỏ hơn 10',
    			'passwordAgain.required'=>'Bạn hãy nhập password',
    			'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng'
    		]);
    	$users = User::find($id);
    	$users->name = $request->name;
    	$users->email = $request->email;
    	$users->password = bcrypt($request->password);
    	$users->quyen = $request->quyen;
        $users->save();
        return redirect('admin/users/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');

    }
    public function getXoa($id){
    	$users = User::find($id);
    	$users->delete();
    	return redirect('admin/users/danhsach')->with('thongbao','Đã xóa thành công');
    }
    public function getDangNhapAdmin(){
        return view('admin.login');
    }
    public function postDangNhapAdmin(Request $request){
      $this->validate($request,
    [
        'email' =>'required',
        'password' =>'required|min:3|max:32'
    ],
    [
        'email.required' =>'Bạn chưa nhập Email',
        'password.required'=>'Bạn chưa nhập password',
        'password.min'=>'Độ dài kí tự lớn hơn 3 nhỏ hơn 32',
         'password.max'=>'Độ dài kí tự lớn hơn 3 nhỏ hơn 32'
    ]);
      // Đăng nhập
      if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
      {
           return redirect('admin/theloai/danhsach');
      }
      else {
        return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
      }

    }
    public function getDangXuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
