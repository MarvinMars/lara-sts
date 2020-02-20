<div class="row m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
    <div class="col-xs-12">
        @if($entry->seasons)
            <div class="row player-detail-row-form">
                <div class="col-xs-12 col-md-6">
                    <h4 class="page-header">
                        {{ trans('stats.default_season') }}
                    </h4>
                    <div class="form-group">
                        <input type="text" disabled="disabled" class="form-control" value="{{ route('frontend.player.stats', [
                                'playerId' => $entry->id,
                            ]) }}">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h4 class="page-header">{{trans('stats.by_seasons')}}</h4>
                    @foreach($entry->seasons as $season)
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="col-md-2">
                                <span class="pull-right">
                                    {{ $season->title }}
                                </span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" disabled="disabled" class="form-control" value="{{ route('frontend.player.stats', [
                                    'playerId' => $entry->id,
                                    'seasonId'=> $season->id
                                ]) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        @endif
    </div>
    @if(!$entry->playerType)
        <div class="col-xs-12 m-t-10 p-t-10">
            <h4 class="page-header">
                {{ trans('stats.hide_stat') }}
            </h4>


            {!! Form::open([
                'id'        => 'hideOnScreen' . $entry->id,
                'route'     => ['backend.player.ajax.hide_stat.save', $entry->id],
                'method'    => 'POST',
            ]) !!}
            <div class="row">
                @foreach($entry->getAvailableStatsBlocks() as $availableStatsBlock)
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>
                                <input name="blocks[]"
                                       type="checkbox"
                                       value="{{ $availableStatsBlock['id'] }}"
                                        {{ ($entry->isHideBlock($availableStatsBlock['id']) ? 'checked="checked"' : null) }}/>

                                {{ $availableStatsBlock['title'] }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row p-t-10">
                <div class="col-xs-12 text-right">
                    <input type="submit" value="Save" class="form-control btn btn-primary"/>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    @endif
</div>


<style type="text/css">
    .player-detail-row-form .form-group {
        width: 100%;
    }

    .player-detail-row-form .form-group .form-control {
        width: 100%;
    }
</style>

<script type="text/javascript">
    $('#hideOnScreen{{ $entry->id }}').off('submit');

    $('#hideOnScreen{{ $entry->id }}').on('submit', function (e) {
        e.preventDefault();
        if (!confirm("Are you sure?")) {
            return false;
        }

        var data = $(this).serialize(),
            url = $(this).attr('action');

        if (url) {
            $.ajax({
                url: url,
                data: data,
                method: 'POST',
                success: function (response) {
                    if (response.message && response.type) {
                        new PNotify({
                            text: response.message,
                            type: response.type
                        });
                    }
                }
            })
        }

        return false;
    });
</script>