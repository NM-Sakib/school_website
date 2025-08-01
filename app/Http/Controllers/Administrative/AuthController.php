<?php

namespace App\Http\Controllers\Administrative;

use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function index()
    {
        return view('administrative.login');
    }

    public function register()
    {
        return view('administrative.register');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect('/dashboard');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required',
            'password' => 'required',
        ]);
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];
        $result = Auth::attempt($credentials);
        $user = Auth::user();
        if ($result) {
            if ($user->status == 1) {
                $payload = [
                    'code' => 200,
                    'message' => 'Login Successfully.',
                    'url' => route('administrative.dashboard')
                ];
                return response()->json($payload, 200);
            } else {
                $payload = [
                    'code' => 400,
                    'message' => 'Access Denied!',
                    'url' => ''
                ];
                return response()->json($payload, 200);
            }
        } else {
            $payload = [
                'code' => 400,
                'message' => 'Email Or Password invalid.',
                'url' => ''
            ];
            return response()->json($payload, 200);
        }
    }

    public function registerCheckPhone(Request $request)
    {
        try {
            $phone = $request->get('phone');
            $user = User::where('phone', $phone)->first();
            if ($user) {
                $payload = [
                    'code' => 404,
                    'message' => 'User Already Exists.',
                ];
                return response()->json($payload, 200);
            } else {
                if ($phone) {
                    $number = $phone;
                    $code = rand(1234, 9999);
                    $message = 'Your Register otp is ' . $code;
                    if (!str_starts_with(trim($number), '+88')) {
                        $mobileNo = '+88' . trim($number);
                        $sms =  $this->sentSMS($message, $mobileNo);
                        Otp::where(['phone_no' => $phone, 'status' => 0])->delete();
                        Otp::create([
                            'phone_no' => $phone,
                            'otp' => $code,
                            'expire_at' => Carbon::now()->addMinutes(10)
                        ]);
                    }
                }
                $payload = [
                    'code' => 200,
                    'show_otp' => true,
                    'message' => 'Your Register otp sent to ' . $phone,
                    'otp_message' => 'User',
                ];
                return response()->json($payload, 200);
            }
        } catch (\Throwable $th) {
            $payload = [
                'code' => 500,
                'app_message' => 'Something went wrong.',
                'data' => $th->getMessage()
            ];
            return response()->json($payload, 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $otp = $request->get('otp');
            $verificationCode = Otp::where(['otp' => $request->otp, 'phone_no' => $request->phone, 'status' => 0])->first();
            $now = Carbon::now();
            if (!$verificationCode) {
                $payload = [
                    'code' => 400,
                    'message' => 'OTP is not valid',
                    'url' => ''
                ];
                return response()->json($payload, 200);
            } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
                $verificationCode->delete();
                $payload = [
                    'code' => 400,
                    'message' => 'OTP has expired',
                    'url' => ''
                ];
                return response()->json($payload, 200);
            } else {
                $data = [
                    'phone' => $request->phone,
                    'name' => $request->name,
                ];
                $user = User::create($data);
                Auth::login($user);
                $user->assignRole('User');
                $payload = [
                    'code' => 200,
                    'message' => 'Register Successfully.',
                    'url' => route('administrative.dashboard')
                ];
                return response()->json($payload, 200);
            }
        } catch (\Throwable $th) {
            $payload = [
                'code' => 500,
                'app_message' => 'Something went wrong.',
                'data' => $th->getMessage()
            ];
            return response()->json($payload, 500);
        }
    }




    public  function sentSMS($message, $mobileNo)
    {
        $response = Http::get('http://api.icombd.com/api/v1/campaigns/sendsms/plain', [
            'username' => 'singularityltd',
            'password' => 'singularity@690',
            'sender' => '8809612436868',
            'text' => $message,
            'to' => $mobileNo,
        ]);
        return $response;
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('administrative.login');
    }
}
