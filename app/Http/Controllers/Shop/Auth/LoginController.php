<?php

namespace App\Http\Controllers\Shop\Auth;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\ShopCreateRequest;
use App\Models\User;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Show the application login page.
     */
    public function index()
    {
        return view('shop.auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(AdminLoginRequest $request)
    {
        // check credentials
        $user = $this->checkCredentials($request);

        // check user is active
        if ($user && $user->is_active) {

            // login the user
            Auth::login($user);

            // redirect to dashboard
            return to_route('shop.dashboard.index')->withSuccess('Login successfully');
        } elseif ($user && ! $user->is_active) {

            return back()->withError('Your account is not active. Please contact the admin to activate your shop or wait for approval!');
        }

        // redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials is invalid.',
            'password' => 'The provided credentials is invalid.',
        ]);
    }

    /**
     * Check user exists or not and check password.
     */
    private function checkCredentials(AdminLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }

        return false;
    }

    public function create()
    {

        return view('shop.auth.create');
    }

    public function store(ShopCreateRequest $request)
    {

        $shop = ShopRepository::storeByRequest($request);

        $shop->user()->update(['is_active' => false]);

        return to_route('shop.login')->with('successAlert', 'Your account is pending. Please wait for the admin to activate your account!');
    }


    public function create_individual()
    {

        return view('shop.auth.create_individual');
    }

    public function store_individual(Request $request)
    {

        $shop = ShopRepository::storeByRequest($request);

        $shop->user()->update(['is_active' => false]);

        return to_route('shop.login')->with('successAlert', 'Your account is pending. Please wait for the admin to activate your account!');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // logout
        auth()->logout();

        // invalidate session
        $request->session()->invalidate();

        // regenerate session
        $request->session()->regenerateToken();

        $cacheKeys = [
            'admin_all_orders',
            'shop_all_orders',
        ];

        foreach (OrderStatus::cases() as $status) {
            $cacheKeys[] = 'admin_status_'.Str::camel($status->value);
            $cacheKeys[] = 'shop_status_'.Str::camel($status->value);
        }

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        return to_route('shop.login')->withSuccess('Logout successfully');
    }
}
