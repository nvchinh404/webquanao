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
    // Kiểm tra rằng mỗi ô phải có 1 ký tự số
    $request->validate([
        'email' => 'required|email',
        'otp'   => 'required|array',
        'otp.*' => 'required|numeric|digits:1',
    ]);

    // Chuyển đổi mảng OTP thành chuỗi
    $otpArray = $request->input('otp'); // Mảng 6 phần tử
    $otp = implode('', $otpArray); // Chuyển thành chuỗi, ví dụ "123456"

    // Kiểm tra mã OTP
    if (Cache::get("otp_{$request->email}") == $otp) {
        return redirect()->route('password.reset')->with('email', $request->email);
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

    // Nếu mã OTP đã tồn tại trong cache, lấy lại mã đó, nếu không tạo mới và lưu vào cache
    if (Cache::has("otp_{$email}")) {
        $otpCode = Cache::get("otp_{$email}");
    } else {
        $otpCode = mt_rand(100000, 999999); // Tạo mã OTP 6 chữ số mới
        Cache::put("otp_{$email}", $otpCode, 60);
    }

    // Gửi email chứa mã OTP (sử dụng Mailable ResetPasswordMail)
    Mail::to($email)->send(new ResetPasswordMail($otpCode));

    return back()->with('success', 'Mã xác thực đã được gửi lại.');
}

}
