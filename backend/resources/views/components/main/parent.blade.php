<style>

    .parent_contents{
        width:100%;padding:0.5em 0 0.5em 0;}
    .parent_tags{
        width:100%;padding:0.3em 0;display:flex;border-bottom:lightgrey solid;border-width:0.5px;}
    .parent_tag{
        width:20%;font-size:0.8em;}
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

</style>


<div class="component">

    <div class="parent_contents">
        <div class="parent_tags">
            @foreach ($content['tags'] as $tag)
                <div class="parent_tag"><a>{{ $tag['tag_name'] }}</a></div>
            @endforeach
        </div>
        <div class="parent_title">{{ $content['title'] }}</div>
        <div class="parent_content">{{ $content['content'] }}</div>
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
        <div class="parent_comment">💬 ∞</div>
         <div class="parent_datetime">{{ $content['diff'] }}</div>
    </div>
    
</div>