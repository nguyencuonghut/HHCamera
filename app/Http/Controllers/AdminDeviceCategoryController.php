<?php

namespace App\Http\Controllers;

use App\Models\DeviceCategory;
use Illuminate\Http\Request;
use Datatables;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDeviceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.device_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.device_category.create');
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
            'name' => 'required|unique:device_categories|max:255',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.unique' => 'Tên này đã bị trùng với trại khác.',
            'name.max' => 'Tên dài quá 255 ký tự.',
        ];
        $request->validate($rules,$messages);

        $device_category = new DeviceCategory();
        $device_category->name = $request->name;
        $device_category->save();

        Alert::toast('Tạo trại mới thành công!', 'success', 'top-right');
        return redirect()->route('admin.device_categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeviceCategory  $device_category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeviceCategory  $device_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device_category = DeviceCategory::findOrFail($id);
        return view('admin.device_category.edit', ['device_category' => $device_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeviceCategory  $device_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:device_categories|max:255',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.unique' => 'Tên này đã bị trùng với trại khác.',
            'name.max' => 'Tên dài quá 255 ký tự.',
        ];
        $request->validate($rules,$messages);

        $device_category = DeviceCategory::findOrFail($id);
        $device_category->name = $request->name;
        $device_category->save();
        Alert::toast('Cập nhật thông tin thành công!', 'success', 'top-right');
        return redirect()->route('admin.device_categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeviceCategory  $device_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device_category = DeviceCategory::findOrFail($id);
        $device_category->destroy($id);
        Alert::toast('Xóa trại thành công!', 'success', 'top-right');
        return redirect()->route('admin.device_categories.index');
    }


    public function anyData()
    {
        $device_categories = DeviceCategory::select(['id', 'name'])->get();
        return Datatables::of($device_categories)
            ->addIndexColumn()
            ->editColumn('name', function ($device_categories) {
                return $device_categories->name;
            })
            ->addColumn('edit', function ($device_categories) {
                return '<a href="' . route("admin.device_categories.edit", $device_categories->id) . '" class="btn btn-warning"> Sửa</a>';
            })
            ->addColumn('delete', '
                <form action="{{ route(\'admin.device_categories.destroy\', $id) }}" method="POST">
                     <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" name="submit" value="Xóa" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"">

                    {{csrf_field()}}
                </form>')
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }
}
