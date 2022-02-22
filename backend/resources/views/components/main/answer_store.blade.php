<style>

    .contents{
        width:100%;border-bottom:solid lightgray 0.5px;display:flex;font-size:0.8em;align-items:center;
        padding-bottom:0.5em;}
    textarea{
        resize:none;width:100%;height:6em;padding:0.5em;}
    .main_btns{
        width:100%;padding-bottom:0.5em;}
    .main_btns button{
        width:100%;font-size:0.8em;padding:0.5em 0;border:lightgray solid;border-width:0.5px;}


</style>


<div class="component">

    <form action="{{ route('ans.store') }}" method="post">
        <input type="hidden" name="question_id" value="{{ $content['id'] }}">
        <input type="hidden" name="title" value="{{ $content['title'] }}">
        <input type="hidden" name="content" value="{{ $content['content'] }}">
        <input type="hidden" name="updated_at" value="{{ $content['updated_at'] }}">
        <textarea name="answer" placeholder="回答を入力"></textarea>
        <div class="main_btns">
            <button type="submit">回答する</button>
        </div>
    </form>
                    {{-- <!-- favorite 状態で条件分岐 -->
                    @if($answer->users()->where('user_id', Auth::id())->exists())
                    <!-- unfavorite ボタン -->
                    <form action="{{ route('ans.unfavorites',$answer) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $answer->users()->count() }}
                      </button>
                    </form>
                    @else
                    <!-- favorite ボタン -->
                    <form action="{{ route('ans.favorites',$answer) }}" method="POST" class="text-left">
                      @csrf
                      <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $answer->users()->count() }}
                      </button>
                    </form>
                    @endif --}}

                    
</div>