
<form action="{{ route($route) }}" method="post" >
    @csrf
   
    <div class="component">
        <div class="component_title">
            質問を検索する
        </div>
        <div class="input_box">
            <label class="subject">タイトル</label>
            <input type="text" name="keyword" class="input">
        </div>

        <div class="side_btns">
            <button >検索</button>
        </div>
    </div>
</form>