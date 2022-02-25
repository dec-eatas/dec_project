<style>

    .parent_contents{
        width:100%;padding:0.5em 0 0.5em 0;}
    .parent_tags{
        width:100%;padding:0.3em 0 0.6em;display:flex;border-bottom:lightgrey solid;border-width:0.5px;}

    .list_category{
        font-weight: bold;
    }
    .parent_tag{
        display: inline-block;
        margin: 0 .33em 00 0;
        padding: .4em .6em;
        line-height: 1;
        text-decoration: none;
        color: #222222;
        background-color: #fff;
        border: 1px solid #222;
        border-radius: 2em;
    }
    .parent_tag:before {
        content: "#";
    }
    .list_tag_question{
        display: inline-block;margin: 0 .33em 00 0;padding: .4em .6em;line-height: 1;text-decoration: none;color: royalblue;background-color: #fff;border: 1px solid royalblue;border-radius: 2em;
    }
    .list_tag_answer{
        display: inline-block;margin: 0 .33em 00 0;padding: .6em;line-height: 1;text-decoration: none;color: orangered;background-color: #fff;border: 1px solid orangered;border-radius: 2em;
    }
    .list_tag_article{
        display: inline-block;margin: 0 .33em 00 0;padding: .6em;line-height: 1;text-decoration: none;color: forestgreen;background-color: #fff;border: 1px solid forestgreen;border-radius: 2em;
    }
    .list_tag_reaction{
        display: inline-block;margin: 0 .33em 00 0;padding: .6em;line-height: 1;text-decoration: none;color: mediumvioletred;background-color: #fff;border: 1px solid mediumvioletred;border-radius: 2em;
    }
    .list_tag_question:before {content: "#";}
    .list_tag_answer:before {content: "#";}
    .list_tag_article:before {content: "#";}
    .list_tag_reaction:before {content: "#";}

    .parent_title{
        width:100%;font-weight:bold;font-size:1.5em;padding:0.3em 0 0.3em 0;}
    .parent_content{
        width:100%;padding:1em 0 0.5em 0;}
    .parent_status{
        width:100%;display:flex;font-size:0.8em;align-items:center;
        justify-content:flex-end;padding-bottom:0.5em;}
    #parent_reaction_true{
        width:15%;color:orangered;white-space: nowrap;}
    #parent_reaction_false{
        width:15%;color:#2D2D2D;text-align:right;white-space: nowrap;}
    .parent_comment{
        width:10%;color:green;text-align:right;}
    .parent_datetime{
        width:10%;text-align:right;}
    .type_question{
        color:royalblue;}
    .type_answer{
        color:orangered;}
    .type_article{
        color:forestgreen;}
    .type_reaction{
        color:mediumvioletred}


</style>


<div class="component">

    <div class="parent_contents">
        <div class="list_category">{{ $content['category_name'] }}</div>
        <div class="parent_tags">
            @foreach ($content['tags'] as $tag)
                <div class="list_tag_{{$content['type']}}">
                    <a class="type_{{ $content['type'] }}">{{ $tag['tag_name'] }}</a>
                </div>
            @endforeach
        </div>
        <div class="parent_title">{{ $content['title'] }}</div>
        <div class="parent_content">{!! nl2br($content['content']) !!}</div>
    </div>
    <div class="parent_status">
        @if($parent['model']->users()->where('user_id', Auth::id())->exists())
            <!-- unfavorite ボタン -->
            <form action="{{ route($parent['route'].'.unfavorites',$parent['model']) }}" method="POST">
                @csrf
                <button type="submit" id="parent_reaction_true">
                    ♡ {{ $parent['model']->users()->count() }}
                </button>
            </form>
        @else
            <!-- favorite ボタン -->
            <form action="{{ route($parent['route'].'.favorites',$parent['model']) }}" method="POST">
                @csrf
                <button type="submit" id="parent_reaction_false">
                ♡ {{ $parent['model']->users()->count() }}
                </button>
            </form>
        @endif
        <div class="parent_datetime">{{ $content['diff'] }}</div>
    </div>
    
</div>