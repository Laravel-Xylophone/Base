<?php

namespace Xylophone\Base\app\Models;

use App\User;
use Xylophone\Base\app\Models\Traits\InheritsRelationsFromParentModel;
use Xylophone\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;

class XylophoneUser extends User
{
    use InheritsRelationsFromParentModel;

    protected $table = 'users';

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}
