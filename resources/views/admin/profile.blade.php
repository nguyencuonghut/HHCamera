@section('title')
{{ 'Hồ sơ của tôi' }}
@endsection

@extends('layouts.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Hồ sơ của tôi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Hồ sơ của tôi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">

                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

                        <p class="text-muted text-center">{{Auth::user()->email}}</p>

                        <a href="{{route('admin.change.password.get')}}" class="btn btn-warning btn-block"><b>Đổi mật khẩu</b></a>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

