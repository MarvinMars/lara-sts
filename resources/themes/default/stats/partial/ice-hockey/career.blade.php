@component('stats.components.table')
    @slot('title', 'Career Statistics')
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th rowspan="2">Season</th>
                <th class="clear">&nbsp;</th>
            </tr>
            <tr>
                <th class="clear">
                    &nbsp;
                </th>
                <th class="clear">
                    &nbsp;
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td>
                        {{ $season->title }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>
                    Total:
                </td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th rowspan="2" class="overlay-column">Season</th>
            <th rowspan="2">GP</th>
            <th colspan="6">Shots</th>
            <th colspan="3">Goals</th>
            <th rowspan="2">PEN-PIM</th>
            <th rowspan="2">Blk</th>
        </tr>
        <tr>
            <!--shots-->
            <th>g</th>
            <th>a</th>
            <th>pts</th>
            <th>sh</th>
            <th>sh%</th>
            <th>+-</th>
            <!--goal-->
            <th>pp</th>
            <th>sh</th>
            <th>gw</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    {{ $season->title }}
                </td>

                @foreach(IceHockey::career($player, $season) as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">
                Total:
            </td>
            @foreach(IceHockey::career($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
