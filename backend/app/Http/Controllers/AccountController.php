<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
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
