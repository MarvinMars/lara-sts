@component('stats.components.table')
    @slot('title', trans('frontend.offensive_stats'))
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th class="overlay-column">
                    {{ trans('frontend.season') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td class="overlay-column">
                        {{ $season->title}}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td class="overlay-column">
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
                SP
            </th>
            <th>
                K
            </th>
            <th>
                K/S
            </th>
            <th>
                E
            </th>
            <th>
                TA
            </th>
            <th>
                %
            </th>
            <th>
                A
            </th>
            <th>
                A/S
            </th>
            <th>
                SA
            </th>
            <th>
                SA/S
            </th>
            <th>
                SE
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    {{ $season->title}}
                </td>
                @if($player->isHaveBlocks('offensive'))
                    @foreach(Stats::volleyballCareerOffensive($player, $season) as $value)
                        <td> {{ $value }}</td>
                    @endforeach
                @endif
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">
                {{ trans('frontend.total') }}:
            </td>
            @foreach(Stats::volleyballTotalCareerTotalOffensive($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent