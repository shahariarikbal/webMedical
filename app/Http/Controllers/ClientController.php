<?php

namespace App\Http\Controllers;

use App\Client;
use App\Mail\ClientResetPasswordLink;
use App\Mail\ClientResetPasswordSuccessMail;
use App\Mail\ClientVerificationMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Validator;
class ClientController extends Controller
{
    public function clientsRegisterForm()
    {
        return view('auth.client-register');
    }

    public function clientsRegisterPhone(Request $request)
    {
        return response()->json(['available' => Client::where('phone', $request->phone)->count() === 0], 200);
    }

    public function clientsRegisterEmail(Request $request)
    {
        return response()->json(['available' => Client::where('email', $request->email)->count() === 0], 200);
    }

    public function clientsRegister(Request $request)
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|unique:clients,email',
            'phone'     => 'required|unique:clients,phone',
            'logo'      => 'required|mimes:jpeg,jpg,png,gif,webp|max:1024',
            'password'  => 'required|min:8|max:20',
        ]);

        try {
            $token = Str::random(64);

            $logoName = time().'_'.'.'. $request->logo->extension();
            $request->logo->move(public_path('logos'), $logoName);

            $clientRegister = new Client();
            $clientRegister->name = $request->name;
            $clientRegister->email = $request->email;
            $clientRegister->phone = $request->phone;
            $clientRegister->password = bcrypt($request->password);
            $clientRegister->email_verification_token = $token;
            $clientRegister->token_expire_at = Carbon::now()->addHours(24);
            $clientRegister->logo = $logoName;

            if ($clientRegister->save()) {
                Mail::to($clientRegister->email)->send(new ClientVerificationMail($clientRegister));
            }

            return response()->json([
                'status' => 201,
                'message' => 'Confirm your mail address.'
            ], 201);

        }catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'error' => $exception->getMessage()
            ], 201);
        }

    }

    public function clientsLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $client = Client::where('email', $request->email)->first();
        if ($client->email_verified === 0){
            return redirect('/clients/login-form')->with('error', 'Your account not activated, Please verify your account.');
        }

        if ($client){
            if (password_verify($request->password, $client->password)){
                Session::put('id', $client->id);
                Session::put('name', $client->name);
                return redirect('/clients/dashboard');
            }else{
                return redirect('/clients/login-form')->with('error', 'Password dose not match');
            }

        }else{
            return redirect('/clients/login-form')->with('error', 'E-mail dose not match');
        }

    }

    public function emailVerification($token = null)
    {
        if ($token === null) {
            return redirect('clients/login-form')->with('error', 'Invalid token');
        }

        $client = Client::where('email_verification_token', $token)->first();

        if ($client === null){
            return redirect('/clients/login-form')->with('error', 'Invalid token');
        }

        $client->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => ''
        ]);

        return redirect('/clients/login-form')->with('success', 'Your account is activated. You can login now');
    }

    public function clientsLoginForm()
    {
        return view('auth.client-login');
    }

    public function clientsForgotPasswordForm()
    {
        return view('auth.client-forgot-password');
    }

    public function clientsResetPassword(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email'
        ]);

        $client = Client::select('email')->where('email', $request->email)->first();
        $token = Str::random(64);

        if ($client) {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token
            ]);
            Mail::to($client->email)->send(new ClientResetPasswordLink($token));
            return redirect()->back()->with('success', 'Your password reset link sent your mail.');
        }else{
            return redirect()->back()->with('error', 'This email is not registered in our system');
        }
    }

    public function clientsResetPasswordForm()
    {
        return view('auth.client-reset-password-form');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'token'    => ['required', 'exists:password_resets,token']
        ]);
    }


    public function clientsResetPasswordUpdate(Request $request)
    {
        $this->validator($request->all())->validate();

        $email = DB::table('password_resets')->select('email')->where('token', $request->token)->first()->email;

        $clientPasswordUpdate = Client::where('email', $email)->update([
            'password' => bcrypt($request->password)
        ]);
        Mail::to($email)->send(new ClientResetPasswordSuccessMail($clientPasswordUpdate));
        return redirect()->back()->with('success', 'Your password has been changed');
    }
}
