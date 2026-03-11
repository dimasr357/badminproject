<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Try to find admin by email
        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && \Hash::check($credentials['password'], $admin->password)) {
            // Store admin info in session
            session([
                'admin_id' => $admin->id,
                'admin_name' => $admin->nama_lengkap,
                'admin_email' => $admin->email,
            ]);

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_name', 'admin_email']);
        $request->session()->flush();

        return redirect('/admin/login');
    }
}
