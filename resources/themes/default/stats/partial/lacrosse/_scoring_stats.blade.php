@component('stats.components.table')
    @slot('title', trans('frontend.career_scoring_stats'))
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{ trans('frontend.season') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td>
                        {{ $season->title }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>Totals:</td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">
                {{ trans('frontend.season') }}
            </th>
            <th>
                GP
            </th>
            <th>
                GS
            </th>
            <th>
                G
            </th>
            <th>
                A
            </th>
            <th>
                PTS
            </th>
            <th>
                SH
            </th>
            <th>
                SH%
            </th>
            <th>
                SOG
            </th>
            <th>
                SOG%
            </th>
            <th>
                GW
            </th>
{{--            <th>--}}
{{--                PK-ATT--}}
{{--            </th>--}}
            <th>
                MIN
            </th>
            <th>
                GB
            </th>
            <th>
                CT
            </th>
{{--            <th>--}}
{{--                FO--}}
{{--            </th>--}}
{{--            <th>--}}
{{--                FO%--}}
{{--            </th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    {{ $season->title }}
                </td>

                @foreach(Lacrosse::careerScoringStats($player, $season) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">Totals:</td>
            @foreach(Lacrosse::careerScoringStats($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent