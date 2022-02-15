<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        {{  }}
        return view('questions.index', compact('questions'));
    }



//追加した
public function create()
{
    return view('questions.create');
}




public function store(Request $request)
    {
        // $params = $request->validate([
        //     'title' => 'required|max:50',
        //     'content' => 'required|max:800',
        // ]);

        // Question::create($params);

        // return redirect()->route('questions.index');
    // サイトから変更
        $question = $request->all();
        Question::insert([
            'user_id' => \Auth::id(),
            'title' => '\''.$question['title'].'\'',
            'content' =>'\''.$question['content'].'\''
        ]);
    return redirect( route('create'));

    }




    public function show($question_id)
    {
        $question = Question::findOrFail($question_id);

        return view('questions.show',[
            'question' => $question,
        ]);
    }



    public function edit($id)
    {
        // $question = Question::findOrFail($question_id);
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_question = Question::find($id);

        return view('questions.edit', compact('questions', 'edit_question'));
    }



    public function update($question_id, Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:800',
        ]);

        $question = question::findOrFail($question_id);
        $question->fill($params)->save();

        return redirect()->route('questions.show', ['question' => $question]);
    }



    public function destroy($question_id)
    {
        $question = Question::findOrFail($question_id);

        $question->delete();

        return redirect()->route('questions.index');
    }

    
}