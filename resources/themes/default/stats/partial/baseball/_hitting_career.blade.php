@component('stats.components.table')
    @slot('title', 'Hitting Career Statistics')

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
            <th>GP</th>
            <th>BA</th>
            <th>OBPct</th>
            <th>SlgPct</th>
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
        @foreach($seasons as $current_season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $current_season->title }}</strong>
                </td>

                @foreach(Baseball::hittingCareer($player, $current_season) as $value)
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
            @foreach(Baseball::hittingCareer($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
