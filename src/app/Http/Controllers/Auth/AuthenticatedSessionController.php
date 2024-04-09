<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // dd($request->all());
        $request->authenticate();

        $request->session()->regenerate();
        $role = Auth::user()->roles->pluck('name')->implode(', ');
        // dd($role, Auth::user());

        if ($role == "Супер администратор") {

            return redirect()->intended(RouteServiceProvider::HOME);
        } elseif ($role == "Отдел кадров") {

            return redirect('/staf-list');
        } elseif ($role == "Бугалтер") {

            return redirect('/salary-list');
        } elseif ($role == "Отдел продаж") {

            return redirect('/applications-list');
        } elseif ($role == "Производитель") {

            return redirect('/order-app');
        } elseif ($role == "Менеджер склада") {

            return redirect('/product-stoks-list');
        } elseif ($role == "Машинист") {

            return redirect('/product-production-order-list');
        } elseif ($role == "Курьер") {

            return redirect('/staf-list');
        } elseif ($role == "Производитель") {

            return redirect('/order-app');
        } elseif ($role == "Механик") {

            return redirect('/product-production-order-list');
        } else {
            return redirect('/staf-list');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
