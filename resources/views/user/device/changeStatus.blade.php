@section('title')
{{ 'Đổi trạng thái' }}
@endsection

@extends('layouts.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Đổi trạng thái</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Tất cả thiết bị</a></li>
              <li class="breadcrumb-item active">Đổi trạng thái</li>
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
                <div class="col-12">
                    <div class="card">
                    <form class="form-horizontal" method="post" action="{{ route('devices.postChangeStatus', $device->id) }}" name="change_status" id="change_status" novalidate="novalidate">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Trạng thái</label>
                                        <div class="controls">
                                            <select name="status" id="status" class="form-control select2">
                                                <option selected="selected" disabled>Chọn trạng thái</option>
                                                <option value="ON" {{ 'ON' == $device->status ? 'selected' : '' }} >ON</option>
                                                <option value="OFF" {{ 'OFF' == $device->status ? 'selected' : '' }} >OFF</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="control-group">
                                <div class="controls">
                                    <input type="submit" value="Cập nhật" class="btn btn-success">
                                </div>
                            </div>
                        <div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
