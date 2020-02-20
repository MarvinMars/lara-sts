@component('stats.components.table')
    @slot('title', 'Hitting Game By Game Statistics')

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
            <th>R</th>
            <th>AB</th>
            <th>H</th>
            <th>2B</th>
            <th>3B</th>
            <th>TB</th>
            <th>HR</th>
            <th>RBI</th>
            <th>BB</th>
            <th>HBP</th>
            <th>SF</th>
            <th>SH</th>
            <th>K</th>
            <th>CS</th>
            <th>SB</th>
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
                @foreach(Baseball::hitting($player, $season, $game) as $value)
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
            @foreach(Baseball::hitting($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
