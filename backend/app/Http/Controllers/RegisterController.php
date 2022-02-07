<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class RegisterController extends Controller
{
    public function create()
    {
        return view('regist.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|',
            'password' => 'required|string|confirmed|min:8|', 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return view('regist.complete',compact('user'));

    }

    public function read()
    {
        $models = [
            new Movie(),
            new User()
        ];

        $datas = [];

        foreach($models as $model){
            $datas[count($datas)] = [
                'table' => $model->getTable(), //テーブル名取得
                'coulmn' => Schema::getColumnListing($model->getTable()), //列名取得
                'type' => $model->getCoulmnType(),
                'cnt' => $model->getCount(),
                'items' => $model->getRecent(),
            ];
        }

        return view('database.read')->with(['datas' => $datas]);

    }

}
