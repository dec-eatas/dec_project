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

        $follow_list = [
            [ 'name' => 'トーマス・アルバ・エジソン'],
            [ 'name' => 'アルベルト・アインシュタイン'],
            [ 'name' => 'レオナルド・ダ・ヴィンチ'],
            [ 'name' => 'ガリレオ・ガリレイ'],
            [ 'name' => 'サー・アイザック・ニュートン'],
        ];
        
        $follower_list = [
            [ 'name' => 'ヨハン・ゼバスティアン・バッハ'],
            [ 'name' => 'ルードヴィヒ・ヴァン・ベートーヴェン'],
            [ 'name' => 'ヴォルフガング・アマデウス・モーツァルト'],
            [ 'name' => 'フランツ・シューベルト'],
            [ 'name' => 'フレデリック・ショパン'],
        ];

        return view('account.index',compact('user','follow_switch','follow_list','follower_list'));
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
