<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceCategory;
use App\Models\Farm;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.device.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farm_id  = Auth::user()->farm_id;
        $farm = Farm::findOrFail($farm_id);
        $device_categories = DeviceCategory::all()->pluck('name', 'id');
        return view('user.device.create', ['farm' => $farm, 'device_categories' => $device_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'ip' => 'required|ipv4',
            'status' => 'required',
            'farm_id' => 'required',
            'device_category_id' => 'required',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'position.required' => 'Bạn phải nhập vị trí.',
            'position.max' => 'Vị trí dài quá 255 ký tự.',
            'ip.required' => 'Bạn phải nhập IP.',
            'ip.ipv4' => 'Địa chỉ IP không hợp lệ.',
            'status.required' => 'Bạn phải nhập tên.',
            'farm_id.required' => 'Bạn phải nhập tên trại',
            'device_category_id.required' => 'Bạn phải nhập thể loại',
        ];
        $request->validate($rules,$messages);

        $device = new Device();
        $device->name = $request->name;
        $device->position = $request->position;
        $device->ip = $request->ip;
        $device->status = $request->status;
        $device->farm_id = $request->farm_id;
        $device->device_category_id = $request->device_category_id;
        $device->save();

        Alert::toast('Tạo thiết bị mới thành công!', 'success', 'top-right');
        return redirect()->route('devices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farm_id  = Auth::user()->farm_id;
        $farm = Farm::findOrFail($farm_id);
        $device_categories = DeviceCategory::all()->pluck('name', 'id');
        $device = Device::findOrFail($id);
        return view('user.device.edit',
                    ['device' => $device,
                    'farm' => $farm,
                    'device_categories' => $device_categories
                ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'ip' => 'required|ipv4',
            'status' => 'required',
            'farm_id' => 'required',
            'device_category_id' => 'required',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'position.required' => 'Bạn phải nhập vị trí.',
            'position.max' => 'Vị trí dài quá 255 ký tự.',
            'ip.required' => 'Bạn phải nhập IP.',
            'ip.ipv4' => 'Địa chỉ IP không hợp lệ.',
            'status.required' => 'Bạn phải nhập tên.',
            'farm_id.required' => 'Bạn phải nhập tên trại',
            'device_category_id.required' => 'Bạn phải nhập thể loại',
        ];
        $request->validate($rules,$messages);

        $device = Device::findOrFail($id);
        $device->name = $request->name;
        $device->position = $request->position;
        $device->ip = $request->ip;
        $device->status = $request->status;
        $device->farm_id = $request->farm_id;
        $device->device_category_id = $request->device_category_id;
        $device->save();

        Alert::toast('Sửa thiết bị thành công!', 'success', 'top-right');
        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->destroy($id);
        Alert::toast('Xóa thiết bị thành công!', 'success', 'top-right');
        return redirect()->route('devices.index');
    }

    public function anyData()
    {
        $farm_id = Auth::user()->farm_id;
        $devices = Device::where('farm_id',  $farm_id)->with('farm')->with('device_category')->select(['id', 'name', 'position', 'ip', 'status', 'farm_id', 'device_category_id'])->get();
        return Datatables::of($devices)
            ->addIndexColumn()
            ->editColumn('name', function ($devices) {
                return '<a href="'.route('devices.edit', $devices->id).'">'.$devices->name.'</a>';

            })
            ->editColumn('position', function ($devices) {
                return $devices->position;
            })
            ->editColumn('ip', function ($devices) {
                return $devices->ip;
            })
            ->editColumn('status', function ($devices) {
                if($devices->status == 'ON') {
                    return '<span class="badge badge-success">ON</span>';
                } else {
                    return '<span class="badge badge-danger">OFF</span>';
                }
            })
            ->addColumn('action', function ($devices) {
                $action = '';
                $action = $action . ' <a href="' . route("devices.getChangeStatus", $devices->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-random"></i></a>';
                $action = $action . ' <a href="' . route("devices.edit", $devices->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';
                $action = $action . '<form style="display:inline" action="'. route("devices.destroy", $devices->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['name', 'status', 'device_category', 'action'])
            ->make(true);
    }

    public function getChangeStatus($id)
    {
        $device = Device::findOrFail($id);
        return view('user.device.changeStatus', ['device' => $device]);
    }


    public function postChangeStatus(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        if($device->status != $request->status) {
            // Update status
            $device->status = $request->status;
            $device->save();

            Alert::toast('Đổi trạng thái thành công!', 'success', 'top-right');
            return redirect()->route('devices.index');
        } else {
            // Warning
            Alert::toast('Trạng thái thiết bị vẫn như cũ!', 'warning', 'top-right');
            return redirect()->route('devices.index');
        }
    }
}
