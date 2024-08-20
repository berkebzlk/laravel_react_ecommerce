<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * fetch and display today, yesterday, this month, this year orders
     */
    public function index()
    {
        // get todays orders
        $todayOrders = Order::whereDay('created_at', Carbon::today())->get();
        $yesterdayOrders = Order::whereDay('created_at', Carbon::yesterday())->get();
        $monthOrders = Order::whereMonth('created_at', Carbon::now()->month)->get();
        $yearOrders = Order::whereYear('created_at', Carbon::now()->year)->get();

        return view('admin.index')->with([
            'todayOrders' => $todayOrders,
            'yesterdayOrders' => $yesterdayOrders,
            'monthOrders' => $monthOrders,
            'yearOrders' => $yearOrders,
        ]);
    }

    /**
     * display login form
     */
    public function login()
    {
        if (!auth()->guard('admin')->check()) {
            return view('admin.login');
        }
        return redirect()->route('admin.index');
    }

    /**
     * auth the admin
     */
    public function auth(AuthAdminRequest $request)
    {
        if ($request->validated()) {
            if (auth()->guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.login')->with([
                    'error' => "These credentials do not match our records"
                ]);
            }
        }
    }

    /**
     * logout the admin
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.index'); 
    }

}
