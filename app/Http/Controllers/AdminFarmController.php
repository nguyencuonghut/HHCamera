<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Datatables;
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
    public function show(Farm $farm)
    {
        return redirect()->back();
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
                return $farms->name;
            })
            ->addColumn('edit', function ($farms) {
                return '<a href="' . route("admin.farms.edit", $farms->id) . '" class="btn btn-warning"> Sửa</a>';
            })
            ->addColumn('delete', '
                <form action="{{ route(\'admin.farms.destroy\', $id) }}" method="POST">
                     <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" name="submit" value="Xóa" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"">

                    {{csrf_field()}}
                </form>')
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }
}
