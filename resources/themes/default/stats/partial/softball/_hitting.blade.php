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
                GS
            </th>
            <th>
                AB
            </th>
            <th>
                R
            </th>
            <th>
                H
            </th>
            <th>
                RBI
            </th>
            <th>
                2B
            </th>
            <th>
                3B
            </th>
            <th>
                HR
            </th>
            <th>
                BB
            </th>
            <th>
                IBB
            </th>
            <th>
                SB
            </th>
            <th>
                SBA
            </th>
            <th>
                CS
            </th>
            <th>
                HBP
            </th>
            <th>
                SH
            </th>
            <th>
                SF
            </th>
            <th>
                GDP
            </th>
            <th>
                K
            </th>
            <th>
                AVG
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
                @foreach(Softball::hitting($player, $season, $game) as $value)
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
            @foreach(Softball::hitting($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
