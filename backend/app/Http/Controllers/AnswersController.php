<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Answer\ConfirmAction;
use App\UseCases\Answer\BackAction;
use App\UseCases\Answer\StoreAction;

class AnswersController extends Controller
{

    public function confirm(Request $request,ConfirmAction $obj)
    {
        return view('answer.confirm',$obj($request));
    }

    public function back(Request $request,BackAction $obj)
    {
        return redirect(route('Que.show',$obj($request)));
    }

    public function store(Request $request,StoreAction $obj)
    {
        return redirect(route('Que.show',$obj($request)));
    }

}

