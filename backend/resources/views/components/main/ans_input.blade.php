<style>

    .ans_contents{
        width:100%;display:flex;font-size:0.8em;align-items:center;
        padding:0.5em 0;}
    .ans_textarea{
        resize:none;width:100%;height:6em;padding:0.5em;font-weight:bold;
        overflow:auto;-ms-overflow-style:none;scrollbar-width:none;}
    .ans_textarea::-webkit-scrollbar,main::-webkit-scrollbar{display:none;}
    .ans_main_btns{
        width:100%;padding:0.5em 0;display:flex;justify-content:center;}
    .ans_main_btns button{
        width:30%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}


</style>


<div class="component">

    <form action="{{ route('Ans.store') }}" method="post">
        <input type="hidden" name="question_id" value="{{ $content['id'] }}">
        <input type="hidden" name="title" value="{{ $content['title'] }}">
        <input type="hidden" name="content" value="{{ $content['content'] }}">
        <input type="hidden" name="updated_at" value="{{ $content['updated_at'] }}">
        <div class="ans_contents">
            <textarea class="ans_textarea" name="answer" placeholder="回答を入力"></textarea>
        </div>
        <div class="ans_main_btns">
            <button type="submit">回答する</button>
        </div>
    </form>

</div>