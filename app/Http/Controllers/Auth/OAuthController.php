<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Collective\Annotations\Routing\Annotations\Annotations\Get;
use Collective\Annotations\Routing\Annotations\Annotations\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Session;


class OAuthController extends Controller
{
    protected $socialite;
    protected $auth;

    public function __construct(Socialite $socialite, Guard $auth)
    {
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\RedirectResponse
     * @Middleware("web")
     * @Get("/auth/{provider}")
     */
    public function authenticate(Request $request, $provider)
    {
        return $this->execute(($request->has('code') || $request->has('oauth_token')), $provider);
    }

    public function execute($request, $provider)
    {
        if (!$request) {
            return $this->getAuthorizationFirst($provider);
        }

        $user = $this->findByProviderIdOrCreate($this->getSocialUser($provider), $provider);
        $this->auth->loginUsingId($user->id);

        return redirect('/profile');
    }

    /**
     * Redirect the user to the Social Media Account authentication page
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getAuthorizationFirst($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * Find a user by username or create a new user
     * @param
     * @return
     */
    public function findByProviderIdOrCreate($userData, $provider)
    {
        $user = User::where('provider_id', '=', $userData->id)->first();

        Session::put('provider', $provider);

        $email = $this->isEmailExists($userData->getEmail()) ? null : $userData->getEmail();

        $username = $this->isUsernameExists($userData->getNickName()) ? null : $userData->getNickName();

        $tokenSecret = property_exists($userData, "tokenSecret") ? $userData->tokenSecret : null;

        if (empty($user)) {

            $user = User::create([
                'fullname' => $userData->getName(),
                'username' => $username,
                'provider_id' => $userData->getId(),
                'avatar' => $userData->getAvatar(),
                'email' => $email,
                'provider' => $provider,
                'oauth_token' => $userData->token,
                'oauth_token_secret' => $tokenSecret
            ]);

            Session::put('provider', $provider);
        }

        return $user;
    }

    private function isEmailExists($email = null)
    {
        $email = User::whereEmail($email)->first()['email'];

        return (!is_null($email)) ? true : false;
    }

    private function isUsernameExists($username = null)
    {
        $username = User::whereUsername($username)->first()['username'];

        return (!is_null($username)) ? true : false;
    }

    /**
     * Get Data from Social Media Account
     * @param  string $provider
     * @return collection
     */
    private function getSocialUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }

    /**
     * Check if the user's info needs updating
     * @param
     * @return
     */
    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [
            'avatar' => $userData->getAvatar(),
            'fullname' => $userData->getName(),
            'username' => $userData->getNickName(),
        ];

        $dbData = [
            'avatar' => $user->avatar,
            'fullname' => $user->fullname,
            'username' => $user->username,
        ];

        if (!empty(array_diff($dbData, $socialData))) {
            $user->avatar = $userData->getAvatar();
            $user->fullname = $userData->getName();
            $user->username = $userData->getNickName();
            $user->save();
        }
    }

}
