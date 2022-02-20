<?php

namespace App\Services;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TimeService
{

    public static function get_now($time_zone='Asia/Tokyo')
    {

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone($time_zone));

        return $now;

    }

    public static function get_difference($timestamp,$time_zone='Asia/Tokyo')
    {

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone($time_zone));

        $diff = $now->diff($timestamp);
        $diff_split = explode('/',$diff->format('Y/m/d/H/m/s'));
        $datetime = [
            'year' => $diff_split[0],
            'month' => $diff_split[1],
            'day' => $diff_split[2],
            'hour' => $diff_split[3],
            'min' => $diff_split[4],
            'sec' => $diff_split[5],
        ];

        return $datetime;

    }

    public static function get_elapse($timestamp,$time_zone='Asia/Tokyo')
    {
        $past = new Datetime($timestamp);
        $past->setTimezone(new DateTimeZone($time_zone));
        $past = $past->modify('-9 hour');
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone($time_zone));

        $diff = $now->diff($past);

        $diff_split = [$diff->y,$diff->m,$diff->d,$diff->h,$diff->i,$diff->s];

        $unit = ['year','month','day','hour','min','sec'];
        $exp = ['年前','ヶ月前','日前','時間前','分前','秒前'];

        for($i=0; $i<6; $i++){
            
            if((int)$diff_split[$i] == 0) continue;

            if($i == 2){
                $week = 0;
                $cnt = 7;
                $work = $diff_split[$i];
                while( $work-$cnt > 0 ){
                    $week++;
                    $cnt+=7;
                }
                if($week > 0){
                    return [
                        'unit' => 'week',
                        'exp' => '週間前',
                        'diff' => $week,
                    ];
                }
            }

            return [
                'unit' => $unit[$i],
                'exp' => $exp[$i],
                'diff' => $diff_split[$i],
            ];

        }

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

