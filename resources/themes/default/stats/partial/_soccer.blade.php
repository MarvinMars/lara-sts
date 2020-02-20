@extends('stats.player')

@section('player_content')
    @if($player->isHaveBlocks('highs'))
        @if($rushData = Soccer::highs($player, $season))
            @include('stats.partial.common.highs', [
                'data' => $rushData,
                'table_title' => trans('frontend.season_highs')
            ])
        @endif
    @endif

    @if($player->isHaveBlocks('season_goalkeeping_highs'))
        @if($rushData = Soccer::highsGoalkeeping($player, $season))
            @include('stats.partial.common.highs', [
                'data' => $rushData,
                'table_title' => trans('frontend.season_goal_highs')
            ])
        @endif
    @endif

    @includeWhen($player->isHaveBlocks('career_goalkeeping_stats'), 'stats.partial.soccer._goalkeeping_stats')
    @includeWhen($player->isHaveBlocks('game_by_game_goalkeeping'), 'stats.partial.soccer._game_by_game_goalkeeping')

    @includeWhen($player->isHaveBlocks('career_scoring_stats'), 'stats.partial.soccer._scoring_stats')
    @includeWhen($player->isHaveBlocks('game_by_game'), 'stats.partial.soccer._game_by_game')


@endsection