@extends('stats.player')

@section('player_content')
    @if($player->isHaveBlocks('highs') && ($rushData = Football::highs($player, $season)))
        @include('stats.partial.common.highs', ['data' => $rushData])
    @endif

    @if($player->isHaveBlocks('defensive') && ($rushData = Football::highsDefensive($player, $season)))
        @include('stats.partial.common.highs', ['data' => $rushData])
    @endif

    @includeWhen($player->isHaveBlocks('career_defensive'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_defensive_stats'),
        'data' => Football::defensiveCareerTable($player)
    ])

    @includeWhen($player->isHaveBlocks('defensive'), 'stats.partial.football._defensive_stats', [
        'data' => Football::defensiveGameByGame($player, $season)
    ] )

    @includeWhen($player->isHaveBlocks('offensive'), 'stats.partial.football._offensive_stats', [
        'data' => Football::offensiveGameByGame($player, $season)
    ])

    @includeWhen($player->isHaveBlocks('career_rushing'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_rushing_stats'),
        'data' => Football::careerRushingTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_scoring'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_scoring_stats'),
        'data' => Football::careerScoringTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_total_offensive'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_total_offense_stats'),
        'data' => Football::careerTotalOffensiveTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_passing'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_passing_stats'),
        'data' => Football::careerPassingTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_sacks_stats'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_sacks_stats'),
        'data' => Football::careerSacksTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_interceptions'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_interceptions_stats'),
        'data' => Football::careerInterceptionsTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_receiving'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_receiving_stats'),
        'data' => Football::careerReceivingTable($player)
    ])

    @includeWhen($player->isHaveBlocks('career_all_purpose'), 'stats.partial.common.tables.career', [
        'table_title' => trans('frontend.career_all_purpose_stats'),
        'data' => Football::careerAllPurposeTable($player)
    ])











@endsection