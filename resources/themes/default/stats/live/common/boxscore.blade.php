@if(!empty($boxscore))
    @component('stats.live.partial.table')
        @slot('head')
            <tr>
                <th></th>
                @foreach($boxscore['data'][0]['periods']['lineprd'] as $period)
                    <th>{{ $period['prd'] }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        @endslot
        @slot('body')
            @foreach($boxscore['data'] as $team)
                <tr>
                    <td>{{ $team['name'] }}</td>
                    @foreach($team['periods']['lineprd'] as $period)
                        <td>{{ $period['score'] }}</td>
                    @endforeach
                    <td> {{ $team['periods']['score'] }}</td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
    @if(!empty($stats))
        @component('stats.live.partial.table')
            @slot('head')
                <tr>
                    <th>Game stats</th>
                    @foreach($boxscore['data'] as $team)
                        <th>{{ $team['name'] }}</th>
                    @endforeach
                </tr>
            @endslot
            @slot('body')
                @foreach($stats as $name)
                    <tr>
                        <td>{{ $name }}</td>
                        @foreach($boxscore['data'] as $team)
                            <td>{{ $team['stats'][$name] ?? 0 }}</td>
                        @endforeach
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    @endif
@endif