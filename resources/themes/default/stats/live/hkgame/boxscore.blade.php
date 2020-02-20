@include('stats.live.common.boxscore',[ 'boxscore' => $boxscore ])
@include('stats.live.hkgame.scoring_summary',[ 'scoring_summary' => $scoring_summary ])
@include('stats.live.common.power_play_summary',[ 'power_play_summary' => $power_play_summary ])
@isset($penalty_summary)
    @component('stats.live.partial.title')
        @slot('title', 'Penalty Summary')
    @endcomponent
    @component('stats.live.partial.table')
        @slot('head')
            <tr>
                <th></th>
                <th>Period</th>
                <th>Player</th>
                <th>Min</th>
                <th>Offense</th>
                <th>Type</th>
                <th>Time</th>
                <th>PP</th>
            </tr>
        @endslot
        @slot('body')
            @foreach($penalty_summary as $data)
                <tr>
                    <td>
                        {{ $data['id'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['prd'] ?? '' }}
                    </td>
                    <td class="text-left">
                        {{ $data['name'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['minutes'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['desc'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['type'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['time'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['pp'] ?? '' }}
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endisset