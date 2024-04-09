<?php

namespace App\Http\Controllers\User\Auth;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GoogleLoginController extends Controller
{
    use RegistersUsers;

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            event(new Registered($user = createUser([
                'username' => $googleUser->id,
                'email' => $googleUser->email,
                'password' => $googleUser->token,
            ])));

            $user->ev = Status::VERIFIED;
            $user->save();
        }

        $this->guard()->login($user);

        return to_route('user.home')
            ?: redirect($this->redirectPath());
    }
}
