<?php

if (!function_exists('xylophone_url')) {
    /**
     * Appends the configured xylophone prefix and returns
     * the URL using the standard Laravel helpers.
     *
     * @param $path
     *
     * @return string
     */
    function xylophone_url($path = null, $parameters = [], $secure = null)
    {
        $path = !$path || (substr($path, 0, 1) == '/') ? $path : '/'.$path;

        return url(config('xylophone.base.route_prefix', 'admin').$path, $parameters = [], $secure = null);
    }
}

if (!function_exists('xylophone_authentication_column')) {
    /**
     * Return the username column name.
     * The Laravel default (and Xylophone default) is 'email'.
     *
     * @return string
     */
    function xylophone_authentication_column()
    {
        return config('xylophone.base.authentication_column', 'email');
    }
}

if (!function_exists('xylophone_users_have_email')) {
    /**
     * Check if the email column is present on the user table.
     *
     * @return string
     */
    function xylophone_users_have_email()
    {
        $user_model_fqn = config('xylophone.base.user_model_fqn');
        $user = new $user_model_fqn();

        return \Schema::hasColumn($user->getTable(), 'email');
    }
}

if (!function_exists('xylophone_avatar_url')) {
    /**
     * Returns the avatar URL of a user.
     *
     * @param $user
     *
     * @return string
     */
    function xylophone_avatar_url($user)
    {
        $firstLetter = $user->getAttribute('name') ? $user->name[0] : 'A';
        $placeholder = 'https://placehold.it/160x160/00a65a/ffffff/&text='.$firstLetter;

        switch (config('xylophone.base.avatar_type')) {
            case 'gravatar':
                if (xylophone_users_have_email()) {
                    return Gravatar::fallback('https://placehold.it/160x160/00a65a/ffffff/&text='.$firstLetter)->get($user->email);
                } else {
                    return $placeholder;
                }
                break;

            case 'placehold':
                return $placeholder;
                break;

            default:
                return method_exists($user, config('xylophone.base.avatar_type')) ? $user->{config('xylophone.base.avatar_type')}() : $user->{config('xylophone.base.avatar_type')};
                break;
        }
    }
}

if (!function_exists('xylophone_middleware')) {
    /**
     * Return the key of the middleware used across Xylophone.
     * That middleware checks if the visitor is an admin.
     *
     * @param $path
     *
     * @return string
     */
    function xylophone_middleware()
    {
        return config('xylophone.base.middleware_key', 'admin');
    }
}

if (!function_exists('xylophone_guard_name')) {
    /*
     * Returns the name of the guard defined
     * by the application config
     */
    function xylophone_guard_name()
    {
        return config('xylophone.base.guard', config('auth.defaults.guard'));
    }
}

if (!function_exists('xylophone_auth')) {
    /*
     * Returns the user instance if it exists
     * of the currently authenticated admin
     * based off the defined guard.
     */
    function xylophone_auth()
    {
        return \Auth::guard(xylophone_guard_name());
    }
}

if (!function_exists('xylophone_user')) {
    /*
     * Returns back a user instance without
     * the admin guard, however allows you
     * to pass in a custom guard if you like.
     */
    function xylophone_user()
    {
        return xylophone_auth()->user();
    }
}

if (!function_exists('mb_ucfirst')) {
    /**
     * Capitalize the first letter of a string,
     * even if that string is multi-byte (non-latin alphabet).
     *
     * @param string   $string   String to have its first letter capitalized.
     * @param encoding $encoding Character encoding
     *
     * @return string String with first letter capitalized.
     */
    function mb_ucfirst($string, $encoding = false)
    {
        $encoding = $encoding ? $encoding : mb_internal_encoding();

        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);

        return mb_strtoupper($firstChar, $encoding).$then;
    }
}
