@isset($teams)
    @component('stats.live.partial.title')
        @slot('title','Play By Play')
    @endcomponent
    @foreach($teams as $team)
    @component('stats.live.partial.title')
        @slot('title', $team['name'] ?? '')
    @endcomponent
    @foreach($team['totals'] as $key_total => $category)
        @if( in_array($key_total, ['statsbyprd','psitsummary','hsitsummary']) )
            @component('stats.live.partial.table')
                @slot('head')
                    <tr>
                        <th>NUM</th>
                        <th>PLAYER</th>
                        @foreach($category as $key_category => $value)
                            <th>{{ $key_category ?? '' }}</th>
                        @endforeach
                    </tr>
                @endslot
                @slot('body')
                    @foreach($team['player']['data'] as $player)
                        @isset($player[$key_total])
                            <tr>
                                <td>
                                    {{ $player['uni'] ?? '' }}
                                </td>
                                <td>
                                    {{ $player['name'] ?? '' }}
                                </td>
                                @foreach($category as $key_category => $value)
                                    <td>
                                        @isset($player[ $key_total ][ $key_category])
                                            @if( is_iterable($player[ $key_total ][ $key_category]) )
                                                {!! $this->recursivePlayerValue($player[ $key_total ][ $key_category]) !!}
                                            @else
                                                {{ $player[ $key_total ][ $key_category] ?? 0 }}
                                            @endif
                                        @endisset
                                    </td>
                                @endforeach
                            </tr>
                        @endisset
                    @endforeach
                @endslot
                @slot('footer')
                    <tr>
                        <td colspan="2">Totals:</td>
                        @foreach($category as $key => $value)
                        <td>
                            @if( is_iterable($value) )
                                {!! $this->recursivePlayerValue($value) !!}
                            @else
                                {{ $value ?? 0 }}
                            @endif
                        </td>
                        @endforeach
                    </tr>
                @endslot
            @endcomponent
        @elseif( in_array($key_total, ['firstdowns','penalties','conversions', 'fumbles', 'misc', 'redzone']) )
            @component('stats.live.partial.table')
                @slot('head')
                    <tr>
                        <th colspan="100">{{ $key_total }}</th>
                    </tr>
                @endslot
                @slot('body')
                    <tr>
                        @foreach($category as $key => $value)
                            <td>
                                @if( is_iterable($value) )
                                    {!! $this->recursivePlayerValue($value) !!}
                                @else
                                    {{ $value ?? 0 }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endslot
            @endcomponent
        @elseif(is_iterable($category))
            @component('stats.live.partial.title')
                @slot('sub_title', $key_total)
            @endcomponent
        @else
            @component('stats.live.partial.table')
                @slot('head')
                    <tr>
                        <th>Stats</th>
                        <th>Value</th>
                    </tr>
                @endslot
                @slot('body')
                    <tr>
                        <td>{{ $key_total ?? '' }}</td>
                        <td>{{ $category ?? '' }}</td>
                    </tr>
                @endslot
            @endcomponent
        @endif
    @endforeach

@endforeach
@endisset