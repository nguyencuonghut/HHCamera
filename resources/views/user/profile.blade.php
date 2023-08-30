@section('title')
{{ 'Hồ sơ của tôi' }}
@endsection

@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

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
              <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Trang chủ</a></li>
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

                        <a href="{{route('user.change.password.get')}}" class="btn btn-warning btn-block"><b>Đổi mật khẩu</b></a>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Lịch sử lỗi thiết bị</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="errors-table" class="table">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Thời gian</th>
                                        <th>Tên thiết bị</th>
                                        <th>Nguyên nhân</th>
                                        <th>Biện pháp</th>
                                        <th>Thời gian phát hiện</th>
                                        <th>Thời gian sửa xong</th>
                                        <th>Phân loại</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        <!-- /.table-responsive -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection



@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>



<style type="text/css">
    .dataTables_wrapper .dt-buttons {
    margin-bottom: -3em
  }
</style>


<script>$(function () {
    $("#errors-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      /*
      buttons: [
          {
              extend: 'copy',
              footer: true,
              exportOptions: {
                  columns: [0,1,2,3,4,5,6,7]
              }
          },
          {
              extend: 'csv',
              footer: true,
              exportOptions: {
                  columns: [0,1,2,3,4,5,6,7]
              }

          },
          {
              extend: 'excel',
              footer: true,
              exportOptions: {
                  columns: [0,1,2,3,4,5,6,7]
              }
          },
          {
              extend: 'pdf',
              footer: true,
              exportOptions: {
                  columns: [0,1,2,3,4,5,6,7]
              }
          },
          {
              extend: 'print',
              footer: true,
              exportOptions: {
                  columns: [0,1,2,3,4,5,6,7]
              }
          },
          {
              extend: 'colvis',
              footer: true,
              exportOptions: {
                  columns: [0,1,2,3,4,5,6,7]
              }
          }
      ],
      dom: 'Blfrtip',
      */
      ajax: ' {!! route('errors.farmData', $farm_id) !!}',
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'updated_at', name: 'updated_at'},
          {data: 'device', name: 'device'},
          {data: 'cause', name: 'cause'},
          {data: 'solution', name: 'ip'},
          {data: 'detection_time', name: 'detection_time'},
          {data: 'recovery_time', name: 'recovery_time'},
          {data: 'type', name: 'type'},
     ]
    }).buttons().container().appendTo('#errors-table_wrapper .col-md-6:eq(0)');
  });
  </script>
@endpush

