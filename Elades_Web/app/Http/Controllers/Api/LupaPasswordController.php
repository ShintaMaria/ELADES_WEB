<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;

class LupaPasswordController extends Controller
{
    //LupaPassword_verifikasi_otp
    public function verifyOtp(Request $request)
    {
        // Validasi input
        $request->validate([
            'email_or_phone' => 'required|string',
            'kode_otp' => 'required|string',
        ], [
            'email_or_phone.required' => 'Email/No HP wajib diisi',
            'kode_otp.required' => 'Kode OTP wajib diisi',
        ]);

        $emailOrPhone = $request->input('email_or_phone');
        $kodeOtp = $request->input('kode_otp');

        // Cari OTP yang cocok
        $otp = DB::table('otp_temp')
            ->where('email_or_hp', $emailOrPhone)
            ->where('kode_otp', $kodeOtp)
            ->first();

        if ($otp) {
            // Hapus kode OTP setelah berhasil validasi
            DB::table('otp_temp')
                ->where('email_or_hp', $emailOrPhone)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kode OTP valid',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kode OTP salah atau tidak ditemukan',
        ], 404);
    }

    //LupaPassword
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email_or_phone' => 'required|string',
            'password_baru' => 'required|string|min:8',
        ], [
            'email_or_phone.required' => 'Email/No HP wajib diisi',
            'password_baru.required' => 'Password baru wajib diisi',
            'password_baru.min' => 'Password minimal 8 karakter',
        ]);

        $emailOrPhone = $request->input('email_or_phone');
        $passwordBaru = $request->input('password_baru');

        // Hash password baru
        $passwordHash = Hash::make($passwordBaru);

        // Update password di database
        $updated = DB::table('akun_user')
            ->where('email', $emailOrPhone)
            ->orWhere('no_hp', $emailOrPhone)
            ->update(['password' => $passwordHash]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui password atau data tidak ditemukan'
            ], 400);
        }
    }

    ///// send_otp_reset
    public function sendOtp(Request $request)
    {
        $emailOrPhone = $request->input('email_or_phone');

        if (!$emailOrPhone) {
            return response()->json(['success' => false, 'error' => 'Email atau No HP wajib diisi'], 422);
        }

        $kode_otp = rand(100000, 999999);
        $isEmail = filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL);
        $isPhone = preg_match('/^08\d{8,12}$/', $emailOrPhone);

        if ($isEmail) {
            return $this->sendOtpViaEmail($emailOrPhone, $kode_otp);
        } elseif ($isPhone) {
            return $this->sendOtpViaWhatsApp($emailOrPhone, $kode_otp);
        } else {
            return response()->json(['success' => false, 'error' => 'Format tidak valid (bukan email atau no hp)'], 422);
        }
    }

    private function sendOtpViaEmail($email, $kode_otp)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'donihermawwan@gmail.com'; // GANTI
            $mail->Password = 'twtt hdjy uhut aykv';      // GANTI - Gunakan App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('donihermawwan@gmail.com', 'Elades');
            $mail->addAddress($email);
            $mail->Subject = 'Reset Password - Kode OTP';
            $mail->Body = "Kode OTP untuk reset password kamu adalah: $kode_otp";

            $mail->send();

            // Simpan ke database
            DB::table('otp_temp')->where('email_or_hp', $email)->delete();
            DB::table('otp_temp')->insert([
                'email_or_hp' => $email,
                'kode_otp' => $kode_otp
            ]);

            return response()->json([
                'success' => true,
                'via' => 'email',
                'kode_otp' => $kode_otp
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Gagal mengirim email',
                'debug' => $mail->ErrorInfo
            ]);
        }
    }

    private function sendOtpViaWhatsApp($phone, $kode_otp)
    {
        $token = 'vFzBcGzxc2318AXoxgLA'; // GANTI
        $target = preg_replace('/^0/', '', $phone); // Ubah jadi 8xxx...

        $message = "Kode OTP untuk reset password kamu adalah: $kode_otp";

        $response = $this->sendFonnteMessage($token, $target, $message);
        $result = json_decode($response, true);

        if (isset($result['status']) && $result['status'] == true) {
            DB::table('otp_temp')->where('email_or_hp', $phone)->delete();
            DB::table('otp_temp')->insert([
                'email_or_hp' => $phone,
                'kode_otp' => $kode_otp
            ]);

            return response()->json([
                'success' => true,
                'via' => 'whatsapp',
                'kode_otp' => $kode_otp
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Gagal kirim OTP via WhatsApp',
                'debug_response' => $response,
                'parsed_result' => $result
            ]);
        }
    }

    private function sendFonnteMessage($token, $target, $message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => $message
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ],
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
