<html>
  <head>
    <title>{{ $table }}</title>
  </head>
  <body>
      <h2>{{ $datas['table'] }} [{{ $datas['cnt'] }}]</a></h2>

        <form action="detail" method="post">
            @csrf
            <input type="hidden" name='table' value="{{ $table }}">
            <table border="4">
                <tr>
                    @foreach ($datas['column'] as $column)
                        @if($column !== 'id' && $column !== 'created_at' && $column !== 'updated_at')
                            <th>{{ $column }}</th>
                        @endif
                    @endforeach
                    <th>insert</th>
                </tr>
                <tr>
                    @foreach ($datas['column'] as $column)
                        @if($column != 'id' && $column != 'created_at' && $column != 'updated_at')
                            <td><input name="data[{{ $column }}]"}}" type="text"></td>
                        @endif
                    @endforeach
                    <td><button type="submit" name='table' value="{{ $datas['table'] }}">追加</button></td>
                </tr>
            </table>
        </form>

       <table border="4">
          <tr>
              <th>選択</th>
              @foreach ($datas['column'] as $column)
                  <th>{{ $column }}</th>
              @endforeach
          </tr>
          
          @foreach ($datas['items'] as $items)
          <tr>
              <td><a href="record?table={{ $table }}&id={{ $items->id }}">編集</a></td>
              @foreach ($datas['column'] as $column)
                  <td>{{ $items->$column }}</td>
              @endforeach
          </tr>
          @endforeach
      </table>
  </body>