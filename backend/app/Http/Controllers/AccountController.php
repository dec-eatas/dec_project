<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $follow_switch = 0;
        return view('account.index',compact('user','follow_switch'));
    }

    public function detail()
    {
        return view('account.detail');
    }

    public function edit()
    {
        return view('account.edit');
    }
}
