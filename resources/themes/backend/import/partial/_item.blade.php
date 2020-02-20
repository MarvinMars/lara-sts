<div class="panel box box-{{ $item->exists ? 'success' : 'danger' }}">
    <div class="box-header with-border">
        <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#items" href="#item-{{ $loop->index }}" aria-expanded="false">
                {{ $item->humanTitle }}
            </a>
        </h4>
        <div class="pull-right box-tools">
            @if($item->exists)
                <span class="label label-success">{{ trans('stats.exists') }}</span>
            @else
                <span class="label label-danger">{{ trans('stats.new') }}</span>
            @endif
        </div>
    </div>
    <div id="item-{{ $loop->index }}" class="panel-collapse collapse {{ $loop->first ? 'in' : '' }}"
         aria-expanded="true" style="">
        <div class="box-body">
            <div class="row">
                <form>
                    @foreach($item->getAttributes() as $attribute => $value)
                        <input type="hidden" name="{{ $attribute }}" value="{{ $value }}"/>
                        <div class="col-xs-6">
                            <strong>{{ trans('import.' . $attribute) }}:</strong>
                            @if(!empty($value))
                                {{ $value }}
                            @else
                                <em class="text-muted">{{ trans('stats.no_value') }}</em>
                            @endif
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>