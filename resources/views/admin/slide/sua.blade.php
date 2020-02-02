@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>{{$slide->Ten}}</small>
                        </h1>
                    </div>
                     @if(count($errors) > 0)
                     <div class="alert alert-danger">
                         @foreach($errors->all() as $err)
                         {{$err}}
                         @endforeach
                     </div>
                     @endif
                     @if(session('thongbao'))
                      <div class="alert alert-success">
                          {{session('thongbao')}}
                      </div>
                     @endif
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                             <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên:</label>
                                <input class="form-control" value="{{$slide->Ten}}" name="Ten" placeholder="Nhập tên slide.." />
                            </div>
                            <div class="form-group">
                                <label>Hinh</label>
                                <p><img width="100px" src="upload/slide/{{$slide->Hinh}}" alt=""></p>
                                <input class="form-control" type="file" name="Hinh"  />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung"  id="demo" class="form-control ckeditor" rows="3">{{$slide->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                 <input class="form-control" value="link" name="link" placeholder="Nhập link..." />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection()