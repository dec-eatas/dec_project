<style>

    .contents{
        width:100%;border-bottom:solid lightgray 0.5px;display:flex;font-size:0.8em;align-items:center;
        padding-bottom:0.5em;}
    textarea{
        resize:none;width:100%;height:6em;padding:0.5em;}
    .main_btns{
        width:100%;padding-bottom:0.5em;}
    .main_btns button{
        width:100%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}


</style>


<div class="component">

    <form action="{{ route('ans.store') }}" method="post">
        <input type="hidden" name="question_id" value="{{ $content['id'] }}">
        <input type="hidden" name="title" value="{{ $content['title'] }}">
        <input type="hidden" name="content" value="{{ $content['content'] }}">
        <input type="hidden" name="updated_at" value="{{ $content['updated_at'] }}">
        <textarea name="answer" placeholder="回答を入力"></textarea>
        <div class="main_btns">
            <button type="submit">回答する</button>
        </div>
    </form>

</div>