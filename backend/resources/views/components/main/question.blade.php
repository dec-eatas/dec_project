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
        justify-content: flex-end;padding-bottom: 0.5em;}
    .question_reaction{
        width:10%;color:orangered;text-align:right;}
    .question_comment{
        width:10%;color:green;text-align:right;}


</style>


<div class="component">

    <div class="question_contents">
        <div class="question_datetime">{{ $content['updated_at'] }}</div>
        <div class="question_title">{{ $content['title'] }}</div>
        <div class="question_content">{{ $content['content'] }}</div>
    </div>
    <div class="question_status">
        <div class="question_reaction">♡ ∞</div>
        <div class="question_comment">💬 ∞</div>
    </div>
</div>