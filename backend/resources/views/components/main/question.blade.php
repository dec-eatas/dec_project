<style>

    .question_datetime{
        width:100%;font-size:0.8em;text-align:right;}
    .question_contents{
        width:100%;padding:0.5em 0 0.5em 0;}
    .question_title{
        width:100%;border-bottom:solid lightgray 0.5px;font-weight:bold;font-size:1.5em;padding:0.3em 0 0.3em 0;}
    .question_content{
        width:100%;padding:1em 0 0.5em 0;}
    .question_status{
        width:100%;display:flex;font-size:0.8em;align-items:center;
        justify-content:flex-end;padding-bottom:0.5em;}
    #question_reaction_true{
        width:15%;color:orangered;white-space: nowrap;}
    #question_reaction_false{
        width:15%;color:#AAA;text-align:right;white-space: nowrap;}
    .question_comment{
        width:10%;color:green;text-align:right;}

</style>


<div class="component">

    <div class="question_contents">
        <div class="question_datetime">{{ $content['diff'] }}</div>
        <div class="question_title">{{ $content['title'] }}</div>
        <div class="question_content">{{ $content['content'] }}</div>
    </div>
    <div class="question_status">
        <!-- ↓追加 -->
        <!-- favorite 状態で条件分岐 以下は、モデルインスタンス-->
        @if($question->users()->where('user_id', Auth::id())->exists())
        <!-- unfavorite ボタン -->
        <form action="{{ route('que.unfavorites',$question) }}" method="POST">
          @csrf
          <button type="submit" id="question_reaction_true">
            ♡ {{ $question->users()->count() }}
          </button>
        </form>
        @else
        <!-- favorite ボタン -->
        <form action="{{ route('que.favorites',$question) }}" method="POST">
          @csrf
            <button type="submit" id="question_reaction_false">
              ♡ {{ $question->users()->count() }}
            </button>
          </button>
        </form>
        @endif
    </div>
    
</div>