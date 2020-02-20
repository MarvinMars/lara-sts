@component('stats.components.table')
    @slot('title', trans('frontend.offensive_stats'))

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
                        <strong>{{ $game->game_date }}</strong>
                    </td>
                    <td>
                        <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">
                    <strong>Total:</strong>
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
            @if($player->isHaveBlocks('offensive_passing_group'))
                <th colspan="7">
                    Passing
                </th>
            @endif

            @if($player->isHaveBlocks('offensive_rushing_group'))
                <th colspan="4">
                    Rushing
                </th>
            @endif

            @if($player->isHaveBlocks('offensive_receiving_group'))
                <th colspan="5">
                    Receiving
                </th>
            @endif
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
                    {{ $game->game_date }}
                </td>
                <td class="overlay-column">
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