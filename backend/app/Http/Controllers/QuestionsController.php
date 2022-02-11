<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qestion; // 追加

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = question::latest()->get();
        $questions = question::latest()->paginate(10);
        $questions = question::with(['answers'])->latest()->paginate(10);

        return view('questions.index', ['questions' => $questions]);
    }
    
//追加した
public function create()
{
    return view('questions.create');
}
public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max: 800',
        ]);

        Question::create($params);

        return redirect()->route('questions.index');
    }

    public function show($question_id)
    {
        $question = Question::findOrFail($question_id);

        return view('questions.show',[
            'question' => $question,
        ]);
    }

    public function edit($question_id)
    {
        $question = Topic::findOrFail($question_id);

        return view('questions.edit',[
            'question' => $question,
        ]);
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