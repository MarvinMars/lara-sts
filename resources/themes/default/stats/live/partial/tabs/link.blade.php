@isset($id)
    <li class="{{ $active ?? '' }}" >
        <a href="#{{ $id }}" class="tab-link">{{ $name ?? '' }}</a>
    </li>
@endisset