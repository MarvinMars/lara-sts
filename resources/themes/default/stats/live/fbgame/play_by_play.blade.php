@isset($games)
    @component('stats.live.partial.table')
        @slot('head')
            <tr>
                <th>#</th>
                <th>Hasball</th>
                <th>Down</th>
                <th>Togo</th>
                <th>Type</th>
                <th>Text</th>
            </tr>
        @endslot
        @slot('body')
            @foreach($games as $game)
                @foreach($game['play'] as $data)
                    <tr>
                        <td>
                            {{ $game['text'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['hasball'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['down'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['togo'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['type'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['text'] ?? '' }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endslot
    @endcomponent
@endisset
