@component('stats.components.table')
    @slot('title', 'Pitching Game By Game Statistics')

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
                        {{ $player->getOpponentNameByGame($game) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">Totals:</td>
            </tr>
            </tfoot>
        </table>
    @endslot
    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">Date</th>
            <th class="overlay-column">Opponent</th>
            <th>g</th>
            <th>gs</th>
            <th>cg</th>
            <th>IP</th>
            <th>H</th>
            <th>R</th>
            <th>ER</th>
            <th>BB</th>
            <th>SO</th>
            <th>SHO</th>
            <th>BF</th>
            <th>2B</th>
            <th>3B</th>
            <th>BK</th>
            <th>HR</th>
            <th>WP</th>
            <th>HBP</th>
            <th>SFA</th>
            <th>GO</th>
            <th>FO</th>
            <th>NP/STK</th>
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
                @foreach(Baseball::pitchingGameByGame($player, $season, $game) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column" colspan="2">Totals:</td>
            @foreach(Baseball::pitchingGameByGame($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
