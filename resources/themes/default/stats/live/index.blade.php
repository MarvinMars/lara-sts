@extends('layout')

@section('content')

@isset($boxscore)
    @include ('stats.live.'.$sport.'.boxscore',$boxscore)
@endisset
@isset($individual)
    @include ('stats.live.'.$sport.'.individual', $individual)
@endisset
@isset($play_by_play)
    @include ('stats.live.'.$sport.'.play_by_play',['games' => $play_by_play])
@endisset
@endsection
