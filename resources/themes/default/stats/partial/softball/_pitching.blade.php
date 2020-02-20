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
        </table>
    @endslot
    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">Season</th>
            <th>era</th>
            <th>w-l</th>
            <th>app-gs</th>
            <th>cg</th>
            <th>sho</th>
            <th>sv</th>
            <th>ip</th>
            <th>h</th>
            <th>r</th>
            <th>er</th>
            <th>bb</th>
            <th>so</th>
            <th>2b</th>
            <th>3b</th>
            <th>hr</th>
            <th>ab</th>
            <th>b/avg</th>
            <th>wp</th>
            <th>hbp</th>
            <th>bk</th>
            <th>sfa</th>
            <th>sha</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $current_season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $current_season->title }}</strong>
                </td>

                @foreach(Softball::pitching($player, $current_season) as $value)
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
            @foreach(Softball::pitching($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
