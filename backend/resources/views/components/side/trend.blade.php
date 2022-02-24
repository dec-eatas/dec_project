<?php 
?>
<style>
    .tag_box{width:100%;font-size:1em;padding:0.3em;text-align:center}
</style>
   
<div class="component">
    <div class="component_title">
        トレンドタグ
    </div>
    @foreach($trend as $tag)
        <div class="tag_box">
            {{ $tag['name'] }}
        </div>
    @endforeach
  
</div>