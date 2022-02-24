<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Account\IndexAction;
use App\UseCases\Account\HomeAction;


class AccountController extends Controller
{
    public function index(Request $request,IndexAction $obj)
    {
        return view('account.index',$obj($request));
    }

    public function home(Request $request,HomeAction $obj)
    {
        return view('common.home',$obj($request));
    }

}
