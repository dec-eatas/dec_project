<html>
  <head>
    <title>{{ $table }}</title>
  </head>
  <body>
      <h2>{{ $table }}</h2>
      <form action="record" method="post">
          @csrf
        <input type="hidden" name='table' value="{{ $table }}">
        <table border="4">
          <tr>
              @foreach ($datas['column'] as $column)
                  <th>{{ $column }}</th>
              @endforeach
              <th>edit</th>
          </tr>
          <tr>
              @foreach ($datas['column'] as $column)
                @if($column == 'id')
                    <td>{{ $datas['items']->$column }}</td>
                @else
                    <td><input name="data[{{ $column }}]" value="{{ $datas["items"]->$column }}" type="text"></td>
                @endif
              @endforeach
              <td><button type="submit" name='id' value="{{ $datas['items']->id }}">変更</button></td>
          </tr>
        </table>
        </form>
        <a href="delete?table={{ $table }}&id={{ $datas['items']->id }}">削除</a>
        <br><br>
        <a href="detail?table={{ $table }}">戻る</a>
  </body>