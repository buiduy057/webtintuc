@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Users
                            <small>{{$users->name}}</small>
                        </h1>
                    </div>
                     @if(count($errors) > 0)
                     <div class="alert alert-danger">
                         @foreach($errors ->all() as $err)
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
                        <form action="admin/users/sua/{{$users->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" value="{{$users->name}}" name="name" placeholder="Nhập tên users..." />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" value="{{$users->email}}" name="email" placeholder="Nhập email.." />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" value="{{$users->password}}" type="password" name="password" placeholder="Nhập password.." />
                            </div>
                             <div class="form-group">
                                <label>Password Again</label>
                                <input class="form-control" value="{{$users->passwordAgain}}" type="password"  name="passwordAgain" placeholder="Nhập lại password.." />
                            </div>
                              <div class="form-group">
                                <label>Quyền người dùng</label>
                                <label class="radio-inline">
                                    <input 
                                       @if($users->quyen == 1 )
                                      {{"checked"}}
                                      @endif
                                    name="quyen" value="1" checked="" type="radio"> Admin
                                </label>
                                <label class="radio-inline">
                                    <input 
                                      @if($users->quyen == 0 )
                                      {{"checked"}}
                                      @endif
                                    name="quyen" value="0" type="radio"> Thường
                                </label>
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
