@component('stats.components.table')
    @slot('title', trans('frontend.career_receiving_stats'))
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th class="overlay-column">
                    {{trans('frontend.season')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td class="overlay-column">
                        {{ $season->title }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td class="overlay-column">
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
                NO
            </th>
            <th>
                YDS
            </th>
            <th>
                AVG
            </th>
            <th>
                TD
            </th>
            <th>
                LONG
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
                    {{ $season->title }}
                </td>

                @foreach(Stats::footballCareerReceiving($player, $season) as $value)
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
            @foreach(Stats::footballTotalCareerReceiving($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent

