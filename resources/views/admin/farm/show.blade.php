@section('title')
{{ 'Chi tiết trại' }}
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
          <h1 class="m-0">Chi tiết {{$farm->name}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.farms.index') }}">Tất cả trại</a></li>
            <li class="breadcrumb-item active">{{$farm->name}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      @if($farm_cam_on_cnt || $farm_cam_off_cnt)
      <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <b style="color:##212529;">TỔNG HỢP CAMERA</b>
                        <span class="badge bg-success">ON</span> {{$farm_cam_on_cnt}}
                        &nbsp;
                        <span class="badge bg-danger">OFF</span> {{$farm_cam_off_cnt}}
                    </h5>
                </div>

                <div class="card-body">
                <canvas id="donutCamChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <b style="color:##212529;">TỔNG HỢP LỖI</b>
                    </h5>
                </div>

                <div class="card-body">
                <canvas id="donutErrorChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Danh sách thiết bị</h5>
                </div>
              <div class="card-body">
                <table id="devices-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên</th>
                      <th>Vị trí</th>
                      <th>Địa chỉ IP</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                    </thead>
                  </table>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Danh sách lỗi</h5>
                </div>
              <div class="card-body">
                <table id="errors-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
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
            </div>
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>


<style type="text/css">
    .dataTables_wrapper .dt-buttons {
    margin-bottom: -3em
  }
</style>



<script>
    $(function () {
      $("#devices-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        buttons: [
            {
                extend: 'copy',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'csv',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4]
                }

            },
            {
                extend: 'excel',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'pdf',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            },
            {
                extend: 'colvis',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4]
                }
            }
        ],
        dom: 'Blfrtip',
        ajax: ' {!! route('admin.devices.farmData', $farm->id) !!}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'position', name: 'position'},
            {data: 'ip', name: 'ip'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
       ]
      }).buttons().container().appendTo('#devices-table_wrapper .col-md-6:eq(0)');
    });

    $(function () {
      $("#errors-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        buttons: [
            {
                extend: 'copy',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'csv',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }

            },
            {
                extend: 'excel',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'pdf',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'colvis',
                footer: true,
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            }
        ],
        dom: 'Blfrtip',
        ajax: ' {!! route('admin.errors.farmData', $farm->id) !!}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'device', name: 'device'},
            {data: 'cause', name: 'cause'},
            {data: 'solution', name: 'ip'},
            {data: 'detection_time', name: 'detection_time'},
            {data: 'recovery_time', name: 'recovery_time'},
            {data: 'type', name: 'type'},
       ]
      }).buttons().container().appendTo('#devices-table_wrapper .col-md-6:eq(0)');
    });

    //-------------
    //- DONUT CAM CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutCamChartCanvas = $('#donutCamChart').get(0).getContext('2d')
    var farm_cam_on_cnt =  {{ Js::from($farm_cam_on_cnt) }};
    var farm_cam_off_cnt =  {{ Js::from($farm_cam_off_cnt) }};
    var donutData        = {
      labels: [
          'ON',
          'OFF',
      ],
      datasets: [
        {
          data: [farm_cam_on_cnt,farm_cam_off_cnt],
          backgroundColor : ['#00a65a', '#f56954'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutCamChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions,
      display: true
    })


    //-------------
    //- DONUT ERROR CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutErrorChartCanvas = $('#donutErrorChart').get(0).getContext('2d')
    var error_type_id_1_cnt =  {{ Js::from($error_type_id_1_cnt) }};
    var error_type_id_2_cnt =  {{ Js::from($error_type_id_2_cnt) }};
    var error_type_id_3_cnt =  {{ Js::from($error_type_id_3_cnt) }};
    var error_type_id_4_cnt =  {{ Js::from($error_type_id_4_cnt) }};
    var error_type_id_5_cnt =  {{ Js::from($error_type_id_5_cnt) }};
    var error_type_id_6_cnt =  {{ Js::from($error_type_id_6_cnt) }};
    var error_type_id_7_cnt =  {{ Js::from($error_type_id_7_cnt) }};

    var error_type_id_1_name = {{ Js::from($error_type_id_1_name) }};
    var error_type_id_2_name = {{ Js::from($error_type_id_2_name) }};
    var error_type_id_3_name = {{ Js::from($error_type_id_3_name) }};
    var error_type_id_4_name = {{ Js::from($error_type_id_4_name) }};
    var error_type_id_5_name = {{ Js::from($error_type_id_5_name) }};
    var error_type_id_6_name = {{ Js::from($error_type_id_6_name) }};
    var error_type_id_7_name = {{ Js::from($error_type_id_7_name) }};
    var donutData        = {
      labels: [
        error_type_id_1_name,
        error_type_id_2_name,
        error_type_id_3_name,
        error_type_id_4_name,
        error_type_id_5_name,
        error_type_id_6_name,
        error_type_id_7_name,
      ],
      datasets: [
        {
          data: [
            error_type_id_1_cnt,
            error_type_id_2_cnt,
            error_type_id_3_cnt,
            error_type_id_4_cnt,
            error_type_id_5_cnt,
            error_type_id_6_cnt,
            error_type_id_7_cnt,
        ],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#02fc4d'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutErrorChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions,
    })

  </script>
@endpush
