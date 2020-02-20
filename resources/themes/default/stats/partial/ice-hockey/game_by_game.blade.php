@component('stats.components.table')
    @slot('title', "Game-By-Game Statistics")

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
            <th>G</th>
            <th>A</th>
            <th>PTS</th>
            <th>SH</th>
            <th>%</th>
            <th>SHG</th>
            <th>+/-</th>
            <th>PEN/PIM</th>
            <th>PP</th>
            <th>EN</th>
            <th>GW</th>
            <th>GTG</th>
            <th>UA</th>
            <th>BLK</th>
            <th>FO lost</th>
            <th>FO won</th>
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
                @foreach(IceHockey::gameByGame($player, $season, $game) as $value)
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
            @foreach(IceHockey::gameByGame($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
