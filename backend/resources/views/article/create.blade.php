@extends('layout.master')

@section('main')

<div class="container mt-4">

    <div class="border p-4">

        <h1 class="h5 mb-4">ブログの新規作成</h1>

        <form action="{{ route('Art.store') }}" method="POST">
            @csrf
            <div>
                <p>タイトル</p>
                <input type="text" name="title" size="25" value="">
            </div>
            <div>
                <p>内容</p>
                <textarea name="content" cols="100" rows="5"></textarea>
            </div>

            <input type="text" class="" name="create_tag" placeholder="タグを追加" > 

            @foreach($tags as $tag)

                <div class="">
                    <input  type="checkbox" name="tags[]" id="{{ $tag['id'] }}" value="{{ $tag['id']}}" >
                    <label for="{{ $tag['id'] }}">{{ $tag['name'] }}</label>
                </div>

            @endforeach

            <br>
            <input type="submit" value="送信">
        </form>

    </div>

</div>


</div>
@endsection