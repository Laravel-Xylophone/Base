<?php

namespace Xylophone\Base\app\Http\Controllers\Auth;

use Xylophone\Base\app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    protected $data = []; // the information we send to the view

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

    use ResetsPasswords;

    /**
     * Get the path the user should be redirected to after password reset.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function redirectTo()
    {
        return xylophone_url();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $guard = xylophone_guard_name();

        $this->middleware("guest:$guard");

        if (!xylophone_users_have_email()) {
            abort(501, trans('xylophone::base.no_email_column'));
        }

        // where to redirect after password was reset
        $this->redirectTo = property_exists($this, 'redirectTo') ? $this->redirectTo : config('xylophone.base.route_prefix', 'admin').'/dashboard';
    }

    // -------------------------------------------------------
    // Laravel overwrites for loading xylophone views
    // -------------------------------------------------------

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null              $token
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        $this->data['title'] = trans('xylophone::base.reset_password'); // set the page title

        return view('xylophone::auth.passwords.reset', $this->data)->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        $passwords = config('xylophone.base.passwords', config('auth.defaults.passwords'));

        return Password::broker($passwords);
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return xylophone_auth();
    }
}
