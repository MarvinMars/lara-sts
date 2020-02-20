@component('stats.components.table')
    @slot('title', 'Career Goalkeeping Statistics')
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>Season</th>
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
                    Totals:
                </td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">Season</th>
            <th>GP</th>
            <th>Goalie Won</th>
            <th>Goalie Loss</th>
            <th>Goalie Tied</th>
            <th>Goalie mins.</th>
            <th>ppg allowed</th>
            <th>saves</th>
            <th>ga</th>
            <th>gaa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    {{ $season->title }}
                </td>

                @foreach(IceHockey::careerGoalkeeping($player, $season) as $value)
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
            @foreach(IceHockey::careerGoalkeeping($player) as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent