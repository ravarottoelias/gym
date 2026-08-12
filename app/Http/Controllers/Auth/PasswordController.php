<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Helpers\PasswordHelper;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\auth\ResetPasswordRequest;
use App\Http\Requests\SendPasswordResetLinkRequest;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    private PasswordHelper $passwordHelper;

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(PasswordHelper $passwordHelper)
    {
        $this->middleware('guest');
        $this->passwordHelper = $passwordHelper;
    }
    
    public function sendPasswordResetLink(SendPasswordResetLinkRequest $request)
    {
        $this->passwordHelper->sendPasswordResetLink($request);

        flash()->success(@trans('custom.send_email_password_reset_link_success_message'));
        
        return back();
    }
    
    public function getResetPassword($token)
    {
        
        $user = User::where('email', Crypt::decrypt($token))
            ->where('reset_password', $token)
            ->firstOrFail();

        return view('auth.reset-password', compact('user', 'token'));
    }
    
    /**
     * Undocumented function
     *
     * @param ResetPasswordRequest $request
     * @param [type] $token
     * @return void
     */
    public function postResetPassword(ResetPasswordRequest $request, $token)
    {
        $user = User::where('email', Crypt::decrypt($token))->firstOrFail();
        $user->password = bcrypt($request->password);
        $user->reset_password = null;
        $user->update();
        
        flash()->success(@trans('custom.password_reset_success_message'));
        return view('auth.reset-password-success', compact('user'));
    }
}
