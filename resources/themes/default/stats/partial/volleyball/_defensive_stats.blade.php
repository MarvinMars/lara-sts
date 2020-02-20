@component('stats.components.table')
    @slot('title', trans('frontend.defensive_stats'))
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
                        {{ $season->title}}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>
                    {{ trans('frontend.total') }}:
                </td>
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
                DIG
            </th>
            <th>
                D/S
            </th>
            <th>
                RE
            </th>
            <th>
                BS
            </th>
            <th>
                BA
            </th>
            <th>
                TB
            </th>
            <th>
                B/S
            </th>
            <th>
                BE
            </th>
            <th>
                BHE
            </th>
            <th>
                PTS
            </th>
            <th>
                PTS/S
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    {{ $season->title}}
                </td>

                @foreach(Stats::volleyballCareerDefensive($player, $season) as $value)
                    <td> {{ $value }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">
                <strong>{{ trans('frontend.total') }}:</strong>
            </td>
            @foreach(Stats::volleyballTotalCareerTotalDefensive($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent