<?php

namespace Backpack\Base\app\Http\Controllers\Auth;

use Alert;
use Backpack\Base\app\Http\Controllers\Controller;
use Backpack\Base\app\Http\Requests\AccountInfoRequest;
use Backpack\Base\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware(xylophone_middleware());
    }

    /**
     * Show the user a form to change his personal information.
     */
    public function getAccountInfoForm()
    {
        $this->data['title'] = trans('xylophone::base.my_account');
        $this->data['user'] = $this->guard()->user();

        return view('xylophone::auth.account.update_info', $this->data);
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountInfoForm(AccountInfoRequest $request)
    {
        $result = $this->guard()->user()->update($request->except(['_token']));

        if ($result) {
            Alert::success(trans('xylophone::base.account_updated'))->flash();
        } else {
            Alert::error(trans('xylophone::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Show the user a form to change his login password.
     */
    public function getChangePasswordForm()
    {
        $this->data['title'] = trans('xylophone::base.my_account');
        $this->data['user'] = $this->guard()->user();

        return view('xylophone::auth.account.change_password', $this->data);
    }

    /**
     * Save the new password for a user.
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $user = $this->guard()->user();
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            Alert::success(trans('xylophone::base.account_updated'))->flash();
        } else {
            Alert::error(trans('xylophone::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return xylophone_auth();
    }
}
