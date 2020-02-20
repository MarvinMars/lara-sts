@if(!empty($shots_by_period))
    @foreach($shots_by_period as $team)
        @component('stats.live.partial.title')
            @slot('sub_title')
                #{{ $team['rank'] ?? '' }} {{ $team['name'] ?? '' }}
            @endslot
        @endcomponent
        @component('stats.live.partial.table')
            @slot('head')
                <tr>
                    <th colspan="5"></th>
                    <th class="text-center" colspan="{{ count($team['total']['shotbyprd']) ?? 1 }}">Shots by period</th>
                    <th colspan="4"></th>
                </tr>
            @endslot
            @slot('body')

            @endslot
            @slot('footer')

            @endslot
        @endcomponent
    @endforeach
@endif
