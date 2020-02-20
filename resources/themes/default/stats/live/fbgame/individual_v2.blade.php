@include('stats.live.partial.tabs')
@push('tab_links')
    @component('stats.live.partial.tabs.link')
        @slot('id','individual')
        @slot('name','Individual')
        @slot('active', true )
    @endcomponent
    @component('stats.live.partial.tabs.link')
        @slot('id','team')
        @slot('name','Team Statistics')
    @endcomponent
    @component('stats.live.partial.tabs.link')
        @slot('id','drive_chart')
        @slot('name','Drive Chart')
    @endcomponent
    @component('stats.live.partial.tabs.link')
        @slot('id','participation')
        @slot('name','Participation')
    @endcomponent
@endpush
@push('tabs')
    @component('stats.live.partial.tabs.tab')
        @slot('id','individual')
        @slot('active',true)
        @slot('tab_content')
            @if( isset($offensive) && isset($offensive['data']) && !empty($offensive['data']))
                @component('stats.live.partial.title')
                    @slot('title','Offensive')
                @endcomponent
                @foreach( $offensive['data'] as $team)
                    @component('stats.live.partial.title')
                        @slot('sub_title')
                            # {{ $team['rank'] ?? '' }} {{ $team['name'] ?? '' }}
                        @endslot
                    @endcomponent
                    @isset($team['offensive']['passing']['players'] )
                        @component('stats.live.partial.title')
                            @slot('sub_title', 'Passing')
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th>Cmp</th>
                                    <th>Att</th>
                                    <th>Yds</th>
                                    <th>TD</th>
                                    <th>Int</th>
                                    <th>Long</th>
                                    <th>Sack</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach( $team['offensive']['passing']['players'] as $key => $data )
                                    <tr>
                                        <td class="text-left" >
                                            {{ $data['name'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['comp'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['att'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['yds'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['td'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['int'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['long'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $data['sacks'] ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endslot
                            @slot('footer')
                                <tr>
                                    <td>Totals</td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['comp'] )
                                            {{ $team['offensive']['passing']['total']['comp'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['att'])
                                            {{ $team['offensive']['passing']['total']['att'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['yds'])
                                            {{ $team['offensive']['passing']['total']['yds'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['td'])
                                            {{ $team['offensive']['passing']['total']['td'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['int'] )
                                            {{ $team['offensive']['passing']['total']['int'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['long'] )
                                            {{ $team['offensive']['passing']['total']['long'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['passing']['total']['sacks'] )
                                            {{ $team['offensive']['passing']['total']['sacks'] }}
                                        @endisset
                                    </td>
                                </tr>
                            @endslot
                        @endcomponent
                    @endisset
                    @isset( $team['offensive']['rushing']['players'] )
                        @component('stats.live.partial.title')
                            @slot('sub_title', 'Rushing')
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th>Att</th>
                                    <th>Yds</th>
                                    <th>TD</th>
                                    <th>Int</th>
                                    <th>Long</th>
                                    <th>Loss</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach( $team['offensive']['rushing']['players'] as $key => $data)
                                    <tr>
                                        <td class="text-left" >
                                            @isset( $data['name'] )
                                                {{ $data['name'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['att'] )
                                                {{ $data['att'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['gain'] )
                                                {{ $data['gain'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['yds'] )
                                                {{ $data['yds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['td'] )
                                                {{ $data['td'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['long'] )
                                                {{ $data['long'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['loss'] )
                                                {{ $data['loss'] }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @endslot
                            @slot('footer')
                                <tr>
                                    <td>Totals</td>
                                    <td>
                                        @isset( $team['offensive']['rushing']['total']['att'])
                                            {{ $team['offensive']['rushing']['total']['att'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['rushing']['total']['gain'] )
                                            {{ $team['offensive']['rushing']['total']['gain'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['rushing']['total']['yds'] )
                                            {{ $team['offensive']['rushing']['total']['yds'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['rushing']['total']['td'] )
                                            {{ $team['offensive']['rushing']['total']['td'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['rushing']['total']['long'] )
                                            {{ $team['offensive']['rushing']['total']['long'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['rushing']['total']['loss'] )
                                            {{ $team['offensive']['rushing']['total']['loss'] }}
                                        @endisset
                                    </td>
                                </tr>
                            @endslot
                        @endcomponent
                    @endisset
                    @isset( $team['offensive']['receiving']['players'] )
                        @component('stats.live.partial.title')
                            @slot('sub_title', 'Receiving')
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th>Rec</th>
                                    <th>Yds</th>
                                    <th>TD</th>
                                    <th>Long</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach( $team['offensive']['rushing']['players'] as $key => $data)
                                    @foreach( $team['offensive']['receiving']['players'] as $key => $data )
                                        <tr>
                                            <td class="text-left" >
                                                {{ $data['name'] ?? ''}}
                                            </td>
                                            <td>
                                                @isset( $data['no'] )
                                                    {{ $data['no'] ?? '' }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset( $data['yds'] )
                                                    {{ $data['yds'] }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset( $data['td'] )
                                                    {{ $data['td'] }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset( $data['long'] )
                                                    {{ $data['long'] }}
                                                @endisset
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endslot
                            @slot('footer')
                                <tr>
                                    <td>Totals</td>
                                    <td>
                                        @isset( $team['offensive']['receiving']['total']['no'] )
                                            {{ $team['offensive']['receiving']['total']['no'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['receiving']['total']['yds'] )
                                            {{ $team['offensive']['receiving']['total']['yds'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['receiving']['total']['td'] )
                                            {{ $team['offensive']['receiving']['total']['td'] }}
                                        @endisset
                                    </td>
                                    <td>
                                        @isset( $team['offensive']['receiving']['total']['long'] )
                                            {{ $team['offensive']['receiving']['total']['long'] }}
                                        @endisset
                                    </td>
                                </tr>
                            @endslot
                        @endcomponent
                    @endisset
                @endforeach
            @endif
            @if( isset($defensive) || !empty($defensive['data']))
                @component('stats.live.partial.title')
                    @slot('sub_title','Defensive')
                @endcomponent
                @foreach( $defensive['data'] as $team)
                    @component('stats.live.partial.title')
                        @slot('title')
                            # {{ $team['rank'] ?? '' }} {{ $team['name'] ?? ''}}
                        @endslot
                    @endcomponent
                    @isset( $team['defensive'] )
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th>solo</th>
                                    <th>ast</th>
                                    <th>tot</th>
                                    <th>tfl/yds</th>
                                    <th>sack/yds</th>
                                    <th>qbh</th>
                                    <th>brup</th>
                                    <th>int</th>
                                    <th>intyds</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach($team['defensive'] as $data)
                                    <tr>
                                        <td class="text-left" >
                                            {{ $data['name'] ?? ''}}
                                        </td>
                                        <td>
                                            @isset( $data['tackua'] )
                                                {{ $data['tackua'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['tacka'] )
                                                {{ $data['tacka'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['tot_tack'] )
                                                {{ $data['tot_tack'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['tfl_yds'] )
                                                {{ $data['tfl_yds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['sackyds'] )
                                                {{ $data['sackyds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['qbh'] )
                                                {{ $data['qbh'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['brup'] )
                                                {{ $data['brup'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['int'] )
                                                {{ $data['int'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['intyds'])
                                                {{ $data['intyds'] }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @endslot
                        @endcomponent
                    @endisset
                @endforeach
            @endif
            @if( isset($special) || !empty($special['data']) )
                @component('stats.live.partial.title')
                    @slot('sub_title','Special')
                @endcomponent
                @foreach($special['data'] as $team)
                    @component('stats.live.partial.title')
                        @slot('title')
                            # {{ $team['rank'] ?? '' }} {{ $team['name'] ?? ''}}
                        @endslot
                    @endcomponent
                    @isset( $team['special']['punt'] )
                        @component('stats.live.partial.title')
                            @slot('sub_title','Punt')
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th>no</th>
                                    <th>yds</th>
                                    <th>long</th>
                                    <th>inside20</th>
                                    <th>avg</th>
                                    <th>plus50</th>
                                    <th>tb</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach($team['special']['punt'] as $data )
                                    <tr>
                                        <td class="text-left" >
                                            {{ $data['name'] ?? ''}}
                                        </td>
                                        <td>
                                            @isset( $data['no'] )
                                                {{ $data['no'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['yds'] )
                                                {{ $data['yds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['long'] )
                                                {{ $data['long'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['inside20'] )
                                                {{ $data['inside20'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['avg'] )
                                                {{ $data['avg'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['plus50'] )
                                                {{ $data['plus50'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['tb'] )
                                                {{ $data['tb'] }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @endslot
                        @endcomponent
                    @endisset
                    @isset( $team['special']['field_goals'] )
                        @component('stats.live.partial.title')
                            @slot('sub_title','Rushing')
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th>qtr</th>
                                    <th>clock</th>
                                    <th>distance</th>
                                    <th>result</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach( $team['special']['field_goals'] as $key => $data)
                                    <tr>
                                        <td class="text-left" >
                                            @isset( $data['kicker'] )
                                                {{ $data['kicker'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['qtr'] )
                                                {{ $data['qtr'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['clock'] )
                                                {{ $data['clock'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['distance'] )
                                                {{ $data['distance'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['result'] )
                                                {{ $data['result'] }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @endslot
                        @endcomponent
                    @endisset
                    @isset( $team['special']['all_returns'] )
                        @component('stats.live.partial.title')
                            @slot('sub_title','All Returns')
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th></th>
                                    <th colspan="3">Punts</th>
                                    <th colspan="3">Kickoffs</th>
                                    <th colspan="3">Interceptions</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Ret</th>
                                    <th>Yds</th>
                                    <th>Lg</th>

                                    <th>Ret</th>
                                    <th>Yds</th>
                                    <th>Lg</th>

                                    <th>Ret</th>
                                    <th>Yds</th>
                                    <th>Lg</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach( $team['special']['all_returns'] as $data )
                                    <tr>
                                        <td class="text-left" >
                                            {{ $data['name'] ?? ''}}
                                        </td>
                                        <td>
                                            @isset( $data['pr_no'] )
                                                {{ $data['pr_no'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['pr_yds'] )
                                                {{ $data['pr_yds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['pr_long'] )
                                                {{ $data['pr_long'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['rcv_no'] )
                                                {{ $data['rcv_no'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['rcv_yds'] )
                                                {{ $data['rcv_yds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['rcv_long'] )
                                                {{ $data['rcv_long'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['ir_no'] )
                                                {{ $data['pr_no'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['ir_yds'] )
                                                {{ $data['ir_yds'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['ir_long'] )
                                                {{ $data['ir_long'] }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @endslot
                        @endcomponent
                    @endisset
                @endforeach
            @endif
        @endslot
    @endcomponent
    @component('stats.live.partial.tabs.tab')
        @slot('id','team')
        @slot('tab_content')
            @isset( $team_stats )
                @component('stats.live.partial.title')
                    @slot('title','Team Statistics')
                @endcomponent
                @component('stats.live.partial.table')
                    @slot('head')
                        <tr>
                            <th></th>
                            @foreach($team_stats['data']['teams'] as $team)
                                <th>  {{ $team['id'] }}</th>
                            @endforeach
                        </tr>
                    @endslot
                    @slot('body')
                        @foreach( $team_stats['data']['teams'] as $cat_key => $cat_data)
                            <tr>
                                <th colspan="3" class="text-left">{{ $cat_key }}</th>
                            </tr>
                            @isset($cat_data['keys'])
                                @foreach($cat_data['keys'] as $key_val)
                                    <tr>
                                        <td>{{ $key_val}}</td>
                                        @foreach ($team_stats['data']['teams'] as $team)
                                            <td>
                                                @if( $cat_data[$team['id']] || $cat_data[$team['id']][$key_val])  )
                                                {{ $cat_data[$team['id']][$key_val] ?? '' }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endisset
                        @endforeach
                    @endslot
                @endcomponent
            @endisset
        @endslot
    @endcomponent
    @component('stats.live.partial.tabs.tab')
        @slot('id','drive_chart')
        @slot('tab_content')
            @if( $drive_chart || !empty( $drive_chart['data'] ))
                @isset( $drive_chart['data']['stats'] )
                    @foreach( $drive_chart['data']['stats'] as $key => $category )
                        @component('stats.live.partial.title')
                            @slot('sub_title', $key)
                        @endcomponent
                        @component('stats.live.partial.table')
                            @slot('head')
                                <tr>
                                    <th colspan="2"></th>
                                    <th colspan="3">Drive Started</th>
                                    <th colspan="3">Drive Ended	</th>
                                    <th colspan="2">Consumed</th>
                                </tr>
                                <tr>
                                    <th>team</th>
                                    <th>Qtr</th>
                                    <th>Spot</th>
                                    <th>Time</th>
                                    <th>Obtained</th>
                                    <th>Spot</th>
                                    <th>Time</th>
                                    <th>How Lost</th>
                                    <th>Plays-Yds['</th>
                                    <th>TOP</th>
                                </tr>
                            @endslot
                            @slot('body')
                                @foreach($category as $data)
                                    <tr>
                                        <td>
                                            @isset( $data['team'] )
                                                {{ $data['team'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['start_qtr'] )
                                                {{ $data['start_qtr'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['start_spot'] )
                                                {{ $data['start_spot'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['start_time'] )
                                                {{ $data['start_time'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['start_how'] )
                                                {{ $data['start_how'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['end_spot'] )
                                                {{ $data['end_spot'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['end_time'] )
                                                {{ $data['end_time'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['end_how'] )
                                                {{ $data['end_how'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['plays'] )
                                                {{ $data['plays'] }}
                                            @else
                                                0
                                            @endisset
                                            -
                                            @isset( $data['yards'] )
                                                {{ $data['yards'] }}
                                            @else
                                                0
                                            @endisset
                                        </td>
                                        <td>
                                            @isset( $data['top'] )
                                                {{ $data['top'] }}
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach                            @endslot
                        @endcomponent
                    @endforeach
                @endisset
            @endif
        @endslot
    @endcomponent
    @component('stats.live.partial.tabs.tab')
        @slot('id','participation')
        @slot('tab_content')
            @isset( $starters['data'] )
                @foreach( $starters['data'] as $team )
                    @component('stats.live.partial.title')
                        @slot('title', $team['name'] ?? '' )
                    @endcomponent
                    @isset( $team['starters'] )
                        @foreach( $team['starters'] as  $key => $category )
                            @component('stats.live.partial.title')
                                @slot('title', $key )
                            @endcomponent
                            @component('stats.live.partial.table')
                                @slot('head')
                                    <tr>
                                        <th>#</th>
                                        <th>Player</th>
                                        <th>Pos</th>
                                    </tr>
                                @endslot
                                @slot('body')
                                    @foreach($category as $data)
                                        <tr>
                                            <td>
                                                @isset( $data['uni'] )
                                                    {{ $data['uni'] }}
                                                @endisset
                                            </td>
                                            <td>
                                                {{ $data['name'] ?? '' }}
                                            </td>
                                            <td>
                                                @isset( $data['pos'] )
                                                    {{ $data['pos'] }}
                                                @endisset
                                            </td>
                                        </tr>
                                    @endforeach                            @endslot
                            @endcomponent
                        @endforeach
                    @endisset
                @endforeach
            @endisset
            @isset( $participation['data'] )
                @component('stats.live.partial.title')
                    @slot('title', 'Player Participation' )
                @endcomponent
                @foreach($participation['data'] as $team)
                    @component('stats.live.partial.title')
                        @slot('title', $team['name'] ?? '' )
                    @endcomponent
                    @component('stats.live.partial.table')
                        @slot('head')
                            <tr>
                                <th>#</th>
                                <th>Player</th>
                            </tr>
                        @endslot
                        @slot('body')
                            @isset( $team['participation'] )
                                @foreach($team['participation'] as $data)
                                    <tr>
                                        <td>
                                            @isset( $data['uni'] )
                                                {{ $data['uni'] }}
                                            @endisset
                                        </td>
                                        <td>
                                            {{ $data['name'] ?? ''  }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        @endslot
                    @endcomponent
                @endforeach
            @endisset
        @endslot
    @endcomponent
@endpush