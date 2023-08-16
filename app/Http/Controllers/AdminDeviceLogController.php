<?php

namespace App\Http\Controllers;

use App\Models\DeviceLog;
use Datatables;

class AdminDeviceLogController extends Controller
{
    public function deviceData($device_id)
    {
        $device_logs = DeviceLog::where('device_id', $device_id)->with(['device', 'new_category', 'old_category'])->orderBy('id', 'desc')->select(['id', 'device_id', 'action', 'old_status', 'new_status', 'old_category_id', 'new_category_id', 'created_at'])->get();
        return Datatables::of($device_logs)
            ->addIndexColumn()
            ->editColumn('device', function ($device_logs) {
                return $device_logs->device->name;
            })
            ->editColumn('action', function ($device_logs) {
                switch ($device_logs->action) {
                    case 'CREATE':
                        return '<span class="badge badge-success">thêm</span>';
                        break;
                    case 'EDIT':
                        return '<span class="badge badge-warning">sửa</span>';
                        break;
                    case 'DESTROY':
                        return '<span class="badge badge-danger">xóa</span>';
                        break;
                    case 'CHANGE_STATUS':
                        return '<span class="badge badge-primary">chuyển trạng thái</span>';
                        break;
                }
            })
            ->editColumn('old_status', function ($device_logs) {
                if($device_logs->old_status == 'ON') {
                    return '<span class="badge badge-success">ON</span>';
                } else if($device_logs->old_status == 'OFF') {
                    return '<span class="badge badge-danger">OFF</span>';
                } else {
                    return '-';
                }
            })
            ->editColumn('new_status', function ($device_logs) {
                if($device_logs->new_status == 'ON') {
                    return '<span class="badge badge-success">ON</span>';
                } else if($device_logs->new_status == 'OFF') {
                    return '<span class="badge badge-danger">OFF</span>';
                } else {
                    return '-';
                }
            })
            ->editColumn('created_at', function($device_logs) {
                return $device_logs->created_at;
            })
            ->rawColumns(['action', 'old_status', 'new_status'])
            ->make(true);
    }
}
