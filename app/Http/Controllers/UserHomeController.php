<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Error;
use App\Models\ErrorType;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserHomeController extends Controller
{
    public function index()
    {
        $farm_id = Auth::user()->farm_id;
        $my_device_ids = Device::where('farm_id', $farm_id)->pluck('id')->toArray();

        $errors_cnt = Error::whereIn('device_id', $my_device_ids)->count();
        $cams_cnt = Device::where('farm_id', $farm_id)->where('device_category_id', 1)->count();
        $cam_on_cnt = Device::where('farm_id', $farm_id)->where('device_category_id', 1)->where('status', 'ON')->count();
        $cam_off_cnt = Device::where('farm_id', $farm_id)->where('device_category_id', 1)->where('status', 'OFF')->count();


        $error_type_id_1_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 1)->count();
        $error_type_id_2_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 2)->count();
        $error_type_id_3_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 3)->count();
        $error_type_id_4_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 4)->count();
        $error_type_id_5_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 5)->count();
        $error_type_id_6_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 6)->count();
        $error_type_id_7_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 7)->count();
        $error_type_id_8_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 8)->count();
        $error_type_id_9_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 9)->count();
        $error_type_id_10_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 10)->count();
        $error_type_id_11_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 11)->count();
        $error_type_id_12_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 12)->count();
        $error_type_id_13_cnt = Error::whereIn('device_id', $my_device_ids)->where('type_id', 13)->count();

        $error_type_id_1_name = ErrorType::findOrFail(1)->name;
        $error_type_id_2_name = ErrorType::findOrFail(2)->name;
        $error_type_id_3_name = ErrorType::findOrFail(3)->name;
        $error_type_id_4_name = ErrorType::findOrFail(4)->name;
        $error_type_id_5_name = ErrorType::findOrFail(5)->name;
        $error_type_id_6_name = ErrorType::findOrFail(6)->name;
        $error_type_id_7_name = ErrorType::findOrFail(7)->name;
        $error_type_id_8_name = ErrorType::findOrFail(8)->name;
        $error_type_id_9_name = ErrorType::findOrFail(9)->name;
        $error_type_id_10_name = ErrorType::findOrFail(10)->name;
        $error_type_id_11_name = ErrorType::findOrFail(11)->name;
        $error_type_id_12_name = ErrorType::findOrFail(12)->name;
        $error_type_id_13_name = ErrorType::findOrFail(13)->name;


        $today = today();
        $startDate = today()->subdays(30);
        $period = CarbonPeriod::create($startDate, $today);
        $datasheet = [];
        // Iterate over the errors
        foreach ($period as $date) {
            $datasheet[$date->format('d/m/Y')] = [];
            $datasheet[$date->format('d/m/Y')] = [];
            $datasheet[$date->format('d/m/Y')]["error"] = 0;
        }
        $errors = Error::whereBetween('created_at', [$startDate, now()])->whereIn('device_id', $my_device_ids)->get();
        foreach ($errors as $error) {
            $datasheet[$error->created_at->format('d/m/Y')]["error"]++;
        }
        //dd($datasheet);

        return view('user.home',
                    [
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
                        'error_type_id_8_cnt' => $error_type_id_8_cnt,
                        'error_type_id_9_cnt' => $error_type_id_9_cnt,
                        'error_type_id_10_cnt' => $error_type_id_10_cnt,
                        'error_type_id_11_cnt' => $error_type_id_11_cnt,
                        'error_type_id_12_cnt' => $error_type_id_12_cnt,
                        'error_type_id_13_cnt' => $error_type_id_13_cnt,
                        'error_type_id_1_name' => $error_type_id_1_name,
                        'error_type_id_2_name' => $error_type_id_2_name,
                        'error_type_id_3_name' => $error_type_id_3_name,
                        'error_type_id_4_name' => $error_type_id_4_name,
                        'error_type_id_5_name' => $error_type_id_5_name,
                        'error_type_id_6_name' => $error_type_id_6_name,
                        'error_type_id_7_name' => $error_type_id_7_name,
                        'error_type_id_8_name' => $error_type_id_8_name,
                        'error_type_id_9_name' => $error_type_id_9_name,
                        'error_type_id_10_name' => $error_type_id_10_name,
                        'error_type_id_11_name' => $error_type_id_11_name,
                        'error_type_id_12_name' => $error_type_id_12_name,
                        'error_type_id_13_name' => $error_type_id_13_name,
                        'datasheet' => $datasheet,
                    ]);
    }

    public function profile()
    {
        $farm_id = Auth::user()->farm_id;
        return view('user.profile', ['farm_id' => $farm_id]);
    }

    public function showChangePasswordForm()
    {
        return view('user.change_password');
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

        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        Alert::toast('Đổi mật khẩu thành công!', 'success', 'top-right');
        return redirect()->route('user.profile');

    }
}
