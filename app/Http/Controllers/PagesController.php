<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\Slide;
use App\TinTuc;

class PagesController extends Controller
{
	function __construct(){
		$theloai = TheLoai::all();
		$slide = Slide::all();	
    $loaitin = LoaiTin::all();
    //Truyền dữ liệu
		view()->share('theloai',$theloai);
		view()->share('slide',$slide);
    // if(Auth::check()){
    //   view()->share('nguoidung',Auth::user());
    // }

	}
    function trangchu(){
       return view('pages.trangchu');
    }
    function lienhe()
    {
       return view('pages.lienhe');
    }
    function loaitin($id)
    {
       $loaitin = LoaiTin::find($id);
       // lấy id loại tin ra  tin tức  paginate(5) ra 5 bản tin
       $tintuc= TinTuc::where('idLoaiTin',$id)->paginate(5);
       return view('pages.loaitin',compact('loaitin','tintuc'));
    }
    function tintuc($id)
    {
      $tintuc = TinTuc::find($id);
      $tinnoibat= TinTuc::where('NoiBat',1)->take(4)->get();
      // kiểm tra $tintuc->idLoaiTin = idLoaitin
      $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
      return view('pages.tintuc',compact('tintuc','tinnoibat','tinlienquan'));
    }
    function getdangnhap(){
      return view('pages.dangnhap');
    }
    function postdangnhap(Request $request){
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
           return redirect('trangchu');
      }
      else {
        return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
      }
    }
    function getdangxuat()
    {
      Auth::logout();
      return redirect('trangchu');
    }
    function getnguoidung(){
      $user = Auth::user();
     return view('pages.nguoidung',compact('user'));
    }
    function postnguoidung(){

    }

    
}
