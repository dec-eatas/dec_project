<?php

namespace App\Services;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public static function func(){


    }

    public function index(Request $request)
    {
        // $todos = $this->todoRepository->all();
        // $sort = $request->input('sort');
        // $todos = $this->todoRepository->search($sort);

        // return view('todos.index')
        //     ->with('todos', $todos);
        // return view('todos.index', compact('sort', 'todos'));
    
        $questions = Qurstion::all();
        return view('question/index')->conpact('questions');
  
    
    }

}


class SearchController extends Controller
{
    // 省略
    public function index(Request $request)
    {
        $todos = $this->todoRepository->all();
        $sort = $request->input('sort');
        $todos = $this->todoRepository->search($sort);

        return view('todos.index')
            ->with('todos', $todos);
        return view('todos.index', compact('sort', 'todos'));
    }

    /**
     * Display a listing of the Todo.
     *
     * @param Request $request
     *
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     $todos = $this->todoRepository->all();
    //     $sort = $request->input('sort');
    //     $todos = $this->todoRepository->search($sort);

    //     return view('todos.index')
    //         ->with('todos', $todos);
    //     return view('todos.index', compact('sort', 'todos'));
    // }

    // // 省略
}

?>