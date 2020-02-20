@extends('stats.player')

@section('player_content')
    @includeWhen($player->isHaveBlocks('career'), 'stats.partial.ice-hockey.career')
    @includeWhen($player->isHaveBlocks('goalkeeping_stats'), 'stats.partial.ice-hockey.career_goalkeeping')

    @if($player->isHaveBlocks('goalkeeping_highs'))
        @if($data = IceHockey::goalkeepingHighs($player, $season))
            @includeWhen(!!$data->count(), 'stats.partial.common.highs', [
                'data' => $data,
                'table_title' => 'Season Highs (Goalkeeping)'
            ])
        @endif
    @endif

    @if($player->isHaveBlocks('highs'))
        @if($data = IceHockey::highs($player, $season))
            @includeWhen(!!$data->count(), 'stats.partial.common.highs', [
                'data' => $data
            ])
        @endif
    @endif

    @includeWhen($player->isHaveBlocks('goalkeeping_stats'), 'stats.partial.ice-hockey.game_by_game_goalkeeping_stats')
    @includeWhen($player->isHaveBlocks('game_by_game'), 'stats.partial.ice-hockey.game_by_game')
@endsection
