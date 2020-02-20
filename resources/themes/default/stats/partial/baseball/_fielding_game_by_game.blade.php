@component('stats.components.table')
    @slot('title', 'Fielding Game By Game Statistics')

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
                    <td class="no-highlight">
                        {{ $game->game_date }}
                    </td>
                    <td class="no-highlight">
                        <strong>{{ $player->getOpponentNameByGame($game) }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td class="overlay-column" colspan="2">Totals:</td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">Date</th>
            <th class="overlay-column">Opponent</th>
            <th>PO</th>
            <th>TC</th>
            <th>A</th>
            <th>E</th>
            <th>CI</th>
            <th>PB</th>
            <th>SBA</th>
            <th>CSB</th>
            <th>TP</th>
            <th>FldPct</th>
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
                @foreach(Baseball::fielding($player, $season, $game) as $value)
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
            @foreach(Baseball::fielding($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
