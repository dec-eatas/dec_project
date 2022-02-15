<style>

    .list_status{
        width:100%;border-bottom:solid lightgray 0.5px;display:flex;font-size:0.8em;align-items:center;
        padding-bottom: 0.5em;}
    .list_category{
        width:15%;font-weight:bold;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    .list_tags{
        width:60%;display:flex;}
    .list_tag{
        width:20%;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    .list_reaction{
        width:8%;color:orangered;}
    .list_comment{
        width:8%;color:green;}
    .list_datetime{
        width:9%;text-align:right;}
    .list_content{
        width:100%;display:flex;padding:1em 0 0.5em 0;}
    .list_type{
        width:10%;font-weight:bold;}
    .type_question{
        color:royalblue}
    .list_title{
        width:90%;}

</style>



<div class="component">
    <div class="list_status">
        <div class="list_category">{{ $category ?? 'カテゴリー' }}</div>
        <div class="list_tags">
            @foreach($tags ?? ['タグ1あああああいいいい','2','3','4','5'] as $tag)
                <div class="list_tag">
                    <a>{{ $tag }}</a>
                </div>
            @endforeach
        </div>
        <div class="list_reaction">♡ {{ $reaction ?? '∞' }}</div>
        <div class="list_comment">💬 {{ $comment ?? '∞' }}</div>
        <div class="list_datetime">{{ $datetime ?? '2022/02/15' }}</div>
    </div>
    <div class="list_content">
        <div class="list_type type_{{ $type ?? 'Question' }}">{{ $type ?? 'Question' }}</div>
        <div class="list_title">{{ $title ?? 'これは質問のタイトルです。' }}</div>
    </div>
</div>