@extends('stats.player')

@section('player_content')
    @if($player->isHaveBlocks('highs'))
        @if($data = Basketball::highsTable($player, $season))
            @include('stats.partial.common.highs', ['data' => $data])
        @endif
    @endif

    @includeWhen($player->isHaveBlocks('career'), 'stats.partial.basketball._career')

    @includeWhen($player->isHaveBlocks('game_by_game'), 'stats.partial.basketball._game_by_game')
@endsection