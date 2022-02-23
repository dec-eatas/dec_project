<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\UseCases\Question\IndexAction;
use App\UseCases\Question\ShowAction;
use App\UseCases\Question\StoreAction;
use App\UseCases\Question\EditAction;
use App\UseCases\Question\UpdateAction;
use App\UseCases\Question\DestroyAction;

class QuestionsController extends Controller
{

    public function index(IndexAction $obj)
    {
        $questions_before = Question::select('questions.*')
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $questions = ListService::shape_questions($questions_before);
        $search_route ='Que.search';
        return view('questions.index', compact('questions','search_route'));
    }

    public function search_title(Request $request)
    {   //urlパラメーターとしてのkeywordが取れる
        $keyword = $request->input('keyword');
        
        //取ってきたデータを一時保存
        $questions_before = Question::where('title', 'LIKE', '%'.$keyword.'%')
            ->orderBy('updated_at', 'DESC')
            ->get();
        
        $questions = ListService::shape_questions($questions_before);
        $search_route ='Que.search';//Que.searchが動く
        return view('questions.index', compact('questions','search_route'));
    }

    public function create()
    {
        return view('questions.create');
    }
    
    public function store(Request $request,StoreAction $obj)
    {
        $question = $request->all();
        Question::insert([
            'title' => $question['title'],
            'content' =>$question['content'],
            'user_id' => 1
        ]);
       
        return redirect( route('Question'));
        //質問がインサートされなかったので、元に戻したよ
        // $question = new Question();
        // $question->title = $request->input('title');
        // return redirect( route('Question'));
        // return redirect( route('Question'));
    }

    public function show(Request $request,ShowAction $obj)
    {    
        //インスタンスの作成（$question）
        //compact('question','que_list')
        $question = Question::find($id);
        $que_list = ListService::shape_question($question);

        $answer = Answer::get_que_answers($id);
        // $answers  = Answer::get_que_answers($id);
        $answers  = ListService::shape_answers($answer);
        $ans_confirm = '';
        return view('questions.show',compact('question','que_list','answers','answer','ans_confirm'));
    }
    
    public function edit(Request $request,EditAction $obj)
    {
        return view('questions.edit',$obj($request));
    }

    public function update(Request $request,UpdateAction $obj)
    {
        return redirect(route('Que.show',$obj($request)));
    }

    public function destroy(Request $request,DestroyAction $obj)
    {
        $obj($request);
        return redirect(route('Que.home'));
    }

}