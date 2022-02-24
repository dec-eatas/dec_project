<style>

    .list_status{
        width:100%;border-bottom:solid lightgray 0.5px;display:flex;font-size:0.8em;align-items:center;
        padding-bottom: 0.5em;position: relative;}
    .list_category{
        width:fit-content;margin-right:2em;font-weight:bold;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    .list_tags{
        width:60%;display:flex;}
    .list_tag{
        width:fit-content;margin-right:2em; white-space:nowrap;text-overflow:ellipsis;overflow:hidden;}
    .list_reaction{
        width:8%;color:orangered;position:absolute;margin-left:86%}
    .list_datetime{
        width:9%;text-align:right;margin-left:auto;}
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
    #nones{
        color:gray}
    .list_title{
        width:90%;}


</style>

@foreach ($contents as $row)
    <div class="component">
        <div class="list_status">
            <div class="list_category">{{ $row['category_name'] }}</div>
            <div class="list_tags">
                @foreach($row['tags'] as $tag)
                    <div class="list_tag">
                        <a>{{ $tag['tag_name'] }}</a>
                    </div>
                @endforeach
            </div>
            {{-- @if($row['reaction'] == 0)
                <div class="list_reaction" id="nones">♡ {{ $row['reaction'] }}</div>
            @else
                <div class="list_reaction" id="favos">♡ {{ $row['reaction'] }}</div>
            @endif --}}
  
            <div class="list_datetime">{{ $row['diff']  }}</div>
        </div>
        <a href="{{ route($row['route'],['id'=>$row['id']]) }}">
            <div class="list_content">
                <div class="list_type type_{{ $row['type'] }}">{{ $row['type'] }}</div>
                <div class="list_title">{{ $row['title'] }}</div>
            </div>
        </a>
    </div>
@endforeach