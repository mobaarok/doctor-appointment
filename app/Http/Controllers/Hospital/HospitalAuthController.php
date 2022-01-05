<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospitalLoginRequest;
use App\Http\Requests\StoreHospitalRegisterRequest;
use App\Mail\EmailVerification;
use App\Model\Hospital;
use App\Repositories\HospitalRepository;
use App\Rules\MatchHospitalOldPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\ValidationException;


class HospitalAuthController extends Controller
{
    public function registerHospital()
    {
        return view('hospital.auth.register');
    }

    public function registerHospitalAction(StoreHospitalRegisterRequest $request, HospitalRepository $hospitalRepository)
    {
        $hospital =  $hospitalRepository->register($request);

        $message = $hospital->hospital_name . " registered successfully. Please Login using email address";

        return redirect()->route('hospital.login')
            ->with("message",   $message)
            ->with('messageType', "success");
    }

    public function login()
    {
        return view('hospital.auth.login');
    }

    public function authenticate(HospitalLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->only('remember');

        if (Auth::guard('hospital')->attempt($credentials, $remember)) {
            // Authentication passed...
            Auth::guard('hospital')->user();
            return redirect()->intended(route('hospital.home'));
        } else {
            return redirect()->back()
                ->withInput($request->except('password'))
                ->with("msg", "Email or Password is wrong")
                ->with('msgType', "danger");
        }
    }

    public function logout()
    {
        Auth::guard('hospital')->logout();
        return redirect(route('hospital.login'));
    }


    
    public function accountCheck($id)
    {
        $hospital = Hospital::find($id);
        if ($hospital) {
            // $hospital->is_activated === 0
            return view('hospital.is_activated', ['hospital' => $hospital]);
        } else {
            return 'wrong try';
        }
    }


    public function sendEmailVerificationMail()
    {
        $hospital = Auth::guard('hospital')->user();

        Mail::to($hospital->email)->send(new EmailVerification($hospital));
        return 'mail sending';
    }

    public function verifyEmail($token = null)
    {
        if ($token == null) {
            return 'invalid token';
        }

        $hospital = Hospital::where('email_verification_token', $token)->first();
        if ($hospital == null) {
            return 'invalid user';
        }

        $hospital->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => "",
        ]);

        return "verified";
    }

    public function changePassword()
    {
        return view('hospital.auth.change_password');
    }

    public function changePasswordAction(Request $request)
    {
        $rules = [
            'old_password' => ['required', new MatchHospitalOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ];
        $messages = [
            'old_password.required' => 'Old password is requierd',
            'new_password.required' => 'New Password is required',
            'new_confirm_password.same' => 'Password Confirmation dose not match',
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        Hospital::find(auth('hospital')->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('hospital.home');
    }
}
