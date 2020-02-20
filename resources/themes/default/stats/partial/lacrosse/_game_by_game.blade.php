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
                <td colspan="2">Totals:</td>
            </tr>
            </tfoot>
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
                GP
            </th>
            <th>
                G
            </th>
            <th>
                A
            </th>
            <th>
                PTS
            </th>
            <th>
                SH
            </th>
            <th>
                SH%
            </th>
            <th>
                SOG
            </th>
            <th>
                SOG%
            </th>
            <th>
                GW
            </th>
            <th>
                FPG
            </th>
            <th>
                FPS
            </th>
            <th>
                MIN
            </th>
            <th>
                GB
            </th>
            <th>
                CT
            </th>
{{--            <th>--}}
{{--                FO--}}
{{--            </th>--}}
{{--            <th>--}}
{{--                FO%--}}
{{--            </th>--}}
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
                @foreach(Lacrosse::gameByGame($player, $season, $game) as $value)
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
            @foreach(Lacrosse::gameByGame($player, $season) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
