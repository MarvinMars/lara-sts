@extends('layout')

@section('title')
    @if($player->sport)
        {{ $player->sport->title }} -
    @endif

    @if($season)
        {{ $season->title }} -
    @endif

    {{ $player->name }}
@endsection

@section('content')
    @if($player->sport)
        @if(in_array($player->sport->type, [\App\Models\Sport::TYPE_BASEBALL, \App\Models\Sport::TYPE_SOFTBALL]))
            @include('stats.partial._baseball')
        @elseif($player->sport->type === \App\Models\Sport::TYPE_FOOTBALL)
            @include('stats.partial._football')
        @elseif($player->sport->type === \App\Models\Sport::TYPE_SOCCER)
            @include('stats.partial._soccer')
        @elseif($player->sport->type === \App\Models\Sport::TYPE_BASKETBALL)
            @include('stats.partial._basketball')
        @elseif($player->sport->type === \App\Models\Sport::TYPE_ICE_HOCKEY)
            @include('stats.partial._ice_hockey')
        @elseif($player->sport->type === \App\Models\Sport::TYPE_VOLLEYBALL)
            @include('stats.partial._volleyball')
        @elseif($player->sport->type === \App\Models\Sport::TYPE_LACROSSE)
            @include('stats.partial._lacrosse')
        @endif
    @else
        <h1>{{ trans('frontend.errors.season_is_not_set') }}</h1>
    @endif
@endsection

@push('before_scripts')
    <script type="text/javascript">
        window.playerId = {{ $player->id }};
    </script>
@endpush