<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',compact('loaitin'));
    }
    public function getThem(){
       $theloai = TheLoai::all();
       return view('admin.loaitin.them',compact('theloai'));
    }
    public function postThem(Request $request){
    	$this->validate($request,
    	[
    		'Ten'=>'required|min:3|max:100|unique:LoaiTin,Ten',
    		'TheLoai'=>'required'
    	],
    	[
    		'Ten.required'=>'Bạn chưa nhập thông tin loại tin',
    	   'TheLoai.required'=>'Bạn chưa chọn thể loại',
    	   'Ten.unique'=>'Tên Loại tin đã tồn tại',
    	   'Ten.min'=>'Tên thể loại có độ dài từ 3 đến 100 kí tự',
            'Ten.max'=>'Tên thể loại có độ dài từ 3 đến 100 kí tự', 
    	]);
    	$loaitin = new LoaiTin();
        $loaitin ->Ten = $request->Ten;
        $loaitin ->TenKhongDau = changeTitle($request->Ten);
        $loaitin ->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getSua($id){
    	 $loaitin = LoaiTin::find($id);
    	 $theloai = TheLoai::all();
    	//$theloai = TheLoai::find($id);
        return view('admin.loaitin.sua',compact('loaitin','theloai'));
    }
    public function postSua(Request $request,$id){
         $this->validate($request,
    	[
    		'Ten'=>'required|min:3|max:100|unique:LoaiTin,Ten',
    		'TheLoai'=>'required'
    	],
    	[
    	   'Ten.required'=>'Bạn chưa nhập thông tin loại tin',
    	   'TheLoai.required'=>'Bạn chưa chọn thể loại',
    	   'Ten.unique'=>'Tên Loại tin đã tồn tại',
    	   'Ten.min'=>'Tên thể loại có độ dài từ 3 đến 100 kí tự',
            'Ten.max'=>'Tên thể loại có độ dài từ 3 đến 100 kí tự', 
    	]);
         $loaitin = LoaiTin::find($id);
         $loaitin ->Ten = $request->Ten;
         $loaitin->TenKhongDau=changeTitle($request->Ten);
         $loaitin->idTheLoai = $request->TheLoai;
         $loaitin->save();
         return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
    	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao','xóa thành công');
    }
}
