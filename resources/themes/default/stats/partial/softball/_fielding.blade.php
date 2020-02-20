@component('stats.components.table')
    @slot('title', trans('frontend.fielding_stats'))

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
                C
            </th>
            <th>
                PO
            </th>
            <th>
                A
            </th>
            <th>
                E
            </th>
            <th>
                FLD%
            </th>
            <th>
                DP
            </th>
            <th>
                SBA
            </th>
            <th>
                CSB
            </th>
            <th>
                PB
            </th>
            <th>
                CI
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
                @foreach(Softball::fielding($player, $season, $game) as $value)
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
            @foreach(Softball::fielding($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
