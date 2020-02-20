@if(!empty($scoring_summary) )
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
            @foreach($scoring_summary['score'] as $data)
                <tr>
                    <td>
                        {{ $data['qtr'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['clock'] ?? '' }}
                    </td>
                    <td></td>
                    <td class="text-left">
                        {{ $data['team'] ?? '' }} -
                        {{ $data['scorer'] ?? '' }}
                        {{ $data['yds'] ?? '' }} yd
                        {{ $data['how'] ?? '' }}
                        pass from {{ $data['passer'] ?? '' }}
                        {{ $data['patby'] ?? '' }} {{ $data['pattype'] ?? '' }}
                        {{ $data['plays'] ?? '' }}
                        {{ $data['drive'] ?? '' }}
                        {{ $data['top'] ?? '' }}
                    </td>
                    @foreach($scoring_summary['teams'] as $key => $team)
                        <td> {!! $key == $data['vh'] ? 1 : 0 !!}</td>
                    @endforeach
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endif