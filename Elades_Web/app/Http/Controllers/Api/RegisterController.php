<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;

class RegisterController extends Controller
{
    // register
    public function register(Request $request)
    {
        // Validasi awal
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'kode_otp' => 'required|integer',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "error" => $validator->errors()->first()
            ], 422);
        }

        $email = $request->input('email');
        $no_hp = $request->input('no_hp');
        $nama = $request->input('nama');
        $password = Hash::make($request->input('password'));
        $kode_otp = $request->input('kode_otp');

        if (!$email && !$no_hp) {
            return response()->json([
                "success" => false,
                "error" => "Email atau No HP harus diisi."
            ], 422);
        }

        $emailOrHp = $email ?? $no_hp;

        // Cek OTP
        $otpValid = DB::table('otp_temp')
            ->where('email_or_hp', $emailOrHp)
            ->where('kode_otp', $kode_otp)
            ->exists();

        if (!$otpValid) {
            return response()->json([
                "success" => false,
                "error" => "Kode OTP tidak valid atau tidak ditemukan."
            ], 401);
        }

        // Simpan ke akun_user
        try {
            DB::table('akun_user')->insert([
                'email' => $email,
                'no_hp' => $no_hp,
                'nama' => $nama,
                'password' => $password,
                'kode_otp' => $kode_otp,
            ]);

            // Hapus OTP setelah digunakan
            DB::table('otp_temp')->where('email_or_hp', $emailOrHp)->delete();

            return response()->json(["success" => true, "message" => "Registrasi berhasil."]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage()
            ], 500);
        }
    }

    //send_otp
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 422);
        }

        $emailOrPhone = $request->input('email_or_phone');
        $kode_otp = rand(100000, 999999);

        $isEmail = filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL);
        $isPhone = preg_match('/^08\d{8,12}$/', $emailOrPhone);

        if (!$isEmail && !$isPhone) {
            return response()->json(['success' => false, 'error' => 'Format tidak valid (bukan email atau no HP)'], 400);
        }

        // Hapus OTP lama
        DB::table('otp_temp')->where('email_or_hp', $emailOrPhone)->delete();

        if ($isEmail) {
            // Kirim OTP via Email
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'donihermawwan@gmail.com';
                $mail->Password = 'twtt hdjy uhut aykv'; // Gunakan App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('donihermawwan@gmail.com', 'Elades');
                $mail->addAddress($emailOrPhone);
                $mail->Subject = 'Kode OTP Verifikasi';
                $mail->Body = "Kode OTP kamu adalah: $kode_otp";

                $mail->send();

                DB::table('otp_temp')->insert([
                    'email_or_hp' => $emailOrPhone,
                    'kode_otp' => $kode_otp
                ]);

                return response()->json(['success' => true, 'via' => 'email']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => $mail->ErrorInfo]);
            }

        } elseif ($isPhone) {
            // Kirim OTP via WhatsApp (Fonnte)
            $token = 'vFzBcGzxc2318AXoxgLA';
            $target = preg_replace('/^0/', '', $emailOrPhone);

            $response = $this->sendFonnteOtp($target, $kode_otp, $token);
            $result = json_decode($response, true);

            if (isset($result['status']) && $result['status'] == true) {
                DB::table('otp_temp')->insert([
                    'email_or_hp' => $emailOrPhone,
                    'kode_otp' => $kode_otp
                ]);

                return response()->json(['success' => true, 'via' => 'whatsapp']);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Gagal kirim OTP via WhatsApp',
                    'debug_response' => $response
                ]);
            }
        }
    }

    private function sendFonnteOtp($target, $kode_otp, $token)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $target,
                'message' => "Kode OTP kamu adalah: $kode_otp"
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ]
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
