<style>

    #form_title{
        font-size:1.5em;font-weight:bold;}
    .form_contents{
        width:100%;padding:0.5em 0;}
    .form_content{
        width:60%;padding:0.5em 0;margin:0 auto;}
    .form_subject{
        }
    input,select{width:100%;font-size:1em;padding:0.3em;}
    .form_textarea{
        resize:none;width:100%;height:6em;padding:0.5em;font-weight:bold;
        overflow:auto;-ms-overflow-style:none;scrollbar-width:none;}
    .form_textarea::-webkit-scrollbar,main::-webkit-scrollbar{display:none;}
    .form_main_btns{
        width:100%;padding:0.5em 0;margin-bottom:0.5em;display:flex;justify-content:center;}
    .form_main_btns button{
        width:30%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}


</style>


<div class="component">
    <div class="component_title" id="form_title">記事を作成</div>
    <form action="{{ route($route) }}" method="post">
        @csrf
        <div class="form_contents">
            @foreach ($forms as $form)
                <div class="form_content">
                    <div class="form_subject">{{ $form['l_name'] }}</div>
                    @if($form['type'] == 'textarea')
                        <textarea class="form_textarea" name="{{ $form['p_name'] }}" placeholder="回答を入力"></textarea>
                    @elseif($form['type'] == 'select')
                        <select name="{{ $form['p_name'] }}">
                            @foreach ($form['options'] ?? ['a'] as $option)
                                <option value="{{ $option['value'] }}">{{ $option['l_name'] }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="{{ $form['type'] }}" name="{{ $form['p_name']  }}" value="{{ $form['confirm'] }}">
                    @endif
                </div>
            @endforeach
        </div>
            <div class="form_main_btns">
                <button type="submit">次へ進む</button>
            </div>
    

    </form>

</div>