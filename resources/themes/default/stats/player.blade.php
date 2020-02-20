<div class="row mb-3">
    <div class="col-sm-12 @if(count($seasons) > 1) col-md-8 col-lg-10 @endif">
        <div class="page-header">
            <h2>
                {{ $player->name }}

                <small>
                    {{ $player->sport->title }} / Season: {{ $season->title }}
                </small>
            </h2>
        </div>
    </div>
    @if(count($seasons) > 1)
        <div class="col-sm-12 col-md-4 col-lg-2">
            @include('stats.partial._season_selector')
        </div>
    @endif
</div>

<section class="player-statistics">
    @yield('player_content')
</section>