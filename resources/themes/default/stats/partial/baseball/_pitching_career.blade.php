@component('stats.components.table')
    @slot('title', 'Pitching Career Statistics')

    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>Season</th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $current_season)
                <tr>
                    <td>
                        <strong>{{ $current_season->title }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td class="overlay-column">Totals:</td>
            </tr>
            </tfoot>
        </table>
    @endslot
    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">Season</th>
            <th>gp</th>
            <th>era</th>
            <th>w-l</th>
            <th>gs</th>
            <th>cg</th>
            <th>IP</th>
            <th>H</th>
            <th>R</th>
            <th>HR</th>
            <th>ER</th>
            <th>SFA</th>
            <th>BB</th>
            <th>SO</th>
            <th>WP</th>
            <th>BK</th>
            <th>HBP</th>
            <th>BF</th>
            <th>2B</th>
            <th>3B</th>
            <th>FO</th>
            <th>GO</th>
            <th>NP/STK</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $current_season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $current_season->title }}</strong>
                </td>

                @foreach(Baseball::pitching($player, $current_season) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">Totals:</td>
            @foreach(Baseball::pitching($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
