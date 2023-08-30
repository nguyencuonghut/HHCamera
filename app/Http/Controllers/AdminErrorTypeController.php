<?php

namespace App\Http\Controllers;

use App\Models\ErrorType;
use Datatables;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminErrorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.error_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.error_type.create');
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
            'name.unique' => 'Tên này đã bị trùng với danh mục lỗi khác.',
            'name.max' => 'Tên dài quá 255 ký tự.',
        ];
        $request->validate($rules,$messages);

        $error_type = new ErrorType();
        $error_type->name = $request->name;
        $error_type->save();

        Alert::toast('Tạo danh mục lỗi mới thành công!', 'success', 'top-right');
        return redirect()->route('admin.error_types.index');
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
     * @param  \App\Models\ErrorType  $error_type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $error_type = ErrorType::findOrFail($id);
        return view('admin.error_type.edit', ['error_type' => $error_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ErrorType  $error_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|unique:error_types|max:255',
        ];
        $messages = [
            'name.required' => 'Bạn phải nhập tên.',
            'name.unique' => 'Tên này đã bị trùng với danh mục lỗi khác.',
            'name.max' => 'Tên dài quá 255 ký tự.',
        ];
        $request->validate($rules,$messages);

        $error_type = ErrorType::findOrFail($id);
        $error_type->name = $request->name;
        $error_type->save();
        Alert::toast('Cập nhật thông tin thành công!', 'success', 'top-right');
        return redirect()->route('admin.error_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ErrorType  $error_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error_type = ErrorType::findOrFail($id);
        $error_type->destroy($id);
        Alert::toast('Xóa danh mục lỗi thành công!', 'success', 'top-right');
        return redirect()->route('admin.error_types.index');
    }


    public function anyData()
    {
        $error_types = ErrorType::orderBy('id')->orderBy('id', 'desc')->select(['id', 'name'])->get();
        return Datatables::of($error_types)
            ->addIndexColumn()
            ->editColumn('name', function ($error_types) {
                return $error_types->name;
            })
            ->addColumn('edit', function ($error_types) {
                return '<a href="' . route("admin.error_types.edit", $error_types->id) . '" class="btn btn-warning"> Sửa</a>';
            })
            ->addColumn('delete', '
                <form action="{{ route(\'admin.error_types.destroy\', $id) }}" method="POST">
                     <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" name="submit" value="Xóa" class="btn btn-danger" onClick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"">

                    {{csrf_field()}}
                </form>')
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }
}
