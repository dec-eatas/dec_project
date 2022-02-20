<style>

    .question_tags{
        width:100%;border-bottom:solid lightgray 0.5px;display:flex;font-size:0.8em;align-items:center;
        padding-bottom: 0.5em;}
    .question_tag{
        width:20%;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    .question_contents{
        width:100%;padding:1em 0 0.5em 0;}
    .question_title{
        width:100%;font-weight:bold;font-size:1.5em;padding:0 0 0.5em 0;}
    .question_datetime{
        width:100%;font-size:0.8em;}
    .question_content{
        width:100%;padding:1em 0 0.5em 0;}
    .question_status{
        width:100%;display:flex;font-size:0.8em;align-items:center;
        justify-content: flex-end;padding-bottom: 0.5em;}
    .question_reaction{
        width:10%;color:orangered;text-align:right;}
    .question_comment{
        width:10%;color:green;text-align:right;}


</style>


<div class="component">

    <div class="question_tags">
        @foreach(['タグ1','タグ2','タグ3','タグ4','タグ5'] as $tag)
            <div class="question_tag">
                <a>{{ $tag }}</a>
            </div>
        @endforeach
    </div>

    <div class="question_contents">
        <div class="question_title">これは質問のタイトルです。</div>
        <div class="question_datetime">2022/02/15</div>
        <div class="question_content">これは質問の本文です。</div>
    </div>
    <div class="question_status">
        <div class="question_reaction">♡ ∞</div>
        <div class="question_comment">💬 ∞</div>
    </div>
</div>