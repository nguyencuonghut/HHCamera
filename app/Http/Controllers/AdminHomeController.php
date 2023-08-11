<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
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
