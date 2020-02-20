@component('stats.components.table')
    @slot('title', 'Fielding Career Statistics')

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
            <th>PO</th>
            <th>TC</th>
            <th>A</th>
            <th>E</th>
            <th>FldPct</th>
            <th>CI</th>
            <th>PB</th>
            <th>SBA</th>
            <th>CSB</th>
            <th>TP</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $current_season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $current_season->title }}</strong>
                </td>

                @foreach(Baseball::fieldingCareer($player, $current_season) as $value)
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
            @foreach(Baseball::fieldingCareer($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
