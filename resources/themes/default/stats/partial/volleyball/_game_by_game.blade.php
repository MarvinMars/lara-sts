@component('stats.components.table')
    @slot('title', trans('frontend.game_by_game_stats'))
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
                    <td>
                        <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th rowspan="2">
                {{ trans('frontend.date') }}
            </th>
            <th rowspan="2">
                {{ trans('frontend.opponent') }}
            </th>
            <th colspan="4">Attack</th>
            <th colspan="2">Set</th>
            <th colspan="2">Serve</th>
            <th colspan="2">Defense</th>
            <th colspan="4">Block</th>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>
                K
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
                AST
            </th>
            <th>
                E
            </th>
            <th>
                SA
            </th>
            <th>
                SE
            </th>
            <th>
                RE
            </th>
            <th>
                Dig
            </th>
            <th>
                BS
            </th>
            <th>
                BA
            </th>
            <th>
                BE
            </th>
            <th>
                TB
            </th>
            <th>
                BHE
            </th>
            <th>
                PTS
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($player->gamesBySeason($season) as $game)
            <tr>
                <td class="no-highlight overlay-column">
                    {{ $game->game_date }}
                </td>
                <td class="no-highlight overlay-column">
                    <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                </td>
                @foreach(Stats::volleyballGameGameByGameValues($player, $game, $season) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endcomponent
