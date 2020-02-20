@extends('stats.player')

@section('player_content')
    @if($player->isHaveBlocks('highs'))
        @if($rushData = Softball::highs($player, $season))
            @include('stats.partial.common.highs', ['data' => $rushData])
        @endif
    @endif

    @if($player->isHaveBlocks('pitching'))
        @if($rushData = Softball::pitchingHighs($player, $season))
            @include('stats.partial.common.highs', ['data' => $rushData, 'table_title' => 'Season Highs (Pitching)'])
        @endif
    @endif

    @includeWhen($player->isHaveBlocks('pitching'), 'stats.partial.softball._pitching')
    @includeWhen($player->isHaveBlocks('hitting'), 'stats.partial.softball._hitting')
    @includeWhen($player->isHaveBlocks('fielding'), 'stats.partial.softball._fielding')
@endsection