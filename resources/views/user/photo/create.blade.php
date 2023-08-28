@section('title')
{{ 'Upload ảnh' }}
@endsection

@push('styles')
<style>
.list-images {
        width: 50%;
        margin-top: 20px;
        display: inline-block;
    }
    .hidden { display: none; }
    .box-image {
        width: 100px;
        height: 108px;
        position: relative;
        float: left;
        margin-left: 5px;
    }
    .box-image img {
        width: 100px;
        height: 100px;
    }
    .wrap-btn-delete {
        position: absolute;
        top: -8px;
        right: 0;
        height: 2px;
        font-size: 20px;
        font-weight: bold;
        color: red;
    }
    .btn-delete-image {
        cursor: pointer;
    }
</style>
@endpush
@extends('layouts.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Upload ảnh</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('photos.index') }}">Tất cả ảnh</a></li>
              <li class="breadcrumb-item active">Tạo mới</li>
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
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('/photos') }}" name="add_photo" id="add_photo" novalidate="novalidate">{{ csrf_field() }}
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="control-group">
                                        <div class="controls list-input-hidden-upload">
                                            <input type="file" class="form-control hidden" name="filenames[]" id="file_upload" required="">
                                        </div>
                                    </div>

                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-add-image" type="button"><i class="fas fa-images"></i> Thêm ảnh</button>
                                    </div>

                                    <div class="list-images">
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="submit" value="Tải lên" class="btn btn-success" style="width:100%;">
                                        </div>
                                    </div>
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
<script type="text/javascript">
$(document).ready(function() {
    $(".btn-add-image").click(function(){
        $('#file_upload').trigger('click');
    });

    $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let file_name = event.target.files[0].name;
        let box_image = $('<div class="box-image"></div>');
        box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
        box_image.append('<div class="wrap-btn-delete"><span data-id='+time+' class="btn-delete-image">x</span></div>');
        $(".list-images").append(box_image);

        $(this).removeAttr('id');
        $(this).attr( 'id', time);
        let input_type_file = '<input type="file" name="filenames[]" id="file_upload" class="form-control hidden">';
        $('.list-input-hidden-upload').append(input_type_file);
    });

    $(".list-images").on('click', '.btn-delete-image', function(){
        let id = $(this).data('id');
        $('#'+id).remove();
        $(this).parents('.box-image').remove();
    });
});
</script>
@endpush
