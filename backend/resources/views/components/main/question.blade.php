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
    .question_reaction{
        width:10%;color:orangered;text-align:right;}
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
                    <form action="{{ route('que.unfavorites',$question) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $question->users()->count() }}
                        
                      </button>
                    </form>
                    @else
                    <!-- favorite ボタン -->
                    <form action="{{ route('que.favorites',$question) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $question->users()->count() }}
                      </button>
                    </form>
                    @endif
        <div class="question_reaction">♡ ∞</div>
        <div class="question_comment">💬 ∞</div>
    </div>
    
</div>