<?php


namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Tag;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;

class QuestionRepository implements RepositoryInterface {

    public function all()
    {
        $questions = Question::join('users','questions.user_id','=','users.id')
            ->join('categories','questions.category_id','categories.id')
            ->select('questions.*','users.name as user_name','categories.name as category_name')
            ->get();

        $tags = [];

        foreach($questions as $question){
            $tag = QuestionTag::join('tags','question_tags.tag_id','=','tags.id')
                ->select('question_tags.tag_id','tags.name as tag_name')
                ->where('question_tags.question_id','=',$question->id)
                ->get();
            $tags[count($tags)] = $tag->toArray();
        }

        return [
            'model' => $questions,
            'tags' => $tags
        ];
    }

    public function find(int $question_id):array
    {
   
        $question = Question::join('users','questions.user_id','=','users.id')
            ->join('categories','questions.category_id','categories.id')
            ->select('questions.*','users.name as user_name','categories.name as category_name')
            ->where('questions.id','=',$question_id)
            ->first();

        $tags = QuestionTag::join('tags','question_tags.tag_id','=','tags.id')
            ->select('question_tags.tag_id','tags.name as tag_name')
            ->where('question_tags.question_id','=',$question_id)
            ->get();

        return [
            'model' => $question,
            'tags' => $tags
        ];
    }

    public function searchByTitle(String $keyword):array
    {
     
        $questions = Question::join('users','questions.user_id','=','users.id')
            ->join('categories','questions.category_id','categories.id')
            ->select('questions.*','users.name as user_name','categories.name as category_name')
            ->where('title', 'LIKE', '%'.$keyword.'%')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $tags = [];

        foreach($questions as $question){
            $tag = QuestionTag::join('tags','question_tags.tag_id','=','tags.id')
                ->select('question_tags.tag_id','tags.name as tag_name')
                ->where('question_tags.question_id','=',$question->id)
                ->get();
            $tags[count($tags)] = [
                'question_id' => $question->id,
                'tags' => $tag->toArray()
            ];
        }

        return [
            'model' => $questions,
            'tags' => $tags
        ];
    }

    public function hyperSearch(array $search_material):array
    {

        $question_tags = [];
     
        foreach($search_material['tags'] as $tag){
            $tags = Tag::select('id')
                ->where('id','LIKE',$tag)
                ->get();
            foreach($tags as $tag){
                $question_tags[count($question_tags)] = $tag->id;
            }
        }

        $question_tag = QuestionTag::select('question_id')
            ->whereIn('tag_id',$question_tags)
            ->groupBy('question_id')
            ->get()->toArray();

        $question_ids = [];

        foreach($question_tag as $tag_id){
            $question_ids[count($question_ids)] = $tag_id['question_id'];
        }

        $questions = Question::join('users','questions.user_id','=','users.id')
            ->join('categories','questions.category_id','categories.id')
            ->select('questions.*','users.name as user_name','categories.name as category_name')
            ->whereIn('questions.id',$question_ids)
            ->whereIn('questions.category_id',$search_material['category_id'])
            ->orderBy('questions.updated_at', 'DESC')
            ->get();
            
        $tags = [];

        foreach($questions as $question){
            $tag = QuestionTag::join('tags','question_tags.tag_id','=','tags.id')
                ->select('question_tags.tag_id','tags.name as tag_name')
                ->where('question_tags.question_id','=',$question->id)
                ->get();
            $tags[count($tags)] = $tag->toArray();
        }

        return [
            'model' => $questions,
            'tags' => $tags
        ];
    }

    public function getByUser(int $user_id):array
    {
        $questions = Question::join('users','questions.user_id','=','users.id')
        ->join('categories','questions.category_id','categories.id')
        ->select('questions.*','users.name as user_name','categories.name as category_name')
        ->where('questions.user_id','=',$user_id)
        ->get();

        $tags = [];

        foreach($questions as $question){
            $tag = QuestionTag::join('tags','question_tags.tag_id','=','tags.id')
                ->select('question_tags.tag_id','tags.name as tag_name')
                ->where('question_tags.question_id','=',$question->id)
                ->get();
            $tags[count($tags)] = $tag->toArray();
        }

        return [
            'model' => $questions,
            'tags' => $tags
        ];
    }

    public function store(array $data):Question
    {    
        return DB::transaction(function() use($data){

            $question = Question::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'user_id' => Auth::id(),
                'category_id' => $data['category_id'],
            ]);

            $tags = [];

            foreach($data['tags'] as $tag){
                
                if(mb_strlen($tag) > 0){
                    try{
                        $tags[count($tags)] = Tag::create([
                            'name' => $tag
                        ]); 
                    }catch(QueryException $e){
                        $error_code = $e->errorInfo[1];
                        if($error_code == 1062){
                            $tags[count($tags)] = Tag::where('name','=',$tag)->first();
                        }else{
                            throw new Exception ;
                        }
                    }
                }
            }

            $question_tags = [];

            for($i=0; $i<count($tags); $i++){
                $question_tags[$i] = QuestionTag::create([
                    'question_id' => $question->id,
                    'tag_id' => $tags[$i]->id
                ]);
            }

            return $question;

        });
    }

    public function update(int $question_id,array $data):Integer
    {
        return Question::find($question_id)
            ->update($data);
    }

    public function delete(int $question_id)
    {
        Question::destroy($question_id);
    }

}