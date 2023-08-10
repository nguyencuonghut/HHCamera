<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Error;
use Datatables;
use Illuminate\Http\Request;

class AdminErrorController extends Controller
{

    public function farmData($farm_id)
    {
        $farm_device_ids = Device::where('farm_id', $farm_id)->pluck('id')->toArray();
        $errors = Error::whereIn('device_id', $farm_device_ids)->with('device')->with('type')->select(['id', 'device_id', 'type_id', 'cause', 'solution', 'detection_time', 'recovery_time'])->get();

        return Datatables::of($errors)
            ->addIndexColumn()
            ->editColumn('device', function ($errors) {
                return '<a href="'.route('admin.devices.show', $errors->device->id).'">'.$errors->device->name.'</a>';
            })
            ->editColumn('type', function ($errors) {
                return $errors->type->name;
            })
            ->editColumn('cause', function ($errors) {
                return $errors->cause;
            })
            ->editColumn('solution', function ($errors) {
                return $errors->solution;
            })
            ->editColumn('detection_time', function ($errors) {
                return $errors->detection_time;
            })
            ->editColumn('recovery_time', function ($errors) {
                return $errors->recovery_time;
            })
            ->rawColumns(['device'])
            ->make(true);
    }
}
