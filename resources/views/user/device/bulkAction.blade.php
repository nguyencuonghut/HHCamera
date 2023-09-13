@section('title')
{{ 'Bật - Tắt' }}
@endsection

@push('styles')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@extends('layouts.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bật/Tắt hết thiết bị</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('devices.index') }}">Tất cả thiết bị</a></li>
              <li class="breadcrumb-item active">Bật/Tắt hết thiết bị</li>
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
                    <form class="form-horizontal" method="post" action="{{ route('devices.postBulkAction') }}" name="bulk_action" id="bulk_action" novalidate="novalidate">
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
                                                <option value="ON">ON</option>
                                                <option value="OFF">OFF</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="control-group">
                                        <label class="control-label">Loại lỗi (chỉ chọn khi Tắt)</label>
                                        <div class="controls">
                                            <select name="type_id" id="type_id" class="form-control select2" style="width: 100%;" >
                                                <option selected="selected" disabled>Chọn loại lỗi</option>
                                                @foreach($error_types as $key => $value)
                                                    <option value="{{$key}}" >{{$value}}</option>
                                                @endforeach
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

@push('scripts')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
        theme: 'bootstrap4'
        })

    });
</script>
@endpush
