@isset($games)
    @php
        $goal_1 = 0;
        $goal_2 = 0;
    @endphp
    @component('stats.live.partial.title')
        @slot('title', 'Play By Play')
    @endcomponent
    <div class="tabs-nav">
        <ul>
            @isset($games['period'])
                @foreach($games['period'] as $game)
                    <li class="{!! $loop->first ? 'active' : '' !!}">
                        <a href="#subtab_{{ $game['number'] ?? '' }}" class="tab-link">{{ $game['number'] ?? '' }}</a>
                    </li>
                @endforeach
            @endisset
        </ul>
    </div>
    <div class="tabs-list">
        @foreach($games['period'] as $game)
            <div class="tab {!! $loop->first ? 'active' : '' !!}" id="subtab_{{ $game['number'] ?? '' }}">
                @component('stats.live.partial.table')
                    @slot('head')
                        <thead>
                        <tr>
                            <th>
                              {{ $games['teams'][0] ?? '' }}
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                {{ $games['teams'][1] ?? '' }}
                            </th>
                        </tr>
                        </thead>
                    @endslot
                    @slot('body')
                        @foreach($game['play'] as $data)
                            @isset( $data['team'] )
                                <tr>
                                    <td>
                                        @if( $data['team'] == $games['teams'][0])
                                            {{ $data['text'] ?? '' }}
                                        @endif
                                    </td>
                                    <td>
                                        @isset( $data['goal'] )
                                            @php
                                                if($data['goal'] == $games['teams'][0] ){
                                                    $goal_1++ ;
                                                }
                                                if($data['goal'] == $games['teams'][1] ){
                                                    $goal_2++ ;
                                                }
                                            @endphp
                                            {{ $goal_1 }}
                                        @endisset
                                    </td>
                                    <td>
                                        {{ $data['goal'] ?? '' }}
                                    </td>
                                    <td>
                                        @isset( $data['goal'])
                                            {{ $goal_2 }}
                                        @endisset
                                    </td>
                                    <td>
                                        @if( $data['team'] == $games['teams'][1])
                                            {{ $data['text'] ?? '' }}
                                        @endif
                                    </td>
                                </tr>
                           @endisset
                        @endforeach
                    @endslot
                @endcomponent
            </div>
        @endforeach
    </div>
@endisset