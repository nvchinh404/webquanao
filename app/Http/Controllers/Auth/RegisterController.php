<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký tài khoản.
     */
    public function register(Request $request)
    {
        // Validate dữ liệu nhập vào
        $this->validator($request->all())->validate();

        // Tạo người dùng mới
        $user = $this->create($request->all());

        // Đăng nhập người dùng mới tạo
        Auth::login($user);

        // Chuyển hướng về trang dashboard admin (hoặc trang khác theo ý bạn)
        return redirect()->route('admin.dashboard')->with('success', 'Đăng ký thành công!');
    }

    /**
     * Kiểm tra dữ liệu nhập vào.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'                 => ['nullable', 'string', 'max:20'],
            'address'               => ['nullable', 'string', 'max:255'],
            'password'              => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Tạo người dùng mới.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'] ?? null,
            'address'  => $data['address'] ?? null,
            'password' => Hash::make($data['password']),
        ]);
    }
}
