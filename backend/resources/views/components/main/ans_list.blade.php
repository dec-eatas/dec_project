<style>

    .answer_datetime{
        width:100%;font-size:0.8em;text-align:right;}
    .answer_contents{
        width:100%;padding:0.5em 0 0.5em 0;}
    .answer_title{
        width:100%;border-bottom:solid lightgray 0.5px;font-weight:bold;font-size:1.5em;padding:0.3em 0 0.3em 0;}
    .answer_content{
        width:100%;padding:1em 0 0.5em 0;}
    .answer_status{
        width:100%;display:flex;font-size:0.8em;align-items:center;
        justify-content: flex-end;padding-bottom: 0.5em;}
    .answer_reaction{
        width:10%;color:orangered;text-align:right;}
    .answer_comment{
        width:10%;color:green;text-align:right;}


</style>

{{-- @foreach ($contents as $content)
<div class="component">
    <div class="answer_contents">
        <div class="answer_datetime">{{ $content['updated_at'] }}</div>
        <div class="answer_content">{{ $content['content'] }}</div>
    </div>
    <div class="answer_status">
        <div class="answer_reaction">♡ ∞</div>
        <div class="answer_comment">💬 ∞</div>
    </div>
</div>
@endforeach --}}

<div class="component">
    <div class="answer_contents">
        <div class="answer_datetime">{{ $contents['updated_at'] }}</div>
        <div class="answer_content">{{ $contents['content'] }}</div>
    </div>
    <div class="answer_status">
        <div class="answer_reaction">♡ ∞</div>
        <div class="answer_comment">💬 ∞</div>
    </div>
</div>
