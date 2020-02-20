@component('stats.components.table')
    @slot('title', trans('frontend.season_highs'))
    <table class="table full">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('frontend.value') }}</th>
            <th>{{ trans('frontend.opponent') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rushData as $highsValue)
            <tr>
                <td class="no-highlight">
                    {{ $highsValue->get('title') }}
                </td>
                <td class="no-highlight">
                    {{ $highsValue->get('value') }}
                </td>
                <td class="no-highlight">
                    {{ $highsValue->get('opponent') }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endcomponent