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
        color:royalblue;}
    .type_answer{
        color:orangered;}
    .type_article{
        color:forestgreen;}
    .type_reaction{
        color:mediumvioletred}
    .list_title{
        width:90%;}


</style>


@foreach ($contents as $row)
    <div class="component">
        <div class="list_status">
            <div class="list_category">{{ $row['category'] ?? 'カテゴリー' }}</div>
            <div class="list_tags">
                @foreach($row['tags'] ?? [''] as $tag)
                    <div class="list_tag">
                        <a>{{ $tag }}</a>
                    </div>
                @endforeach
            </div>
            <div class="list_reaction">♡ {{ $row['reaction'] ?? '∞' }}</div>
            <div class="list_comment">💬 {{ $row['comment'] ?? '∞' }}</div>
            <div class="list_datetime">{{ $row['diff']  }}</div>
            
        </div>
        <a href="{{ route($row['route'],['id'=>$row['id']]) }}">
            <div class="list_content">
                <div class="list_type type_{{ $row['type'] }}">{{ $row['type'] ?? 'Reaction' }}</div>
                <div class="list_title">{{ $row['title'] }}</div>
            </div>
        </a>
    </div>
@endforeach

{{-- 
    
$contents = [
    [
        'type' => 'レコードのタイプ',
        'title' => 'タイトル(もしくは本文)',
        'category' => 'カテゴリ名',
        'tags' => ['タグ１','タグ2','タグ3','タグ4','タグ5'],
        'reaction' => '反応の数',
        'comment' => '回答やコメントの数',
        'datetime' => 'レコード作成日時',
    ], ...
];

--}}
