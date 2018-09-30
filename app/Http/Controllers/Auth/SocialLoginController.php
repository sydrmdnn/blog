<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\SocialAccount;
use Socialite;
use Auth;

class SocialLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        $user = $this->findOrCreateUser($provider, $providerUser);
        Auth::login($user, true); // Second parameter is for remember me property
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($provider, $providerUser)
    {
        $socialAccount = SocialAccount
            ::where('provider', $provider)
            ->where('provider_user_id', $providerUser->getId())
            ->first();
        if ($socialAccount) {
            return $socialAccount->user;
        } 
        else if (!$socialAccount) {
            $socialAccount = new SocialAccount([
                'provider' => $provider,
                'provider_user_id' => $providerUser->getId(),
            ]);
            $user = User::where('email', $providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                ]);
            }
            $socialAccount->user()->associate($user);
            $socialAccount->save();
            return $user;
        }
    }
}
