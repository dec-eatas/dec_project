<?php

namespace App\Services;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Services\TimeService;
//コントローラーに処理を
class ListService
{
    /* questions */
    public static function shape_questions($records){

        $contents = [];

        foreach($records as $record){

            $time_ex = TimeService::get_elapse($record['updated_at']->format('Y-m-d h:m:s'));

            $content = [
                'id' => $record['id'],
                'user' => $record['user_id'],
                'type' => 'Question',
                'title' => $record['title'],
                // 'category' => 'カテゴリ名',
                // 'tags' => ['タグ1','タグ2','タグ3','タグ4','タグ5'],
                // 'reaction' => $record[''],
                // 'comment' => '回答やコメントの数',
                'updated_at' => $record['updated_at'],
                'diff' => $time_ex['diff'].$time_ex['exp'], 
                'route' => 'Que.show',
                'route_param' => ['id' => $record['id']]
            ];

            $contents[count($contents)] = $content;

        }

        return $contents;

    }

    public static function shape_question($record){

        if(is_null($record)) {

            $time_ex = TimeService::get_elapse($record['updated_at']->format('Y-m-d h:m:s'));

            $content = [
                'id' => $record['id'],
                'user' => $record['user_id'],
                'type' => 'Question',
                'title' => $record['title'],
                // 'category' => 'カテゴリ名',
                // 'tags' => ['タグ1','タグ2','タグ3','タグ4','タグ5'],
                'content' => $record['content'],
                // 'reaction' => $record[''],
                // 'comment' => '回答やコメントの数',
                'updated_at' => $record['updated_at'],
                'diff' => $time_ex['diff'].$time_ex['exp'], 
            ];    

        }else{

            $time_ex = TimeService::get_elapse($record['updated_at']->format('Y-m-d h:m:s'));

            $content = [
                'id' => $record['id'],
                'user' => $record['user_id'],
                'type' => 'Question',
                'title' => $record['title'],
                // 'category' => 'カテゴリ名',
                // 'tags' => ['タグ1','タグ2','タグ3','タグ4','タグ5'],
                'content' => $record['content'],
                // 'reaction' => $record[''],
                // 'comment' => '回答やコメントの数',
                'updated_at' => $record['updated_at'],
                'diff' => $time_ex['diff'].$time_ex['exp'], 
            ];    

        }


        return $content;

    }

    public static function shape_answers($records){

        $contents = [];

        foreach($records as $record){

            $time_ex = TimeService::get_elapse($record['updated_at']->format('Y-m-d h:m:s'));

            $content = [
                'id' => $record['id'],
                'user' => $record['user_id'],
                'user_name' => $record['user_name'],
                'type' => 'Answer',
                'title' => $record['content'],
                // 'category' => 'カテゴリ名',
                // 'tags' => ['タグ1','タグ2','タグ3','タグ4','タグ5'],
                // 'reaction' => $record[''],
                // 'comment' => '回答やコメントの数',
                'updated_at' => $record['updated_at'],
                'diff' => $time_ex['diff'].$time_ex['exp'], 
                'route' => 'Que.show',
                'route_param' => ['id' => $record['question_id']]
            ];

            $contents[count($contents)] = $content;

        }

        return $contents;

    }

    public static function shape_show_answers($records){

        $contents = [];

        foreach($records as $record){

            $time_ex = TimeService::get_elapse($record['updated_at']->format('Y-m-d h:m:s'));

            $content = [
                'id' => $record['id'],
                'user' => $record['user_id'],
                'user_name' => $record['name'],
                'title' => $record['content'],
                // 'reaction' => $record[''],
                // 'comment' => '回答やコメントの数',
                'updated_at' => $record['updated_at'],
                'diff' => $time_ex['diff'].$time_ex['exp'], 
                'route' => 'Que.show',
                'route_param' => ['id' => $record['question_id']]
            ];

            $contents[count($contents)] = $content;

        }

        return $contents;

    }

}

/* 


    $table->unsignedBigInteger('id', true);
    $table->unsignedBigInteger('user_id');
    $table->string('title',100);
    $table->longText('content');
    // timestampと書いてしまうと、レコード挿入時、更新時に値が入らないので、DB::rawで直接書いてます
    $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
    $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    // 論理削除を定義→deleted_atを自動生成
    $table->softDeletes();
    // 外部キー制約 user_idはusersテーブルのidが存在するものしか入らない
    $table->foreign('user_id')->references('id')->on('users');
    
    $contents = [
        [
            'type' => 'レコードのタイプ',
            'title' => 'タイトル(もしくは本文)',
            'category' => 'カテゴリ名',
            'tags' => ['タグ１','タグ2','タグ3','タグ4','タグ5'],
            'reaction' => '反応の数',
            'comment' => '回答やコメントの数',
            'datetime' => 'レコード作成日時',
        ], 
    ];
    
*/
    

?>

