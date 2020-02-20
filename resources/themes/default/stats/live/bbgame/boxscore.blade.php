@include('stats.live.common.boxscore',[ 'boxscore' => $boxscore ])
@include('stats.live.common.scoring_summary',[ 'scoring_summary' => $scoring_summary ])
@isset($game)
    @foreach($game['team'] as $team)
        @component('stats.live.partial.title')
            @slot('title')
                {{  $team['name'] ?? '' }}
                (  {{ $team['linescore']['score'] ?? '' }} )
            @endslot
        @endcomponent
        @component('stats.live.partial.table')
            @slot('head')
                <tr>
                    <th>#</th>
                    <th>Player</th>
                    <th>gs</th>
                    <th>min</th>
                    <th>fg</th>
                    <th>3pt</th>
                    <th>ft</th>
                    <th>orb-drd</th>
                    <th>reb</th>
                    <th>pf</th>
                    <th>a</th>
                    <th>to</th>
                    <th>blk</th>
                    <th>stl</th>
                    <th>pts</th>
                </tr>
            @endslot
            @slot('body')
                @isset($team['player'])
                    @foreach($team['player'] as $data)
                            <tr>
                                <td>
                                    {{ $data['uni'] ?? '' }}
                                </td>
                                <td>
                                    {{ $data['name'] ?? '' }}
                                </td>
                                <td>
                                    {{ $data['gs'] ?? '' }}
                                </td>
                                <td>
                                    {{ $data['stats']['min'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['stats']['r'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['stats']['h'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['stats']['rbi'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['stats']['bb'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['stats']['so'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['stats']['lob'] ?? 0 }}
                                </td>
                            </tr>
                    @endforeach
                @endisset
            @endslot
            @slot('footer')
                <td colspan="2">Totals:</td>
                <td>
                    {{ $team['totals']['stats']['ab'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['stats']['r'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['stats']['h'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['stats']['rbi'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['stats']['bb'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['stats']['so'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['stats']['lob'] ?? 0 }}
                </td>
            @endslot
        @endcomponent
    @endforeach
@endisset