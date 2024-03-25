<div class="table-responsive--md">
    <table class="custom--table table">
        <thead>
            <tr>
                <th>@lang('Title')</th>
                <th>@lang('Start Date')</th>
                <th>@lang('Draw Date')</th>
                <th>@lang('Price')</th>
                <th>@lang('Sold')</th>
                <th>@lang('Status')</th>
                <th>@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($phases as $phase)
                <tr>
                    <td>
                        <div class="table-game">
                            <img src="{{ getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery')) }}" alt="image">
                            <h6 class="name">{{ __($phase->lottery->name) }}</h6>
                        </div>
                    </td>
                    <td>{{ @showDateTime($phase->start_date, 'Y-m-d') }}</td>
                    <td>{{ @showDateTime($phase->draw_date, 'Y-m-d') }}</td>
                    <td>{{ showAmount($phase->lottery->price) }} {{ $general->cur_text }}</td>
                    <td>
                        <div class="progress lottery--progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ ($phase->sold / $phase->quantity) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($phase->sold / $phase->quantity) * 100 }}%"></div>
                        </div>
                        <span class="fs--14px">{{ getAmount(($phase->sold / $phase->quantity) * 100) }}%</span>
                    </td>
                    <td>
                        @php  echo $phase->DrawBadge; @endphp
                    </td>
                    <td>
                        <a class="btn btn-sm btn-outline--base" href="@if (request()->routeIs('user.*')) {{ route('user.lottery.details', $phase->id) }} @else {{ route('lottery.details', $phase->id) }} @endif">
                            @if (@request()->routeIs('user.home'))
                                @lang('Play Now')
                            @else
                                @lang('Buy Ticket')
                            @endif
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="100%">{{ __($emptyMessage) }}
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
