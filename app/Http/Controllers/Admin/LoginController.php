<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        $title = 'Admin Login';
        return view('admin.auth.login', compact('title'));
    }

    /**
     * Get the guard to be used during authentication.
     * @return  Guard|StatefulGuard
     */
    public function guard(): Guard|StatefulGuard
    {
        return Auth::guard('admin');
    }

    /**
     * Get the login username to be used by the controller.
     * @return string
     */
    public function username(): string
    {
        return 'username';
    }

    /**
     * Where to redirect users after login.
     * @return Redirector|Application|RedirectResponse
     */
    protected string $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(Request $request): Redirector|RedirectResponse|Application
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }

}
