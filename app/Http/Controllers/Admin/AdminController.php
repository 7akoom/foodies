<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ProfileStoreRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\ResetPasswordSubmitRequest;
use App\Models\Admin;
use App\Services\RespondService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Admin\ProfileStoreService;
use App\Services\Admin\PasswordUpdateService;
use App\Services\Admin\PasswordService;

class AdminController extends Controller
{
    protected $respond;
    protected $profileService;
    protected $passwordService;
    protected $passwordUpdateService;

    public function __construct(
        RespondService $respond,
        ProfileStoreService $profileService,
        PasswordService $passwordService,
        PasswordUpdateService $passwordUpdateService) {
        $this->respond = $respond;
        $this->profileService = $profileService;
        $this->passwordService = $passwordService;
        $this->passwordUpdateService = $passwordUpdateService;
    }

    public function AdminLogin()
    {
        return View('admin.login');
    }

    public function AdminDashboard()
    {
        return View('admin.index');
    }

    public function AdminLoginSubmit(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::guard('admin')->attempt([
            'email' => $data['email'],
            'password' => $data['password']], true)) {
            return $this->respond->respondRedirect('admin.dashboard','success','Login success');
        }else{
            return $this->respond->respondRedirect('admin.login','error','Invalid credentials');
        }
    }

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return $this->respond->respondRedirect('admin.login','success','Logout success');
    }

    public function AdminForgetPassword()
    {
        return view('admin.forget_password');
    }

    public function AdminPasswordSubmit(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $result = $this->passwordService->handlePasswordReset($data);
        if ($result === 'Email Not Found') {
            return $this->respond->respondBack('error', $result);
        }      
        return $this->respond->respondBack('success', 'Reset password link sent to your email');
    }

    public function AdminResetPassword($token, $email)
    {
        $admin = Admin::where(['email' => $email, 'token' => $token])->first();
        if (!$admin) {
            return $this->respond->respondRedirect('admin.login','error','Invalid Token or Email');
        }
        return view('admin.reset_password', compact('token','email'));
    }

    public function AdminResetPasswordSubmit(ResetPasswordSubmitRequest $req)
    {
        $validated = $req->validated();
        $admin = Admin::where(['email' => $req->email, 'token' => $req->token])->first();
        $admin->password = Hash::make($validated['password']);
        $admin->token = "";
        $admin->update();
        return $this->respond->respondRedirect('admin.login','success','Password reset successfully');
    }

    public function AdminProfile()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.profile', compact('profileData'));
    }

    public function AdminProfileStore(ProfileStoreRequest $req)
    {
        $validated = $req->validated();
        $result = $this->profileService->profileStore($validated, $req->file('photo'));

        session()->flash('message', $result['notification']['message']);
        session()->flash('alert-type', $result['notification']['alert-type']);
        
        return redirect()->back();
    }

    public function AdminChangePassword()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.change_password', compact('profileData'));
    }

    public function AdminPasswordUpdate(ChangePasswordRequest $req)
    {
        $result = $this->passwordUpdateService->updatePassword(auth()->guard('admin')->user(), $req->validated());

        return back()->with([
            'message' => $result['message'],
            'alert-type' => $result['alert-type']
        ]);
    }
}
