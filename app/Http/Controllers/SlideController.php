<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',compact('slide'));
    }
    public function getThem(){
    	return view('admin.slide.them');
    }
    public function postThem(Request $request){
    	$slide = new Slide;
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:3|unique:Slide,Ten',
    			'Hinh'=>'required',
    			'NoiDung'=>'required|min:3',
    			'link'=>'required|min:3'
    		],
    		[
    			'Ten.required' =>'Tên chưa nhập',
    			'Ten.min' =>'Độ dài kí tự lớn hơn 3',
    			'Ten.unique' =>'Tên không được trùng',
    			'Hinh.required' =>'Hình chưa chọn',
    			'NoiDung.required' =>'Nội dung chưa nhập',
    			'NoiDung.min' =>'Độ dài kí tự lớn hơn 3',
    			'link.required' =>'Link chưa nhập',
    			'link.min' =>'Độ dài kí tự lớn hơn 3',
    		]);
    	$slide ->Ten = $request->Ten;
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
    			return redirect('admin/slide/them')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
    		}
    		$name = time().$file->getClientOriginalName();
    		$file->move('upload/slide', $name);
    		$slide->Hinh = $name;

    	}
    	else{
    		$slide->Hinh = "";
    	}
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link')){
    		$slide->link= $request->link;
    	}
    	
    	$slide->save();
    	return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
         $slide = Slide::find($id);
         return view('admin.slide.sua',compact('slide'));
    } 
    public function postSua(Request $request,$id)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|min:3|unique:Slide,Ten',
    			'Hinh'=>'required',
    			'NoiDung'=>'required|min:3',
    			'link'=>'required|min:3'
    		],
    		[
    			'Ten.required' =>'Tên chưa nhập',
    			'Ten.min' =>'Độ dài kí tự lớn hơn 3',
    			'Ten.unique' =>'Tên không được trùng',
    			'Hinh.required' =>'Hình chưa chọn',
    			'NoiDung.required' =>'Nội dung chưa nhập',
    			'NoiDung.min' =>'Độ dài kí tự lớn hơn 3',
    			'link.required' =>'Link chưa nhập',
    			'link.min' =>'Độ dài kí tự lớn hơn 3',
    		]);
    	$slide = Slide::find($id);
    	$slide ->Ten = $request->Ten;
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
    			return redirect('admin/slide/them')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg');
    		}
    		$name = time().$file->getClientOriginalName();
    		unlink("upload/slide/".$slide->Hinh);
    		$file->move('upload/slide', $name);
    		$slide->Hinh = $name;

    	}
    	else{
    		$slide->Hinh = "";
    	}
    	$slide->NoiDung = $request->NoiDung;
    	$slide->link = $request->link;
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Đã sửa thành công!');

    }
    public function getXoa($id){
      $slide = Slide::find($id);
      $slide->delete();
      return redirect('admin/slide/danhsach')->with('thongbao','Đã xóa thành công!');
    }
}
