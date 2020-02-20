@component('stats.components.table')
    @slot('title', trans('frontend.defensive_stats'))

    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th rowspan="2">
                    {{ trans('frontend.date') }}
                </th>
                <th rowspan="2">
                    {{ trans('frontend.opponent') }}
                </th>
                <th class="clear">&nbsp;</th>
            </tr>
            <tr>
                <th class="clear">
                    &nbsp;
                </th>
                <th class="clear">
                    &nbsp;
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($player->gamesBySeason($season) as $game)
                <tr>
                    <td>
                        {{ $game->game_date }}
                    </td>
                    <td class="no-highlight">
                        <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="text-center">
            <tr>
                <td class="text-right" colspan="2">
                    <strong>{{ trans('frontend.total') }}:</strong>
                </td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th rowspan="2" class="overlay-column">
                {{ trans('frontend.date') }}
            </th>
            <th rowspan="2" class="overlay-column">
                {{ trans('frontend.opponent') }}
            </th>
            <th colspan="7">
                Tackles
            </th>
            <th colspan="2">
                Sacks
            </th>
            <th colspan="3">
                Fumble
            </th>
            <th colspan="2">
                Int
            </th>
            <th colspan="2">
                Pass
            </th>
            <th colspan="1">
                Blkd
            </th>
        </tr>
        <tr>
            @foreach($data->getColumns() as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($player->gamesBySeason($season) as $game)
            <tr>
                <td class="overlay-column">
                    {{ $game->game_date }} {{ $game->start }}
                </td>
                <td class="overlay-column no-highlight">
                    <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                </td>
                @foreach($data->clone()->setGame($game)->getRepository() as $value)
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column" colspan="2">
                <strong>{{ trans('frontend.total') }}:</strong>
            </td>
            @foreach($data->getRepository() as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent