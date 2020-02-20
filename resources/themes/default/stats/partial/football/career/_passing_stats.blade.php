@component('stats.components.table')
    @slot('title', trans('frontend.career_passing_stats'))
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
                    <td>
                        <strong>{{ $season->title }}</strong>
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
                CMP
            </th>
            <th>
                ATT
            </th>
            <th>
                INT
            </th>
            <th>
                YDS
            </th>
            <th>
                TD
            </th>
            <th>
                Long
            </th>
            <th>
                %
            </th>
            <th>
                AVG/P
            </th>
            <th>
                AVG/G
            </th>
            <th>
                EFFIC
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td>
                    <strong>{{ $season->title }}</strong>
                </td>

                @foreach(Stats::footballCareerPassing($player, $season) as $value)
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
            @foreach(Stats::footballTotalCareerPassing($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent

