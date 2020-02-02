<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;

class TinTucController extends Controller
{
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->get();
    	return view('admin.tintuc.danhsach',compact('tintuc'));
    }
    public function getThem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',compact('theloai','loaitin'));
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'LoaiTin'=>'required',
    			'TieuDe'=>'required|unique:TinTuc,TieuDe|min:3|max:20',
    			'TomTat'=>'required',
    			'NoiDung'=>'required'
    		],
    		[
    			'LoaiTin.required'=>'Bạn chưa nhập loại tin',
    			'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    			'TieuDe.min'=>'Tiêu đề phải có ít nhất 3-20 kí tự',
    			'TieuDe.max'=>'Tiêu đề phải có ít nhất 3-20 kí tự',
    			'TieuDe.unique'=>'Tiêu đề đã tồn tại',
    			'TomTat.required'=>'Bạn chưa nhập tóm tắt',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung' 
    		]);
	    	$tintuc = new TinTuc();
	    	$tintuc->TieuDe = $request->TieuDe;
	    	$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
	    	$tintuc->idLoaiTin = $request->LoaiTin;
	    	$tintuc->TomTat = $request->TomTat;
	    	$tintuc->NoiDung = $request->NoiDung;
            
    	if($request->hasFile('Hinh')){
    		// lưu file hinh
    		$file = $request->file('Hinh');
    		//kiểm tra đuôi file
    		$duoiAnh = $file->getClientOriginalExtension();
    		$arrImg = ['jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG'];
    		$check = false;
    		for ($i=0; $i < count($arrImg); $i++) {
    			if($duoiAnh == $arrImg[$i]){
    				$check = true; break;
    			}
    		}
    		if(!$check){
    			return redirect('admin/tintuc/them')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
    		}
    		$name = time().$file->getClientOriginalName();
    		$file->move('upload/tintuc', $name);
    		$tintuc->Hinh = $name;

    	}
    	else{
    		$tintuc->Hinh = "";
    	}
         $tintuc->NoiBat = $request->NoiBat;
    	$tintuc->save();
    return redirect('admin/tintuc/them')->with('thongbao', 'Bạn đã thêm thành công');
    }
    public function getSua($id){
    	$tintuc  = TinTuc::find($id);
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.sua',compact('tintuc','theloai','loaitin'));
    }
    public function postSua(Request $request,$id){
        $tintuc = TinTuc::find($id);
      	$this->validate($request,
    		[
    			'LoaiTin'=>'required',
    			'TieuDe'=>'required|unique:TinTuc,TieuDe|min:3|max:20',
    			'TomTat'=>'required',
    			'NoiDung'=>'required'
    		],
    		[
    			'LoaiTin.required'=>'Bạn chưa nhập loại tin',
    			'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    			'TieuDe.min'=>'Tiêu đề phải có ít nhất 3-20 kí tự',
    			'TieuDe.max'=>'Tiêu đề phải có ít nhất 3-20 kí tự',
    			'TieuDe.unique'=>'Tiêu đề đã tồn tại',
    			'TomTat.required'=>'Bạn chưa nhập tóm tắt',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung' 
    		]);
	    	$tintuc->TieuDe = $request->TieuDe;
	    	$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
	    	$tintuc->idLoaiTin = $request->LoaiTin;
	    	$tintuc->TomTat = $request->TomTat;
	    	$tintuc->NoiDung = $request->NoiDung;

    	if($request->hasFile('Hinh')){
    		// lưu file hinh
    		$file = $request->file('Hinh');
    		//kiểm tra đuôi file
    		$duoiAnh = $file->getClientOriginalExtension();
    		$arrImg = ['jpg', 'JPG', 'png', 'PNG', 'jpeg', 'JPEG'];
    		$check = false;
    		for ($i=0; $i < count($arrImg); $i++) {
    			if($duoiAnh == $arrImg[$i]){
    				$check = true; break;
    			}
    		}
    		if(!$check){
    			return redirect('admin/tintuc/them')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
    		}
    		$name = time().$file->getClientOriginalName();
    		unlink("upload/tintuc/".$tintuc->Hinh);
    		$file->move('upload/tintuc', $name);
    		$tintuc->Hinh = $name;

    	}
    	else{
    		$tintuc->Hinh = "";
    	}
         $tintuc->NoiBat = $request->NoiBat;
    	$tintuc->save();
       return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Bạn đã thêm thành công');
    }
    public function getXoa($id){
    	$tintuc = TinTuc::find($id);
    	$tintuc->delete();
    	return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
