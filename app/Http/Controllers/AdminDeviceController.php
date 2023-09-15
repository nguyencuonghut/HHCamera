<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceCategory;
use App\Models\Farm;
use Datatables;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.device.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farms = Farm::all()->pluck('name', 'id');
        $device_categories = DeviceCategory::all()->pluck('name', 'id');
        return view('admin.device.create', ['farms' => $farms, 'device_categories' => $device_categories]);
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
            'status' => 'required',
            'farm_id' => 'required',
            'device_category_id' => 'required',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'position.required' => 'Bạn phải nhập vị trí.',
            'position.max' => 'Vị trí dài quá 255 ký tự.',
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
        return redirect()->route('admin.devices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::findOrFail($id);
        return view('admin.device.show', ['device' => $device]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farms = Farm::all()->pluck('name', 'id');
        $device_categories = DeviceCategory::all()->pluck('name', 'id');
        $device = Device::findOrFail($id);
        return view('admin.device.edit',
                    ['device' => $device,
                    'farms' => $farms,
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
            'status' => 'required',
            'farm_id' => 'required',
            'device_category_id' => 'required',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'position.required' => 'Bạn phải nhập vị trí.',
            'position.max' => 'Vị trí dài quá 255 ký tự.',
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
        return redirect()->route('admin.devices.index');
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
        return redirect()->route('admin.devices.index');
    }


    public function anyData()
    {
        $devices = Device::with('farm')->with('device_category')->orderBy('id', 'desc')->select(['id', 'name', 'position', 'ip', 'status', 'farm_id', 'device_category_id'])->get();
        return Datatables::of($devices)
            ->addIndexColumn()
            ->editColumn('name', function ($devices) {
                $name = '';
                if($devices->errors->count()) {
                    $name = $name . '<span class="badge badge-danger"> '
                        .$devices->errors->count()
                        . '</span>'
                        . ' '
                        . '<a href="'.route('admin.devices.show', $devices->id).'">'.$devices->name.'</a>';
                } else {
                    $name = $name . '<a href="'.route('admin.devices.show', $devices->id).'">'.$devices->name.'</a>';
                }
                return $name;

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
            ->editColumn('farm', function ($devices) {
                return '<a href="'.route('admin.farms.show', $devices->farm->id).'">'.$devices->farm->name.'</a>';

            })
            ->addColumn('action', function ($devices) {
                $action = '';
                $action = $action . ' <a href="' . route("admin.devices.edit", $devices->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';

                $action = $action . '<form style="display:inline" action="'. route("admin.devices.destroy", $devices->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['name', 'status', 'device_category', 'farm', 'action'])
            ->make(true);
    }

    public function farmData($farm_id)
    {
        $devices = Device::where('farm_id', $farm_id)->with('farm')->with('device_category')->orderBy('id', 'desc')->select(['id', 'name', 'position', 'ip', 'status', 'farm_id', 'device_category_id'])->get();
        return Datatables::of($devices)
            ->addIndexColumn()
            ->editColumn('name', function ($devices) {
                $name = '';
                if($devices->errors->count()) {
                    $name = $name . '<span class="badge badge-danger"> '
                        .$devices->errors->count()
                        . '</span>'
                        . ' '
                        . '<a href="'.route('admin.devices.show', $devices->id).'">'.$devices->name.'</a>';
                } else {
                    $name = $name . '<a href="'.route('admin.devices.show', $devices->id).'">'.$devices->name.'</a>';
                }
                return $name;
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
            ->editColumn('farm', function ($devices) {
                return '<a href="'.route('admin.farms.edit', $devices->farm->id).'">'.$devices->farm->name.'</a>';

            })
            ->addColumn('action', function ($devices) {
                $action = '';
                $action = $action . ' <a href="' . route("admin.devices.edit", $devices->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';

                $action = $action . '<form style="display:inline" action="'. route("admin.devices.destroy", $devices->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['name', 'status', 'device_category', 'farm', 'action'])
            ->make(true);
    }
}
