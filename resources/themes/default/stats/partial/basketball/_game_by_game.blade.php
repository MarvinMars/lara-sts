@component('stats.components.table')
    @slot('title', trans('frontend.game_by_game_stats'))

    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{ trans('frontend.date') }}
                </th>
                <th>
                    {{ trans('frontend.opponent') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($player->gamesBySeason($season) as $game)
                <tr>
                    <td>
                    <!--{{ $game->id }}-->
                        {{ $game->game_date }}
                    </td>
                    <td class="no-highlight">
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
            <th class="overlay-column">
                {{ trans('frontend.date') }}
            </th>
            <th class="overlay-column">
                {{ trans('frontend.opponent') }}
            </th>
            <th>
                PTS
            </th>
            <th>
                MIN
            </th>
            <th>
                FGM/A
            </th>
            <th>
                FGM/A %
            </th>
            <th>
                3FG/A
            </th>
            <th>
                3FG/A %
            </th>
            <th>
                FTM/A
            </th>
            <th>
                FTM/A %
            </th>
            <th>
                OFF
            </th>
            <th>
                DEF
            </th>
            <th>
                TOTAL
            </th>
            <th>
                PF
            </th>
            <th>
                AST
            </th>
            <th>
                T/O
            </th>
            <th>
                BLK
            </th>
            <th>
                STL
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($player->gamesBySeason($season) as $game)
            <tr>
                <td class="overlay-column">
                    {{ $game->game_date }}
                </td>
                <td class="no-highlight overlay-column">
                    <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                </td>
                @foreach(Basketball::gameByGameTable($player, $season, $game) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column" colspan="2">
                {{ trans('frontend.total') }}:
            </td>
            @foreach(Basketball::gameByGameTable($player, $season) as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent

