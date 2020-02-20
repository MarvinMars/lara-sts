@component('stats.components.table')
    @slot('title', "Game-By-Game Goalkeeping Statistics")

    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Opponent</th>
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
            <tfoot>
            <tr>
                <td colspan="2">
                    Total:
                </td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">Date</th>
            <th class="overlay-column">Opponent</th>
            {{--<th>Score</th>--}}
            <th>Game Length</th>
            <th>Minutes</th>
            <th>GA</th>
            <th>GAA</th>
            <th>Saves</th>
            <th>W</th>
            <th>L</th>
            <th>T</th>
            <th>PPG</th>
            <th>SHG</th>
            <th>ENG</th>
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
                @foreach(IceHockey::goalkeepingGameByGame($player, $season, $game) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2" class="overlay-column">
                Total:
            </td>
            @foreach(IceHockey::goalkeepingGameByGame($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent