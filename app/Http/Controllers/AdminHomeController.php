<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Device;
use App\Models\Error;
use App\Models\ErrorType;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminHomeController extends Controller
{
    public function index()
    {
        $farms_cnt = Farm::count();
        $devices_cnt = Device::count();
        $errors_cnt = Error::count();
        $cams_cnt = Device::where('device_category_id', 2)->count();
        $cam_on_cnt = Device::where('device_category_id', 2)->where('status', 'ON')->count();
        $cam_off_cnt = Device::where('device_category_id', 2)->where('status', 'OFF')->count();


        $error_type_id_1_cnt = Error::where('type_id', 1)->count();
        $error_type_id_2_cnt = Error::where('type_id', 2)->count();
        $error_type_id_3_cnt = Error::where('type_id', 3)->count();
        $error_type_id_4_cnt = Error::where('type_id', 4)->count();
        $error_type_id_5_cnt = Error::where('type_id', 5)->count();
        $error_type_id_6_cnt = Error::where('type_id', 6)->count();
        $error_type_id_7_cnt = Error::where('type_id', 7)->count();

        $error_type_id_1_name = ErrorType::findOrFail(1)->name;
        $error_type_id_2_name = ErrorType::findOrFail(2)->name;
        $error_type_id_3_name = ErrorType::findOrFail(3)->name;
        $error_type_id_4_name = ErrorType::findOrFail(4)->name;
        $error_type_id_5_name = ErrorType::findOrFail(5)->name;
        $error_type_id_6_name = ErrorType::findOrFail(6)->name;
        $error_type_id_7_name = ErrorType::findOrFail(7)->name;
        return view('admin.home',
                    [
                        'farms_cnt' => $farms_cnt,
                        'devices_cnt' => $devices_cnt,
                        'errors_cnt' => $errors_cnt,
                        'cams_cnt' => $cams_cnt,
                        'cam_on_cnt' => $cam_on_cnt,
                        'cam_off_cnt' => $cam_off_cnt,
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


    public function profile()
    {
        return view('admin.profile');
    }

    public function showChangePasswordForm()
    {
        return view('admin.change_password');
    }

    public function submitChangePasswordForm(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed|min:6',
        ];
        $messages = [
            'password.required' => 'Bạn phải nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải dài ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu không khớp.',
        ];
        $request->validate($rules,$messages);

        $admin = Admin::findOrFail(Auth::user()->id);
        $admin->password = bcrypt($request->password);
        $admin->save();

        Alert::toast('Đổi mật khẩu thành công!', 'success', 'top-right');
        return redirect()->route('admin.profile');
    }
}
