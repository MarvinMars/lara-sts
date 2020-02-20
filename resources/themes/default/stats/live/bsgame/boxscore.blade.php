@include('stats.live.common.boxscore',[ 'boxscore' => $boxscore ?? [] ])
@include('stats.live.common.scoring_summary',[ 'scoring_summary' => $scoring_summary ?? [] ])
@isset($game)
    @foreach($game['team'] as $team)
        @component('stats.live.partial.title')
            @slot('title', $team['name'] ?? '' )
        @endcomponent
        @component('stats.live.partial.table')
            @slot('head')
                <tr>
                    <th></th>
                    <th>Player</th>
                    <th>Ab</th>
                    <th>R</th>
                    <th>H</th>
                    <th>RBI</th>
                    <th>BB</th>
                    <th>SO</th>
                    <th>Lob</th>
                </tr>
            @endslot
            @slot('body')
                @isset($team['player'])
                    @foreach($team['player'] as $data)
                        @isset($data['hitting'])
                            <tr>
                                <td>
                                    {{ $data['pos'] ?? '' }}
                                </td>
                                <td>
                                    {{ $data['name'] ?? '' }}
                                </td>
                                <td>
                                    {{ $data['hitting']['ab'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['hitting']['r'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['hitting']['h'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['hitting']['rbi'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['hitting']['bb'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['hitting']['so'] ?? 0 }}
                                </td>
                                <td>
                                    {{ $data['hitting']['lob'] ?? 0 }}
                                </td>
                            </tr>
                        @endisset
                    @endforeach
                @endisset
            @endslot
            @slot('footer')
                <td colspan="2">Totals:</td>
                <td>
                    {{ $team['totals']['hitting']['ab'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['hitting']['r'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['hitting']['h'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['hitting']['rbi'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['hitting']['bb'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['hitting']['so'] ?? 0 }}
                </td>
                <td>
                    {{ $team['totals']['hitting']['lob'] ?? 0 }}
                </td>
            @endslot
        @endcomponent
    @endforeach
@endisset