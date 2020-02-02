<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/dangnhap','UsersController@getDangNhapAdmin');
Route::post('admin/dangnhap','UsersController@postDangNhapAdmin');
Route::get('admin/logout','UsersController@getDangXuatAdmin');
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
   Route::group(['prefix'=>'theloai'],function(){
      Route::get('danhsach','TheLoaiController@getDanhSach');
      Route::get('sua/{id}','TheLoaiController@getSua');
      Route::post('sua/{id}','TheLoaiController@postSua')->name('post-sua');
      Route::get('them','TheLoaiController@getThem');
      Route::post('them','TheLoaiController@postThem');
      Route::get('xoa/{id}','TheLoaiController@getXoa');
   });
    Route::group(['prefix'=>'loaitin'],function(){
      Route::get('danhsach','LoaiTinController@getDanhSach');
      // Sửa loại tin
      Route::get('sua/{id}','LoaiTinController@getSua');
      Route::post('sua/{id}','LoaiTinController@postSua');

      // thêm loại tin
      Route::get('them','LoaiTinController@getThem');
      Route::post('them','LoaiTinController@postThem');
      // Xóa loại Tin
      Route::get('xoa/{id}','LoaiTinController@getXoa');
   });
    Route::group(['prefix'=>'tintuc'],function(){
      Route::get('danhsach','TinTucController@getDanhSach');
      Route::get('sua/{id}','TinTucController@getSua');
      Route::post('sua/{id}','TinTucController@postSua');
      // Thêm tin tức
      Route::get('them','TinTucController@getThem');
      Route::post('them','TinTucController@postThem');
       // Xóa Tin tức
      Route::get('xoa/{id}','TinTucController@getXoa');

   });
     Route::group(['prefix'=>'comment'],function(){
       // Xóa bình luận
      Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');

   });
    Route::group(['prefix'=>'ajax'],function(){
      Route::get('loaitin/{idTheLoai}','AjaxController@getloaitin');
    });
     Route::group(['prefix'=>'slide'],function(){
      Route::get('danhsach','SlideController@getDanhSach');
      // Sửa slide
      Route::get('sua/{id}','SlideController@getSua');
      Route::post('sua/{id}','SlideController@postSua');
      // Thêm slide
      Route::get('them','SlideController@getThem');
      Route::post('them','SlideController@postThem');
       // Xóa slide
      Route::get('xoa/{id}','SlideController@getXoa');
   });
     Route::group(['prefix'=>'users'],function(){
      Route::get('danhsach','UsersController@getDanhSach');
      // Sửa slide
      Route::get('sua/{id}','UsersController@getSua');
      Route::post('sua/{id}','UsersController@postSua');
      // Thêm slide
      Route::get('them','UsersController@getThem');
      Route::post('them','UsersController@postThem');
       // Xóa slide
      Route::get('xoa/{id}','UsersController@getXoa');
   });
});
// Route::get('trangchu',function(){
//   return view('pages.trangchu');  
// });
Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{TieuDeuKhongDau}.html','PagesController@tintuc');
Route::get('dangnhap','PagesController@getdangnhap');
Route::post('dangnhap','PagesController@postdangnhap');
Route::get('dangxuat','PagesController@getdangxuat');
Route::post('comment/{id}','CommentController@postcomment');
Route::get('nguoidung','PagesController@getnguoidung');
Route::post('nguoidung','PagesController@postnguoidung');

