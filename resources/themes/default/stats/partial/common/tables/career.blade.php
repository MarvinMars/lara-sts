<?php /** @var string $table_title
 * @var bool $disable_overlay
 * @var \App\Services\Stats\Tables\AbstractTable $data
 * */ ?>

@component('stats.components.table')
    @slot('title', $table_title ?? null)

    @if(!isset($disable_overlay) || $disable_overlay !== true)
        @slot('table_overlay')
            <table class="table">
                <thead>
                <tr>
                    <th>
                        {{trans('frontend.season')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($seasons as $season)
                    <tr>
                        <td>
                            <strong>{{ $season->title }}</strong>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <strong>{{ trans('frontend.total') }}:</strong>
                    </td>
                </tr>
                </tfoot>
            </table>
        @endslot
    @endif

    <table class="table">
        <thead>
        <tr>
            <th class="overlay-column">
                Season
            </th>
            @foreach($data->getColumns() as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($seasons as $season)
            <tr>
                <td class="overlay-column">
                    <strong>{{ $season->title }}</strong>
                </td>

                @foreach($data->clone()->setSeason($season)->getRepository() as $value)
                    <td>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="overlay-column">
                <strong>{{ trans('frontend.total') }}:</strong>
            </td>
            @foreach($data->getRepository() as $value)
                <td>
                    {{ $value }}
                </td>
            @endforeach
        </tr>
        </tfoot>
    </table>
@endcomponent
