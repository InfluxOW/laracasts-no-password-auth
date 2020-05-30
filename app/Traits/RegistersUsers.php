<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait RegistersUser
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validatedData = $this->validator($request->all())->validate();

        $this->create($validatedData);

        return redirect()->route('login');
    }
}
