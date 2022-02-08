<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qestion; // 追加

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = question::latest()->get();

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
}