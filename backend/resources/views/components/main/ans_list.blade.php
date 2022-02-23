<style>

    .answer_contents{
        width:100%;padding:0.5em 0 0.5em 0;}
    .answer_status{
        width:100%;display:flex;}
    .answer_user{
        }
    .answer_datetime{
        font-size:0.8em;margin-left:auto;text-align:right;}

    .answer_title{
        width:100%;border-bottom:solid lightgray 0.5px;font-weight:bold;font-size:1.5em;padding:0.3em 0 0.3em 0;}
    .answer_content{
        width:100%;padding:1em 0 0.5em 0;}
    .answer_reaction{
        width:100%;display:flex;font-size:0.8em;align-items:center;
        justify-content:flex-end;padding-bottom:0.5em;}
    .answer_favorite{
        width:10%;color:orangered;text-align:right;}
    .answer_comment{
        width:10%;color:green;text-align:right;}


</style>
<?php  $i=0;?>
@foreach ($contents as $content)
<div class="component">
    <div class="answer_contents">
        <div class="answer_status">
            <div class="answer_user"><a>{{ $content['user_name'] }}</a></div>
            <div class="answer_datetime">{{ $content['diff'] }}</div>
        </div>
        <div class="answer_content">{!! nl2br($content['title']) !!}</div>
    </div>
    <div class="answer_reaction">
        <!-- ↓追加 -->
                    <!-- favorite 状態で条件分岐 以下は、モデルインスタンス-->
                    @if($answer[$i]->users()->where('user_id', Auth::id())->exists())
                    <!-- unfavorite ボタン -->
                    <form action="{{ route('ans.unfavorites',$answer[$i]) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $answer[$i++]->users()->count() }}
                        
                      </button>
                    </form>
                    @else
                    <!-- favorite ボタン -->
                    <form action="{{ route('ans.favorites',$answer[$i]) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $answer[$i]->users()->count() }}
                      </button>
                    </form>
                    @endif
        <div class="answer_favorite">♡ ∞</div>
        <div class="answer_comment">💬 ∞</div>

    </div>
</div>
@endforeach

{{-- <div class="component">
    <div class="answer_contents">
        <div class="answer_datetime">{{ $contents['updated_at'] }}</div>
        <div class="answer_content">{{ $contents['content'] }}</div>
    </div>
    <div class="answer_status">
        <div class="answer_reaction">♡ ∞</div>
        <div class="answer_comment">💬 ∞</div>
    </div>
</div> --}}
