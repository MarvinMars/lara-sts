@extends('stats.player')

@section('player_content')
    @if($player->isHaveBlocks('highs'))
        @if($rushData = Stats::highsVolleyballValues($player, $season))
            @include('stats.partial.common.highs', ['data' => $rushData])
        @endif
    @endif

    @includeWhen($player->isHaveBlocks('game_by_game'), 'stats.partial.volleyball._game_by_game')
    @includeWhen($player->isHaveBlocks('offensive'), 'stats.partial.volleyball._offensive_stats', ['games' => $player->gamesBySeason($season)])
    @includeWhen($player->isHaveBlocks('defensive'), 'stats.partial.volleyball._defensive_stats', ['games' => $player->gamesBySeason($season)])
@endsection