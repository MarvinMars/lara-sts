<div>
    <p>
        <strong>Import #:</strong> {{ $import->id }}
    </p>
    <p>
        <strong>URL: </strong> {{ config('app.url') }}
    </p>
    <p>
        <strong>Season: </strong> {{ $import->season->title ?? 'Unknown' }}
    </p>
    <p>
        <strong>Sport:</strong> {{ $import->sport->title ?? 'Unknown' }}
    </p>
    <p>
        <strong>Timestamp: </strong> {{ date('Y-m-d H:i:s') }}
    </p>
    @foreach($data as $key => $value)
        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
    @endforeach
</div>