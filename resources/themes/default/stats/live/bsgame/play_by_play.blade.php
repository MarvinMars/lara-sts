@isset($games)
    @component('stats.live.partial.title')
        @slot('title','Play By Play')
    @endcomponent
    @component('stats.live.partial.table')
        @slot('head')
            <tr>
                <th>Inning</th>
                <th>Team</th>
                <th>VH</th>
                <th>Text</th>
                <th>Stats</th>
            </tr>
        @endslot
        @slot('body')
            @foreach($games as $game)
                @if(isset($game['batting']['id']))
                    @php
                        $new_data = $game['batting'];
                        $game['batting'] = [];
                        $game['batting'][] = $new_data;
                        unset($new_data);
                    @endphp
                @endif
                @foreach($game['batting'] as $data)
                    <tr>
                        <td>{{ $game['number'] ?? '' }}</td>
                        <td>{{ $data['id'] ?? '' }}</td>
                        <td>{{ $data['vh'] ?? '' }}</td>
                        <td class="text-left">
                            @isset($data['play'])
                                @foreach($data['play'] as $item)
                                    {{ $item['narrative']['text'] ?? '' }}
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @isset($data['innsummary'])
                                @foreach($data['innsummary'] as $key => $stat)
                                    {{ $key }} : {{ $stat }} <br>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endforeach
        @endslot
    @endcomponent
@endisset
