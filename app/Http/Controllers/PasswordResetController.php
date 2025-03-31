<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\ResetPasswordMail;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    // Gửi mã OTP qua email
    public function sendResetEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $email = $request->email;
    $user = User::where('email', $email)->first();

    if (!$user) {
        return back()->withErrors([
            'email' => 'Tài khoản này chưa được đăng ký.',
        ])->with('register_link', route('register'));
    }

    $otpCode = mt_rand(100000, 999999); // Tạo mã OTP 6 chữ số

    // Lưu mã OTP vào cache trong 60 giây
    Cache::put("otp_{$email}", $otpCode, 60);

    // Gửi email chứa mã OTP
    Mail::to($email)->send(new ResetPasswordMail($otpCode));

    return redirect()->route('password.verify')->with('email', $email);
}


    // Hiển thị form xác minh OTP
    public function showVerifyOtpForm()
    {
        return view('auth.verify_otp');
    }

    // Xác minh OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|array',
            'otp.*' => 'required|numeric|digits:1',
        ]);

        $email = $request->input('email') ?? session('email'); // Lấy email từ form

        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Vui lòng nhập email lại từ đầu.']);
        }
        $otpArray = $request->input('otp');
        $otp = implode('', $otpArray); // Chuyển thành chuỗi "123456"

        if (Cache::get("otp_{$email}") == $otp) {
            return redirect()->route('password.reset')->with('email', $email);
        } else {
            return back()->withErrors(['otp' => 'Mã xác thực không đúng hoặc đã hết hạn.']);
        }
    }


    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm()
    {
        return view('auth.reset_password');
    }
    public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $email = $request->input('email'); // Lấy email từ input hidden

    $user = User::where('email', $email)->first();
    if ($user) {
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Mật khẩu đã được đặt lại thành công.');
    }

    return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
}



    // Xử lý đặt lại mật khẩu
    public function resendOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $email = $request->email;
    $user = User::where('email', $email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
    }

    // Tạo mã OTP mới
    $otpCode = mt_rand(100000, 999999);
    Cache::put("otp_{$email}", $otpCode, 60);

    // Gửi email
    Mail::to($email)->send(new ResetPasswordMail($otpCode));

    // Lưu email vào session để giữ trạng thái
    $request->session()->put('email', $email);

    return back()->with('success', 'Mã xác thực đã được gửi lại.');
}

}
