@isset($power_play_summary)
    @component('stats.live.partial.title')
        @slot('title', 'Power play Summary')
    @endcomponent
    @foreach($power_play_summary as $key=>$team)
        @component('stats.live.partial.title')
            @slot('title', $key )
        @endcomponent
        @component('stats.live.partial.table')
            @slot('head')
                <tr>
                    <th>Prd</th>
                    <th>Elapsed</th>
                    <th>Shots</th>
                    <th>PPG</th>
                </tr>
            @endslot
            @slot('body')
                @foreach($team as $data)
                    <tr>
                        <td>
                            {{ $data['prd'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['elapsed'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['shots'] ?? '' }}
                        </td>
                        <td>
                            {{ $data['ppg'] ?? '' }}
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    @endforeach
@endisset