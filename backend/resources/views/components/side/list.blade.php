<div class="component">
    <div class="component_title">
        {{ $list_name }}
    </div>
    <div class="side_list_content">
        @for ($i=0; $i<5; $i++)
        <div class="side_list_record"><a href="eata">{{ $list[$i]['name'] }}</a></div>
        @endfor
    </div>
    <div class="side_btns">
        <button onclick="location.href='{{ route($location) }}'">もっと見る</button>
    </div>
</div>