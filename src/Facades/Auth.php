<?php

namespace Start\Facades;

use Start\Kernel\Facade;

/**
 * @method static bool check()
 * @method static bool guest()
 * @method static \Start\Database\Model|null user()
 * @method static int|null id()
 * @method static bool validate(array $credentials = [])
 * @method static bool attempt(array $credentials = [], bool $remember = false)
 * @method static bool login(\Start\Database\Model $user, bool $remember = false)
 * @method static bool loginUsingId(mixed $id, bool $remember = false)
 * @method static void logout()
 *
 * @see \Start\Auth\Auth
 */
class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Start\Auth\Auth::class;
    }
}
