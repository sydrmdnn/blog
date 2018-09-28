<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // https://laravel.com/docs/5.7/socialite
    // https://www.youtube.com/watch?v=NK9OoqaoiC8
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        // Check user if exist
        $user = User::where('provider_id', $githubUser->getId())->first();
        
        if (!$user) {
            // Add user to database
            $user = User::create([
                'email' => $githubUser->getEmail(),
                'name' => $githubUser->getNickname(),
                'provider_id' => $githubUser->getId(),
            ]);
        }
        
        // Log user in
        Auth::login($user, true); // Second parameter is for remember me property

        // Redirect user
        return redirect($this->redirectTo);
    }
}
