<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class AnswersController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'body' => 'required|max:300',
        ]);

        $question = Question::findOrFail($params['question_id']);
        $question->comments()->create($params);

        return redirect()->route('questions.show', ['question' => $question]);
    }
}
