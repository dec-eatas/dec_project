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

@if(!is_null($contents))

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
            @if($child['model'][$i]->users()->where('user_id', Auth::id())->exists())
            <!-- unfavorite ボタン -->
                <form action="{{ route($child['route'].'.unfavorites',$child['model'][$i]) }}" method="POST">
                    @csrf
                    <button type="submit" id="question_reaction_true">
                        ♡ {{ $child['model'][$i++]->users()->count() }}
                    </button>
                </form>
            @else
            <!-- favorite ボタン -->
                <form action="{{ route($child['route'].'.favorites',$child['model'][$i]) }}" method="POST">
                    @csrf
                    <button type="submit" id="question_reaction_false">
                    ♡ {{ $child['model'][$i++]->users()->count() }}
                    </button>
                </form>
            @endif
        </div>
    </div>
    @endforeach
@endif