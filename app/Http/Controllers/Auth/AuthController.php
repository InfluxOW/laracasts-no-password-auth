<?php

namespace App\Http\Controllers\Auth;

use App\LoginToken;
use App\Helpers\AuthenticatesUser;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * @var AuthenticatesUser
     */
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @param AuthenticatesUser $auth
     */
    public function __construct(AuthenticatesUser $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Show the login page.
     *
     * @return Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle the login form submission.
     *
     * @return string
     */
    public function postLogin()
    {
        $this->auth->invite();

        flash('Check your email')->success()->important();

        return back();
    }

    /**
     * Login the user, using the given token.
     *
     * @param  LoginToken $token
     * @return string
     */
    public function authenticate(LoginToken $token)
    {
        $this->auth->login($token);

        return redirect()->home();
    }

    /**
     * Log out the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->route('welcome');
    }
}
