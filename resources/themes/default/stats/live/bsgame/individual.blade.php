@isset($game)
    @foreach($game['team'] as $team)
        @component('stats.live.partial.title')
            @slot('title', $team['name'].' Offensive' ?? '' )
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
                    <th>2B</th>
                    <th>3B</th>
                    <th>HR</th>
                    <th>BB</th>
                    <th>SB</th>
                    <th>CS</th>
                    <th>HBP</th>
                    <th>SH</th>
                    <th>SF</th>
                    <th>SO</th>
                    <th>KL</th>
                    <th>GDP</th>
                    <th>PO</th>
                    <th>A</th>
                </tr>
            @endslot
            @slot('body')
            @isset( $team['player'])
                @foreach( $team['player'] as $data )
                    @isset( $data['hitting'])
                    <tr>
                        <td>
                            {{ $data['pos'] ?? '' }}
                        </td>
                        <td class="text-left">
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
                            {{ $data['hitting']['double'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['triple'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['hr'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['bb'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['cb'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['cs'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['hbp'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['sh'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['sf'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['so'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['kl'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['hitting']['gdp'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['fielding']['po'] ?? 0 }}
                        </td>
                        <td>
                            {{ $data['fielding']['a'] ?? 0 }}
                        </td>
                    </tr>
                    @endisset
                @endforeach
            @endisset
            @endslot
            @slot('footer')
                <tr>
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
                        {{ $team['totals']['hitting']['double'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['triple'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['hr'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['bb'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['cb'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['cs'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['hbp'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['sh'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['sf'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['so'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['kl'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['hitting']['gdp'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['fielding']['po'] ?? 0 }}
                    </td>
                    <td>
                        {{ $team['totals']['fielding']['a'] ?? 0 }}
                    </td>
                </tr>
            @endslot
        @endcomponent
    @endforeach
@endisset