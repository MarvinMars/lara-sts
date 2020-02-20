<div class="season-selector">
    <select name="seasonSelector" id="seasonSelector" class="form-control" title="Select player's season"
            data-init="select2">
        @foreach($seasons->reverse() as $availableSeason)
            @if($season->id === $availableSeason->id)
                <option value="{{ $availableSeason->id }}" selected="selected">
                    {{ $availableSeason->title }}
                </option>
            @else
                <option value="{{ $availableSeason->id }}">
                    {{ $availableSeason->title }}
                </option>
            @endif
        @endforeach
    </select>
</div>