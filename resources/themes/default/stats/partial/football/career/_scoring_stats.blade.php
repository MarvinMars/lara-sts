@component('stats.components.table')
    @slot('title', trans('frontend.career_scoring_stats'))
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{trans('frontend.season')}}
                </th>
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
            <tfoot>
            <tr>
                <td>
                    <strong>{{ trans('frontend.total') }}:</strong>
                </td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">
                {{trans('frontend.season')}}
            </th>
            <th>
                GP
            </th>
            <th>
                TD
            </th>
            <th>
                RUSH
            </th>
            <th>
                REC
            </th>
            <th>
                RET
            </th>
            <th>
                FG
            </th>
            <th>
                PAT
            </th>
            <th>
                TOTAL
            </th>
            <th>
                AVG/G
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $season->title }}</strong>
                </td>

                @foreach(Stats::footballCareerScoring($player, $season) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot class="text-center">
        <tr>
            <td class="overlay-column">
                <strong>{{ trans('frontend.total') }}:</strong>
            </td>
            @foreach(Stats::footballTotalCareerScoring($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent

