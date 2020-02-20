@component('stats.components.table')
    @slot('title', trans('frontend.career_stats'))

    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{trans('frontend.season')}}
                </th>
            </tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td>
                        <strong>{{ $season->title }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endslot
    <table class="table">
        <thead>
        <tr>
            <th rowspan="2" class="overlay-column">
                {{trans('frontend.season')}}
            </th>
            <th rowspan="2">GP</th>
            <th rowspan="2">MIN</th>
            <th colspan="3">Totals</th>
            <th colspan="3">3-Point</th>
            <th colspan="3">Free-Throws</th>
            <th colspan="3">Rebounds</th>
            <th rowspan="2">PF</th>
            <th rowspan="2">AST</th>
            <th rowspan="2">T/O</th>
            <th rowspan="2">BLK</th>
            <th rowspan="2">STL</th>
            <th rowspan="2">PTS</th>
        </tr>
        <tr>
            <th>FG</th>
            <th>FGA</th>
            <th>PCT</th>
            <th>FG</th>
            <th>FGA</th>
            <th>PCT</th>
            <th>FT</th>
            <th>FTA</th>
            <th>PCT</th>
            <th>OFF</th>
            <th>DEF</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $season->title }}</strong>
                </td>

                @foreach(Basketball::careerTable($player, $season) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">
                <strong>{{ trans('frontend.total') }}:</strong>
            </td>
            @foreach(Basketball::careerTable($player) as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent