@component('stats.components.table')
    @slot('title', trans('frontend.career_defensive_stats'))
    @slot('table_overlay')
        <table class="table">
            <thead>
            <tr>
                <th>
                    {{trans('frontend.season')}}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($seasons as $season)
                <tr>
                    <td>
                        <strong>{{ $season->title }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td>
                    <strong>{{ trans('frontend.total') }}:</strong>
                </td>
            </tr>
            </tfoot>
        </table>
    @endslot

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">
                {{trans('frontend.season')}}
            </th>
            @foreach(Football::defensiveCareerTable($player)->getColumns() as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $season->title }}</strong>
                </td>

                @foreach(Football::defensiveCareerTable($player, $season)->getRepository() as $value)
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
                <strong>{{ trans('frontend.total') }}:</strong>
            </td>
            @foreach(Football::defensiveCareerTable($player)->getRepository() as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
