@isset($scoring_summary)
    @component('stats.live.partial.title')
        @slot('title', 'Scoring Summary')
    @endcomponent
    @component('stats.live.partial.table')
        @slot('head')
            <th>id</th>
            <th>prd</th>
            <th>time</th>
            <th>name</th>
            <th>desc</th>
            <th>type</th>
            <th>number</th>
        @endslot
        @slot('body')
            @foreach($scoring_summary['score'] as $data)
                <tr>
                    <td>
                        {{ $data['id'] ?? '' }}
                    </td>
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
                        {{ $data['desc'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['type'] ?? '' }}
                    </td>
                    <td>
                        {{ $data['number'] ?? '' }}
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endisset