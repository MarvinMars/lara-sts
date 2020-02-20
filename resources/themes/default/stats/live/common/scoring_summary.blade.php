@if( isset($scoring_summary) && !empty($scoring_summary) )
    @component('stats.live.partial.title')
        @slot('title', 'Scoring Summary')
    @endcomponent
    @component('stats.live.partial.table')
        @slot('head')
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                @foreach($scoring_summary['teams'] as $team)
                    <th>  {{ $team }}</th>
                @endforeach
            </tr>
        @endslot
        @slot('body')
            {{ $scoring_summary_body ?? '' }}
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
                        {{ $data['assist1'] ?? '' }}
                        @isset($data['assist2'])
                            , {{ $data['assist2'] ?? '' }}
                        @endisset
                    </td>
                    @foreach($scoring_summary['teams'] as $key => $team)
                        <td> {!! $key == $data['vh'] ? 1 : 0 !!}</td>
                    @endforeach
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endif