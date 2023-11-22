<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class LupasPasswordController extends Controller
{
    public function index()
    {
        return view('forgot-password');
    }

    public function getEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return view('get-email', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'confirmed|required'
        ]);

        User::where('email', $request->email)->update([
            'password' => bcrypt($request->password)
        ]);

        Alert::success("Berhasil ganti password, Silahkan login 🚀");
        return redirect('/login');
    }
}
