@if($entry->id)
    <select name="player_type_{{ $entry->id }}">
        <option value="">--</option>
        @foreach(\App\Models\PlayerType::getCachedItems() as $item)
            <option value="{{ $item->id }}" @if($item->id === $entry->player_type_id) selected="selected" @endif>
                {{ $item->name }}
            </option>
        @endforeach
    </select>


    <script type="text/javascript">
        $(document).on('change', 'select[name="player_type_{{ $entry->id }}"]', function (e) {
            var url = '{!! route('backend.player.ajax.player_type.save', [
                'id' => $entry->id
            ]) !!}',
                playerTypeId = $(this).val();

            var data = {};

            if (playerTypeId) {
                data.player_type_id = playerTypeId
            }

            $.ajax({
                url: url,
                data: data,
                method: 'POST',
                success: function (response) {
                    if (response.message && response.type) {
                        new PNotify({
                            text: response.message,
                            type: response.type
                        });
                    }
                }
            });

        });
    </script>
@endif