@if(isset($data))
    @component('stats.components.table')
        @slot('title', $table_title ?? 'Season Highs')
        <table class="table full">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>Date</th>
                <th>Opponent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $highsValue)
                <tr>
                    <td class="no-highlight">
                        <strong>{{ $highsValue->get('title') }}</strong>
                    </td>
                    <td class="no-highlight">
                        {{ $highsValue->get('value') }}
                    </td>
                    <td class="no-highlight">
                        {{ $highsValue->get('date') }}
                    </td>
                    <td class="no-highlight">
                        <strong>{{ $highsValue->get('opponent') }}</strong>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endcomponent
@endif
