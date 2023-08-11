<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Error;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserHomeController extends Controller
{
    public function index()
    {
        return view('user.home');
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
