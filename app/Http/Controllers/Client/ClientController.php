<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Client\ProfileStoreRequest;
use App\Http\Requests\Client\LoginRequest;
use App\Http\Requests\Client\RegisterSubmitRequest;
use App\Http\Requests\Client\ResetPasswordRequest;
use App\Http\Requests\Client\ResetPasswordSubmitRequest;
use App\Models\Client;
use App\Services\Client\PasswordService;
use App\Services\Client\ProfileStoreService;
use App\Services\Client\PasswordUpdateService;
use App\Services\Client\RegisterService;
use App\Services\RespondService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    protected $respond;
    protected $registerService;
    protected $profileService;
    protected $passwordUpdateService;
    protected $passwordService;

    public function __construct(
        RespondService $respond,
        RegisterService $registerService,
        ProfileStoreService $profileService,
        PasswordUpdateService $passwordUpdateService,
        PasswordService $passwordService)
    {
        $this->respond = $respond;
        $this->registerService = $registerService;
        $this->profileService = $profileService;
        $this->passwordUpdateService = $passwordUpdateService;
        $this->passwordService = $passwordService;
    }

    public function ClientLogin()
    {
        return view('client.login');
    }

    public function ClientRegister()
    {
        return view('client.register');
    }

    public function ClientRegisterSubmit(RegisterSubmitRequest $req)
    {
        $validated = $req->validated();
        
        $notification = $this->registerService->registerClient($validated);

        return redirect()->route('client.login')->with($notification);
    }

    public function ClientLoginSubmit(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::guard('client')->attempt([
            'email' => $data['email'],
            'password' => $data['password']], true)) {
            return $this->respond->respondRedirect('client.dashboard','success','Login success');
        }else{
            return $this->respond->respondRedirect('client.login','error','Invalid credentials');
        }
    }

    public function ClientDashboard()
    {
        return view('client.index');
    }

    public function ClientLogout()
    {
        Auth::guard('client')->logout();
        return $this->respond->respondRedirect('client.login','success','Logout success');
    }

    public function ClientProfile()
    {
        $id = Auth::guard('client')->id();
        $profileData = Client::find($id);
        return view('client.profile', compact('profileData'));
    }

    public function ClientProfileStore(ProfileStoreRequest $req)
    {
        $validated = $req->validated();

        $result = $this->profileService->profileStore(
            $validated,
            $req->file('photo'),
            $req->file('cover_photo')
        );

        session()->flash('message', $result['notification']['message']);
        session()->flash('alert-type', $result['notification']['alert-type']);
        
        return redirect()->back();
    }

    public function ClientChangePassword()
    {
        $id = Auth::guard('client')->id();
        $profileData = Client::find($id);
        return view('client.change_password', compact('profileData'));
    }

    public function ClientPasswordUpdate(ChangePasswordRequest $req)
    {
        $result = $this->passwordUpdateService->updatePassword(auth()->guard('client')->user(), $req->validated());

        return back()->with([
            'message' => $result['message'],
            'alert-type' => $result['alert-type']
        ]);
    }

    public function ClientForgetPassword()
    {
        return view('client.forget_password');
    }

    public function ClientPasswordSubmit(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $result = $this->passwordService->handlePasswordReset($data);
        if ($result === 'Email Not Found') {
            return $this->respond->respondBack('error', $result);
        }      
        return $this->respond->respondBack('success', 'Reset password link sent to your email');
    }

    public function ClientResetPassword($token, $email)
    {
        $client = Client::where(['email' => $email, 'token' => $token])->first();
        if (!$client) {
            return $this->respond->respondRedirect('client.login','error','Invalid Token or Email');
        }
        return view('client.reset_password', compact('token','email'));
    }

    public function ClientResetPasswordSubmit(ResetPasswordSubmitRequest $req)
    {
        $validated = $req->validated();
        $admin = Client::where(['email' => $req->email, 'token' => $req->token])->first();
        $admin->password = Hash::make($validated['password']);
        $admin->token = "";
        $admin->update();
        return $this->respond->respondRedirect('client.login','success','Password reset successfully');
    }
}
