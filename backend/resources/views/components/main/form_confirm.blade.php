<style>

    .confirm_contents{
        width:100%;font-size:0.8em;align-items:center;padding:0.5em 0;}
    .confirm_subject{
        width:100%;padding:0.5em 0;font-weight:bold;}
    .confirm_text{
        width:100%;padding:0.5em 0;}
    .confirm_main_btns{
        width:100%;padding:0.5em 0;display:flex;justify-content:center;}
    .confirm_main_btns button{
        width:30%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}
    #confirm_back{
        background-color:transparent;border:none;
        cursor:pointer;outline:none;padding:0.5em 0;appearance:none;}
    #confirm_back:hover{
        border-width:0.5px;}

</style>


<div class="component">

    <form method="post">
        @csrf
        <div class="confirm_contents">
            @foreach ($confirms as $confirm)
                <input type="hidden" name="{{ $confirm['p_name'] }}" value="{{ $confirm['value'] }}">
                @if ($confirm['display'])
                    <div class="confirm_subject">{{ $confirm['l_name'] }}</div>
                    <div class="confirm_text">{!! nl2br($confirm['value']) !!}</div>
                @endif
            @endforeach
        </div>
        <div class="confirm_main_btns">
            <button formaction="{{ route($next) }}" type="submit">回答する</button>
        </div>
        <div class="confirm_main_btns">
            <button id="confirm_back" formaction="{{ route($back) }}" type="submit">戻る</button>
        </div>
    </form>

</div>