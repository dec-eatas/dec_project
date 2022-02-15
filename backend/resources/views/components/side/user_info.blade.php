<style>

    .component{
        background-color:white;width:100%;padding:0.5em 1em;margin-bottom:0.5em;
        border:lightgray solid;border-width:0.5px;}
    .component_title{
        width:100%;text-align:center;font-size:1em;padding:0.8em 0;border-bottom:solid lightgray;
        border-width:0.5px;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    #eval_box{
        width:100%;display:flex;flex-wrap:wrap;padding:0.8em 0;}
    .eval{
        width:50%;font-size:0.8em;padding:0.5em 0;text-align:center}
    .side_btns{
        width:100%;padding-bottom:0.5em;}
    .side_btns button{
        width:100%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}
    .side_list_content{
        width:100%;padding:0.8em 0;}
    .side_list_record{
        width:100%;padding:0.3em 0;font-size:0.8em;
        white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}

</style>

<div class="component">
    <div class="component_title">
        {{ $user->name ?? 'Laravelさん' }}
    </div>
    <div id="eval_box">
        <div class="eval">質問数 {{ 1 }}</div>
        <div class="eval">回答数 {{ 1 }}</div>
        <div class="eval">記事数 {{ 1 }}</div>
        <div class="eval">閲覧数 {{ 1 }}</div>
        <div class="eval">反応数 {{ 1 }}</div>
        <div class="eval">参考数 {{ 1 }}</div>
    </div>
    <div class="side_btns">
        @if( 0 == 0 )
            <button onclick="location.href='account/detail'">詳細を見る</button>
        @elseif($follow_switch ?? '0' == 1)
            <button>フォローする</button>
        @else
            <button>フォローを外す</button>
        @endif
    </div>
</div>