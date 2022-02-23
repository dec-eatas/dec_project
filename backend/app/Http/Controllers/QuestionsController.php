<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ListService;
use PhpParser\Node\Expr\List_;

class QuestionsController extends Controller
{
    // ⬇︎質問一覧画面の表示
    public function index()
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


    
    //⬇︎質問の作成(view)
    public function create()
    {
        return view('questions.create');
    }



    // 質問をDBに追加(DB)
    public function store(Request $request)
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



    // ⬇︎質問詳細画面の表示
    public function show($id)
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
    
    public function edit($id)
    {

        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_question = Question::find($id);

        return view('questions.edit', compact('questions', 'edit_question'));
    }



    // ⬇︎質問を編集した内容をDBに保存(DB)
    public function update(Request $request)
    {
        $posts = $request->all();
        // dd($posts);

        Question::where('id',$posts['question_id'])
            ->update([
                'content' => $posts['content'],
                'title' => $posts['title']
            ]);

        return redirect( route('Que.home'));

    }



    public function destroy(Request $request)
    {

        $posts = $request->all();

        Question::where('id',$posts['question_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('Que.home'));

    }

}