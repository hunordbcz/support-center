<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function loginAs(User $user)
    {
        Auth::login($user);
        return back()->withStatus('Logged in as ' . $user->name);
    }
}
