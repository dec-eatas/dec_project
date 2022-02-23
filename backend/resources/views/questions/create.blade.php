@extends('layout.master')

@section('main')
<h1 class="h5 mb-4">
            対応顧客の目的
            </h1>
<input type="checkbox" id="01-A" name="checkbox01" checked="checked">
<label for="01-A" class="checkbox01">ダイエット</label>
<input type="checkbox" id="01-B" name="checkbox01">
<label for="01-B" class="checkbox01">老化防止、若々しさの維持</label>
<input type="checkbox" id="01-C" name="checkbox01">
<label for="01-C" class="checkbox01">美容</label>
<input type="checkbox" id="01-A" name="checkbox01" checked="checked">
<label for="01-A" class="checkbox01">体力の維持、向上</label>
<input type="checkbox" id="01-B" name="checkbox01">
<label for="01-B" class="checkbox01">筋肉などの肉体作り</label><br>
<input type="checkbox" id="01-C" name="checkbox01">
<label for="01-C" class="checkbox01">コンディショニング</label>
<input type="checkbox" id="01-A" name="checkbox01" checked="checked">
<label for="01-A" class="checkbox01">老化の予防・改善</label>
<input type="checkbox" id="01-B" name="checkbox01">
<label for="01-B" class="checkbox01">レシピ</label>
<input type="checkbox" id="01-C" name="checkbox01">
<label for="01-C" class="checkbox01">その他</label>







    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                質問の新規作成
            </h1>
            <form action="{{route('Que.store')}}" method="POST">
                @csrf
                <div>
                    <p>タイトル</p>
                    <input type="text" name="title" size="25" value="">
                </div>

                <div>
                    <p>内容</p>
                    <textarea name="content" cols="100" rows="5"></textarea>
                </div>

                <p><input type="submit" value="送信"></p>

            </form>
        </div>
    </div>
@endsection