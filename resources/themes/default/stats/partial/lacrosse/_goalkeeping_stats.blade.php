@component('stats.components.table')
    @slot('title', trans('frontend.career_goalkeeping_stats'))
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
                MIN
            </th>
            <th>
                GA
            </th>
            <th>
                GA/AVG
            </th>
            <th>
                SV
            </th>
            <th>
                SV%
            </th>
            <th>
                SHO
            </th>
            <th>
                SF
            </th>

        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    {{ $season->title }}
                </td>
                @foreach(Lacrosse::careerGoalkeeping($player, $season) as $value)
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
            @foreach(Lacrosse::careerGoalkeeping($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent

