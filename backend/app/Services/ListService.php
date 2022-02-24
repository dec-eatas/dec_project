<?php

namespace App\Services;
use App\Services\TimeService;


class ListService
{    

    public static function shape_index($records,$route,$route_param,$tag_route){

        $model = $records['model'];
        $tags = $records['tags'];
    
        $model->map(function($v)use($route,$route_param,$tag_route){
         
            if( !isset($v['title']) ){
                $v['title'] = $v['content'];
                unset($v['content']);
            }

            $time_ex = TimeService::get_elapse($v['updated_at']->format('Y-m-d h:m:s'));
            $v['type'] = str_replace('App\Models\\','',get_class($v));
            $v['route'] = $route;
            $v['diff'] = $time_ex['diff'].$time_ex['exp'];
            $v['route_param'] = $route_param;
            $v['tags'] = '';
            $v['tag_route'] = $tag_route;
            $v['reaction'] = $v->users()->count();
    
            return $v->toArray();
        });

        $model = $model->toArray();
        
        for($i=0; $i<count($model); $i++){
            $model[$i]['tags'] = $tags[$i];
        }

        return $model;
    }

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

    public static function shape_show($record){

        $model = $record['model'];
        $tags = $record['tags'];

        $time_ex = TimeService::get_elapse($model['updated_at']->format('Y-m-d h:m:s'));

        $status = [
            'type' => str_replace('App\Models\\','',get_class($model)),
            'diff' => $time_ex['diff'].$time_ex['exp'],
            'tags' => $tags->toArray()
        ];

        return array_merge($model->toArray(),$status);

    }

    public static function shape_question($record){

        if(!is_null($record)) {

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

    public static function shape_primitive($records,$route,$route_param,$tag_route){
        $model = $records['model'];
        $tags = $records['tags'];
    
        $model->map(function($v)use($route,$route_param,$tag_route){
         
            if( !isset($v['title']) ){
                $v['title'] = $v['content'];
                unset($v['content']);
            }

            $time_ex = TimeService::get_elapse($v['updated_at']->format('Y-m-d h:m:s'));
            $v['type'] = str_replace('App\Models\\','',get_class($v));
            $v['route'] = $route;
            $v['diff'] = $time_ex['diff'].$time_ex['exp'];
            $v['route_param'] = $route_param;
            $v['tags'] = '';
            $v['tag_route'] = $tag_route;
            $v['reaqtion'] = $v->users()->count();
    
            return $v;
        });
        
        for($i=0; $i<count($model); $i++){
            $model[$i]['tags'] = $tags[$i];
        }

        return $model;
    }

    public static function fusion_list($fusions){

        $fusion = $fusions['que']->union($fusions['art'])->sortByDesc('updated_at');

        return $fusion;
    }

    public static function shape_article($record){

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

    public static function category_opt($categorys){

        $contents = [];

        foreach($categorys as $category){

            $contents[count($contents)] = [
                'value' => $category->id,
                'l_name' => $category->name,
            ];

        }

        return $contents;

    }
}

?>

