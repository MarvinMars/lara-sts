@isset($games)
    @component('stats.live.partial.table')
        @slot('head')
            <tr>
                <th>Period</th>
                <th>Number</th>
                <th>Time</th>
                <th>Team</th>
                <th>VH</th>
                <th>Type</th>
                <th>Name</th>
                <th>Assist</th>
            </tr>
        @endslot
        @slot('body')
            @foreach($games as $game)
                <tr>
                    <td>{{ $game['prd'] ?? '' }}</td>
                    <td>{{ $game['number'] ?? '' }}</td>
                    <td>{{ $game['time'] ?? '' }}</td>
                    <td>{{ $game['id'] ?? '' }}</td>
                    <td>{{ $game['vh'] ?? '' }}</td>
                    <td>{{ $game['type'] ?? '' }}</td>
                    <td>{{ $game['name'] ?? '' }}</td>
                    <td>{{ $game['assist1'] ?? '' }}</td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endisset
