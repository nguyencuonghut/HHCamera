@section('title')
{{ 'Sửa thiết bị' }}
@endsection

@extends('layouts.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sửa thiết bị</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Tất cả thiết bị</a></li>
              <li class="breadcrumb-item active">Sửa thiết bị</li>
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
                    <form class="form-horizontal" method="post" action="{{ route('devices.update', $device->id) }}" name="edit_device" id="edit_device" novalidate="novalidate">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Tên</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $device->name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Vị trí</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="position" id="position" value="{{ $device->position }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="control-label">Địa chỉ IP</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" name="ip" id="ip" value="{{ $device->ip }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
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
                            <div class="row">
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Thể loại</label>
                                        <div class="controls">
                                            <select name="device_category_id" id="device_category_id" class="form-control select2">
                                                <option selected="selected" disabled>Chọn thể loại</option>
                                                @foreach($device_categories as $key => $value)
                                                    <option value="{{$key}}" {{ $key == $device->device_category_id ? 'selected' : '' }}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Trại</label>
                                        <div class="controls">
                                            <select name="farm_id" id="farm_id" class="form-control select2">
                                                <option value="{{$farm->id}}" selected>{{$farm->name}}</option>
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
