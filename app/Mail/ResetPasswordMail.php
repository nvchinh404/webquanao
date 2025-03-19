<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code; // Biến chứa mã OTP

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Mã xác nhận đặt lại mật khẩu')
                    ->view('emails.reset_password')  // View email (sẽ tạo bên dưới)
                    ->with(['code' => $this->code]);
    }
}
