@if(!empty($scoring_summary) )
    @component('stats.live.partial.title')
        @slot('title', 'Scoring Summary')
    @endcomponent
    @component('stats.live.partial.table')
        @slot('head')
            <th>Period</th>
            <th>Time</th>
            <th>Scored By</th>
            <th>Assisted By</th>
            @foreach($scoring_summary['teams'] as $team)
            <th>  {{ $team ?? '' }}</th>
            @endforeach
        @endslot
        @slot('body')
            @foreach($scoring_summary['score'] as $data)
                <tr>
                    <td>
                        {{ $data['prd'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['time'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['name'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['assist1'] ?? '' }}  {{ $data['assist2'] ?? '' , ',' }}
                    </td>
                    @foreach($scoring_summary['teams'] as $key => $team)
                        <td> {!! $key == $data['vh'] ? 1 : 0 !!}</td>
                    @endforeach
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endif