@extends('stats.player')

@section('player_content')
    @if($player->isHaveBlocks('highs'))
        @if($data = Baseball::highs($player, $season))
            @include('stats.partial.common.highs', ['data' => $data])
        @endif
    @endif

    @if($player->isHaveBlocks('pitching'))
        @if($data = Baseball::pitchingHighs($player, $season))
            @include('stats.partial.common.highs', [
                'data' => $data,
                'table_title' => 'Season Highs (Pitching)'
            ])
        @endif

        @include('stats.partial.baseball._pitching_career')
        @include('stats.partial.baseball._pitching_game_by_game')
    @endif

    @if($player->isHaveBlocks('hitting'))
        @include('stats.partial.baseball._hitting_career')
        @include('stats.partial.baseball._hitting_game_by_game')
    @endif

    @if($player->isHaveBlocks('fielding'))
        @include('stats.partial.baseball._fielding_career')
        @include('stats.partial.baseball._fielding_game_by_game')
    @endif

@endsection