<style>
    select{width:100%;font-size:0.7em;padding:0.3em;}
    #hyper_input{font-size:0.7em;padding:0.3em;}
    #category{padding-top:0}
</style>
   
<div class="component">
<form action="{{ route($route) }}" method="post" >
    @csrf
        <div class="component_title">
            検索する
        </div>
        <div class="input_box">
            <label class="subject">キーワード(スペースで区切ります)</label>
            <input type="text" name="keyword" class="input" id="hyper_input">
        </div>
        <div class="input_box" id="category">
            <label class="subject">カテゴリ</label>
            <select name="category_id">
                <option value="0">全て</option>
                <option value="1">ダイエット</option>
                <option value="2">美容</option>
                <option value="3">老化予防、若々しさの維持</option>
                <option value="4">体力の維持、向上</option>
                <option value="5">筋肉などの肉体づくり</option>
                <option value="6">疲労の回復、病気予防</option>
                <option value="7">病気の予防・改善</option>
                <option value="8">レシピ</option>
                <option value="9">その他</option>
            </select>
        </div>
        <div class="side_btns">
            <button >検索</button>
        </div>
    
</form>
</div>