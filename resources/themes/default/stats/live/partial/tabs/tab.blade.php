<div class="tab {{ $active ?? '' }}" id="{{ $id ?? '' }}">
    @isset( $tab_content )
        {{ $tab_content }}
    @endisset
</div>