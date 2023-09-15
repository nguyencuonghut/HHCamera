@section('title')
{{ 'Trang chủ' }}
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$farms_cnt}}</h3>

                <p>Tổng số trại</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-copy"></i>
              </div>
              <a href="{{route('admin.farms.index')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$devices_cnt}}</h3>

                <p>Tổng số thiết bị</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
              </div>
              <a href="{{route('admin.devices.index')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$cams_cnt}}</h3>

                <p>Tổng số cam</p>
              </div>
              <div class="icon">
                <i class="ion ion-load-a"></i>
              </div>
              <a href="{{route('admin.devices.index')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$errors_cnt}}</h3>

                <p>Tổng số lỗi</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('admin.errors.index')}}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            CAMERA
                            <span class="badge bg-success">ON</span> {{$cam_on_cnt}}
                            &nbsp;
                            <span class="badge bg-danger">OFF</span> {{$cam_off_cnt}}
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                    <canvas id="donutCamChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            TỔNG HỢP LỖI
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                    <canvas id="donutErrorChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- AREA CHART -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">LỖI GẦN ĐÂY</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            DANH SÁCH TRẠI
                        </h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="farms-table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên trại</th>
                        <th>Người phụ trách</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                </div>
            </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection


@push('scripts')
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

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


<script>
    $(function () {
      $("#farms-table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        buttons: [
            {
                extend: 'copy',
                footer: true,
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'csv',
                footer: true,
                exportOptions: {
                    columns: [0,1,2]
                }

            },
            {
                extend: 'excel',
                footer: true,
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'pdf',
                footer: true,
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'colvis',
                footer: true,
                exportOptions: {
                    columns: [0,1,2]
                }
            }
        ],
        dom: 'Blfrtip',
        ajax: ' {!! route('admin.farmData') !!}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'user', name: 'user'},
       ]
      }).buttons().container().appendTo('#farms-table_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    //-------------
    //- DONUT CAM CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutCamChartCanvas = $('#donutCamChart').get(0).getContext('2d')
    var cam_on_cnt =  {{ Js::from($cam_on_cnt) }};
    var cam_off_cnt =  {{ Js::from($cam_off_cnt) }};
    var donutData        = {
      labels: [
          'ON',
          'OFF',
      ],
      datasets: [
        {
          data: [cam_on_cnt,cam_off_cnt],
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
    var error_type_id_8_cnt =  {{ Js::from($error_type_id_8_cnt) }};
    var error_type_id_9_cnt =  {{ Js::from($error_type_id_9_cnt) }};
    var error_type_id_10_cnt =  {{ Js::from($error_type_id_10_cnt) }};
    var error_type_id_11_cnt =  {{ Js::from($error_type_id_11_cnt) }};
    var error_type_id_12_cnt =  {{ Js::from($error_type_id_12_cnt) }};
    var error_type_id_13_cnt =  {{ Js::from($error_type_id_13_cnt) }};

    var error_type_id_1_name = {{ Js::from($error_type_id_1_name) }};
    var error_type_id_2_name = {{ Js::from($error_type_id_2_name) }};
    var error_type_id_3_name = {{ Js::from($error_type_id_3_name) }};
    var error_type_id_4_name = {{ Js::from($error_type_id_4_name) }};
    var error_type_id_5_name = {{ Js::from($error_type_id_5_name) }};
    var error_type_id_6_name = {{ Js::from($error_type_id_6_name) }};
    var error_type_id_7_name = {{ Js::from($error_type_id_7_name) }};
    var error_type_id_8_name = {{ Js::from($error_type_id_8_name) }};
    var error_type_id_9_name = {{ Js::from($error_type_id_9_name) }};
    var error_type_id_10_name = {{ Js::from($error_type_id_10_name) }};
    var error_type_id_11_name = {{ Js::from($error_type_id_11_name) }};
    var error_type_id_12_name = {{ Js::from($error_type_id_12_name) }};
    var error_type_id_13_name = {{ Js::from($error_type_id_13_name) }};
    var donutData        = {
      labels: [
        error_type_id_1_name,
        error_type_id_2_name,
        error_type_id_3_name,
        error_type_id_4_name,
        error_type_id_5_name,
        error_type_id_6_name,
        error_type_id_7_name,
        error_type_id_8_name,
        error_type_id_9_name,
        error_type_id_10_name,
        error_type_id_11_name,
        error_type_id_12_name,
        error_type_id_13_name,
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
            error_type_id_8_cnt,
            error_type_id_9_cnt,
            error_type_id_10_cnt,
            error_type_id_11_cnt,
            error_type_id_12_cnt,
            error_type_id_13_cnt,
        ],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#403A3A', '#02fc4d', '#75151E', '#924E7D', '#B1DBBB', '#B1782B', '#74BA8F', '#E4F33F'],
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

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var datasheet =  {{ Js::from($datasheet) }};
    let labels = [];
    let data = [];
    for(const key in datasheet) {
        labels.push(key);
        data.push(datasheet[key].error);
    }
    //console.log(datasheet['11/07/2023']);
    //console.log(data);
    var areaChartData = {
      //labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      labels: labels,
      datasets: [
        {
          label               : 'Lỗi thiết bị',
          backgroundColor     : 'rgb(245, 105,84)',
          borderColor         : 'rgba(245,105,84,0.8)',
          pointRadius          : false,
          pointColor          : 'rgb(245,105,84)',
          pointStrokeColor    : 'rgba(245,105,84,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(245,105,84,1)',
          data                : data
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

  </script>
@endpush

