<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\SocialIdentity;

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

    public function logout()
    {
        Auth::logout();
        return redirect()->action('HomeController@index');
    }

    public function redirectToProvider($provider)
    {
//        return Socialite::driver('google')->redirect();
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
//        try {
//            $user = Socialite::driver('google')->user();
//        } catch (\Exception $e) {
//            return redirect('/login');
//        }
//
//        // check if they're an existing user
//        $existingUser = User::where('email', $user->email)->first();
//        if ($existingUser) {
//            // log them in
//            auth()->login($existingUser, true);
//        } else {
//            // create a new user
//            $newUser = new User;
//            $newUser->name = $user->name;
//            $newUser->email = $user->email;
//            $newUser->google_id = $user->id;
//            $newUser->avatar = $user->avatar;
//            $newUser->avatar_original = $user->avatar_original;
//            $newUser->save();
//            auth()->login($newUser, true);
//        }
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect()->to('/home');
    }

    public function findOrCreateUser($providerUser, $provider)
    {
        $account = SocialIdentity::whereProviderName($provider)
            ->whereProviderId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }

            $user->identities()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;
        }
    }
}
