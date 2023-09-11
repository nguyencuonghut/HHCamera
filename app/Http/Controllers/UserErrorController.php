<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Error;
use App\Models\ErrorType;
use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.error.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farm_id = Auth::user()->farm_id;
        $devices = Device::where('farm_id', $farm_id)->get()->pluck('name', 'id');
        $types = ErrorType::all()->pluck('name', 'id');
        return view('user.error.create', ['devices' => $devices, 'types' => $types]);
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
            'device_id' => 'required',
            'type_id' => 'required',
            'detection_time' => 'required',
        ];
        $messages = [
            'device_id.required' => 'Bạn phải nhập tên thiết bị.',
            'type_id.required' => 'Bạn phải nhập loại lỗi',
            'detection_time.required' => 'Bạn phải nhập thời gian phát hiện ra lỗi.',
        ];
        $request->validate($rules,$messages);

        $error = new Error();
        $error->device_id = $request->device_id;
        $error->type_id = $request->type_id;
        $error->detection_time = Carbon::createFromFormat('d/m/Y H:i:s', $request->detection_time);
        if($request->recovery_time) {
            $error->recovery_time = Carbon::createFromFormat('d/m/Y H:i:s', $request->recovery_time);
        }
        $error->cause = $request->cause;
        $error->solution = $request->solution;
        $error->save();

        Alert::toast('Tạo lỗi mới thành công!', 'success', 'top-right');
        return redirect()->route('errors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Error  $error
     * @return \Illuminate\Http\Response
     */
    public function show(Error $error)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Error  $error
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farm_id = Auth::user()->farm_id;
        $devices = Device::where('farm_id', $farm_id)->get()->pluck('name', 'id');
        $types = ErrorType::all()->pluck('name', 'id');
        $error = Error::findOrFail($id);
        return view('user.error.edit',
                    ['devices' => $devices,
                    'types' => $types,
                    'error' => $error
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Error  $error
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'device_id' => 'required',
            'type_id' => 'required',
            'detection_time' => 'required',
        ];
        $messages = [
            'device_id.required' => 'Bạn phải nhập tên thiết bị.',
            'type_id.required' => 'Bạn phải nhập loại lỗi',
            'detection_time.required' => 'Bạn phải nhập thời gian phát hiện ra lỗi.',
        ];
        $request->validate($rules,$messages);

        $error = Error::findOrFail($id);
        $error->device_id = $request->device_id;
        $error->type_id = $request->type_id;
        $error->detection_time = Carbon::createFromFormat('d/m/Y H:i:s', $request->detection_time);
        if($request->recovery_time) {
            $error->recovery_time = Carbon::createFromFormat('d/m/Y H:i:s', $request->recovery_time);
        }
        $error->cause = $request->cause;
        $error->solution = $request->solution;
        $error->save();

        Alert::toast('Cập nhật lỗi thành công!', 'success', 'top-right');
        return redirect()->route('errors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Error  $error
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error = Error::findOrFail($id);
        $error->destroy($id);
        Alert::toast('Xóa lỗi thiết bị thành công!', 'success', 'top-right');
        return redirect()->route('errors.index');
    }

    public function anyData()
    {
        $farm_id = Auth::user()->farm_id;
        $my_device_ids = Device::where('farm_id', $farm_id)->pluck('id')->toArray();
        $errors = Error::whereIn('device_id', $my_device_ids)->with('device')->with('type')->orderBy('id', 'desc')->select(['id', 'device_id', 'type_id', 'cause', 'solution', 'detection_time', 'recovery_time'])->get();
        return Datatables::of($errors)
            ->addIndexColumn()
            ->editColumn('device', function ($errors) {
                return '<a href="'.route('devices.show', $errors->device->id).'">'.$errors->device->name.'</a>';

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
            ->addColumn('action', function ($errors) {
                $action = '';
                $action = $action . ' <a href="' . route("errors.edit", $errors->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';
                $action = $action . '<form style="display:inline" action="'. route("errors.destroy", $errors->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['device', 'action'])
            ->make(true);
    }

    public function deviceData($device_id)
    {
        $errors = Error::where('device_id', $device_id)->with('device')->with('type')->orderBy('id', 'desc')->select(['id', 'device_id', 'type_id', 'cause', 'solution', 'detection_time', 'recovery_time'])->get();

        return Datatables::of($errors)
            ->addIndexColumn()
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
            ->addColumn('action', function ($errors) {
                $action = '';
                $action = $action . ' <a href="' . route("errors.edit", $errors->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';
                $action = $action . '<form style="display:inline" action="'. route("errors.destroy", $errors->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function farmData($farm_id)
    {
        $farm_device_ids = Device::where('farm_id', $farm_id)->pluck('id')->toArray();
        $errors = Error::whereIn('device_id', $farm_device_ids)->with('device')->with('type')->orderBy('id', 'desc')->select(['id', 'device_id', 'type_id', 'cause', 'solution', 'detection_time', 'recovery_time', 'updated_at'])->get();

        return Datatables::of($errors)
            ->addIndexColumn()
            ->editColumn('updated_at', function ($errors) {
                return date('d/m/Y H:i',strtotime($errors->updated_at));
            })
            ->editColumn('device', function ($errors) {
                return '<a href="'.route('devices.show', $errors->device->id).'">'.$errors->device->name.'</a>';
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
