@section('title')
{{ 'Cập nhật lỗi' }}
@endsection

@push('styles')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endpush

@extends('layouts.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Cập nhật lỗi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('errors.index') }}">Tất cả lỗi</a></li>
              <li class="breadcrumb-item active">Cập nhật lỗi</li>
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
                    <form class="form-horizontal" method="post" action="{{ route('errors.update', $error->id) }}" name="edit_error" id="edit_error" novalidate="novalidate">
                        @method('PATCH')
                        {{ csrf_field() }}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Thiết bị</label>
                                        <div class="controls">
                                            <select name="device_id" id="device_id" class="form-control select2" style="width: 100%;" >
                                                <option selected="selected" disabled>Chọn thiết bị</option>
                                                @foreach($devices as $key => $value)
                                                    <option value="{{$key}}" {{ $key == $error->device_id ? 'selected' : '' }}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="control-group">
                                        <label class="required-field" class="control-label">Phân loại</label>
                                        <div class="controls">
                                            <select name="type_id" id="type_id" class="form-control select2" style="width: 100%;" >
                                                <option selected="selected" disabled>Chọn loại lỗi</option>
                                                @foreach($types as $key => $value)
                                                    <option value="{{$key}}" {{ $key == $error->type_id ? 'selected' : '' }}>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="required-field">Thời gian phát hiện lỗi</label>
                                    <div class="input-group date" id="detection_time" name="detection_time" data-target-input="nearest">
                                        <input @if (isset($error->detection_time)) value="{{Carbon\Carbon::parse($error->detection_time)->format('d/m/Y h:i:s')}}" @endif type="text" id="detection_time" name="detection_time" class="form-control datetimepicker-input" data-target="#detection_time"/>
                                        <div class="input-group-append" data-target="#detection_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Thời gian phát khắc phục xong</label>
                                    <div class="input-group date" id="recovery_time" name="recovery_time" data-target-input="nearest">
                                        <input @if (isset($error->recovery_time)) value="{{Carbon\Carbon::parse($error->recovery_time)->format('d/m/Y h:i:s')}}" @endif type="text" id="recovery_time" name="recovery_time" class="form-control datetimepicker-input" data-target="#recovery_time"/>
                                        <div class="input-group-append" data-target="#recovery_time" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="control-group">
                                        <label class="control-label">Nguyên nhân</label>
                                        <div class="controls">
                                            <textarea id="cause" name="cause">
                                                {!! $error->cause !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="control-group">
                                        <label class="control-label">Biện pháp</label>
                                        <div class="controls">
                                            <textarea id="solution" name="solution">
                                                {!! $error->solution !!}
                                            </textarea>
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
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2({
        theme: 'bootstrap4'
        })

        //Date picker with time picker
        $('#detection_time').datetimepicker({
            icons: { time: 'far fa-clock' },
            format: 'DD/MM/YYYY HH:mm:ss',
        });

        //Date picker with time picker
        $('#recovery_time').datetimepicker({
            icons: { time: 'far fa-clock' },
            format: 'DD/MM/YYYY HH:mm:ss'
        });
        // Summernote
        $('#cause').summernote({
            height: 80,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
            ]
        })
        $('#solution').summernote({
            height: 80,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
            ]
        })
    })

    //Remove <p> tag by <br> when enter new line
    $("#cause").on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
    });
    $("#solution").on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
    });
</script>
@endpush
