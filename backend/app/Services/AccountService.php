<?php

namespace App\Services;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AccountService
{

    public static function get_base_list($tables){

        $models = [];
        foreach($tables as $table){
            $models[count($models)] = app()->make($table);
        }
   
        $datas = [];

        foreach($models as $model){
            $get_table = $model->getTable();
            $datas[count($datas)] = [
                'table' => $get_table, //テーブル名取得
                'coulmn' => Schema::getColumnListing($get_table), //列名取得
                'cnt' => DB::table($get_table)->count(),
                'items' => DB::table($get_table)->orderBy('updated_at','desc')->take(5)->get(),
            ];
        }

        return $datas;

    }

    public static function get_table_list($table)
    {

        $model = app()->make($table);
        $key = $model->getKeyName();
        $get_table = $model->getTable();
        $data = [
            'table' => $get_table, //テーブル名取得
            'column' => Schema::getColumnListing($get_table), //列名取得
            'cnt' => DB::table($get_table)->count(),
            'items' => DB::table($get_table)->orderBy($key)->get(),
        ];
     

        for($i=0; $i<count($data['column']); $i++){
            if($key === $data['column'][$i]){
                $data['column'][$i] = $data['column'][0];
                $data['column'][0] = $key;
            }
        }

        return $data;
    }

    public static function get_record($table,$id)
    {
        $model = app()->make($table);

        $key = $model->getKeyName();
        $data = [
            'table' => $table, //テーブル名取得
            'column' => Schema::getColumnListing($table), //列名取得
            'items' => $model->find($id),
        ];
     

        for($i=0; $i<count($data['column']); $i++){
            if($key === $data['column'][$i]){
                $data['column'][$i] = $data['column'][0];
                $data['column'][0] = $key;
            }
        }

        return $data;

    }

    
    public static function insert_record($table,$data)
    {

        $model = app()->make($table);
        $model->create($data);

        return;
    }

    public static function edit_record($table,$id,$data)
    {

        $model = app()->make($table);
        $model->where('id','=',$id)->update($data);

        return;
    }


    public static function delete_record($table,$id)
    {
        $model = app()->make($table);
        $model->where('id','=',$id)->delete();

        return;
    }


}

?>