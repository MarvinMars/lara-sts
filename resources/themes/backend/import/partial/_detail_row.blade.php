<div class="row">
    <div class="col-xs-12">
        @if($entry->logs)
            <div class="text-monospace logs">
                <pre>
@foreach($entry->logs as $log)
<span class="{{ $log->type === 'error' ? 'text-danger' : 'text-info' }}">[{{ $log->created_at->format('n/d/y h:i:s A')  }}] {{ $log->type }} {{ $log->content }}</span>
@endforeach
                </pre>
            </div>
        @else
            <h3>Logs does not exists.</h3>
        @endif
    </div>
</div>

<style type="text/css">
    .logs {
        max-height: 500px;
        width: 100%;
        overflow-y: auto;
    }
</style>
