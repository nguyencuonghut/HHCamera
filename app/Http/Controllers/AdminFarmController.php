<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Farm;
use Datatables;
use App\Models\Error;
use App\Models\ErrorType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminFarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.farm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.farm.create');
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
            'name' => 'required|unique:farms|max:255',
            'description' => 'max:255',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.unique' => 'Tên này đã bị trùng với trại khác.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'description.max' => 'Mô tả dài quá 255 ký tự.',
        ];
        $request->validate($rules,$messages);

        $farm = new Farm();
        $farm->name = $request->name;
        $farm->description = $request->description;
        $farm->save();

        Alert::toast('Tạo trại mới thành công!', 'success', 'top-right');
        return redirect()->route('admin.farms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $farm = Farm::findOrFail($id);
        $farm_cam_on_cnt = Device::where('device_category_id', 1)->where('farm_id', $farm->id)->where('status', "ON")->count();
        $farm_cam_off_cnt = Device::where('device_category_id', 1)->where('farm_id', $farm->id)->where('status', "OFF")->count();

        $farm_device_ids = Device::where('farm_id', $farm->id)->pluck('id')->toArray();
        $error_type_id_1_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 1)->count();
        $error_type_id_2_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 2)->count();
        $error_type_id_3_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 3)->count();
        $error_type_id_4_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 4)->count();
        $error_type_id_5_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 5)->count();
        $error_type_id_6_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 6)->count();
        $error_type_id_7_cnt = Error::whereIN('device_id', $farm_device_ids)->where('type_id', 7)->count();

        $error_type_id_1_name = ErrorType::findOrFail(1)->name;
        $error_type_id_2_name = ErrorType::findOrFail(2)->name;
        $error_type_id_3_name = ErrorType::findOrFail(3)->name;
        $error_type_id_4_name = ErrorType::findOrFail(4)->name;
        $error_type_id_5_name = ErrorType::findOrFail(5)->name;
        $error_type_id_6_name = ErrorType::findOrFail(6)->name;
        $error_type_id_7_name = ErrorType::findOrFail(7)->name;
        return view('admin.farm.show',
                    ['farm' => $farm,
                    'farm_cam_on_cnt' => $farm_cam_on_cnt,
                    'farm_cam_off_cnt' => $farm_cam_off_cnt,
                    'error_type_id_1_cnt' => $error_type_id_1_cnt,
                    'error_type_id_2_cnt' => $error_type_id_2_cnt,
                    'error_type_id_3_cnt' => $error_type_id_3_cnt,
                    'error_type_id_4_cnt' => $error_type_id_4_cnt,
                    'error_type_id_5_cnt' => $error_type_id_5_cnt,
                    'error_type_id_6_cnt' => $error_type_id_6_cnt,
                    'error_type_id_7_cnt' => $error_type_id_7_cnt,
                    'error_type_id_1_name' => $error_type_id_1_name,
                    'error_type_id_2_name' => $error_type_id_2_name,
                    'error_type_id_3_name' => $error_type_id_3_name,
                    'error_type_id_4_name' => $error_type_id_4_name,
                    'error_type_id_5_name' => $error_type_id_5_name,
                    'error_type_id_6_name' => $error_type_id_6_name,
                    'error_type_id_7_name' => $error_type_id_7_name,
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farm = Farm::findOrFail($id);
        return view('admin.farm.edit', ['farm' => $farm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:farms|max:255',
            'description' => 'max:255',
            'password' => 'confirmed|',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.unique' => 'Tên này đã bị trùng với trại khác.',
            'name.max' => 'Tên dài quá 255 ký tự.',
            'description.max' => 'Mô tả dài quá 255 ký tự.',
        ];
        $request->validate($rules,$messages);

        $farm = Farm::findOrFail($id);
        $farm->name = $request->name;
        $farm->description = $request->description;
        $farm->save();
        Alert::toast('Cập nhật thông tin thành công!', 'success', 'top-right');
        return redirect()->route('admin.farms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farm = Farm::findOrFail($id);
        $farm->destroy($id);
        Alert::toast('Xóa trại thành công!', 'success', 'top-right');
        return redirect()->route('admin.farms.index');
    }


    public function anyData()
    {
        $farms = Farm::select(['id', 'name'])->get();
        return Datatables::of($farms)
            ->addIndexColumn()
            ->editColumn('name', function ($farms) {
                return '<a href="'.route('admin.farms.show', $farms->id).'">'.$farms->name.'</a>';
            })
            ->addColumn('user', function ($farms) {
                if($farms->user) {
                    return $farms->user->name;
                } else {
                    return '-';
                }
            })
            ->addColumn('action', function ($farms) {
                $action = '';
                $action = $action . ' <a href="' . route("admin.farms.edit", $farms->id) . '" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>';
                $action = $action . '<form style="display:inline" action="'. route("admin.farms.destroy", $farms->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" name="submit" onclick="return confirm(\'Bạn có muốn xóa?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                <input type="hidden" name="_token" value="' . csrf_token(). '"></form>';

                return $action;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
    }
}
