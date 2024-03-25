@extends($activeTemplate . 'layouts.master')

@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table-responsive--md">
                        <table class="custom--table table">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Lottery Name')</th>
                                    <th>@lang('Phase Number')</th>
                                    <th>@lang('Ticket Number')</th>
                                    <th>@lang('Win Bonus')</th>
                                    <th>@lang('Winning Level')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wins as $win)
                                    <tr>
                                        <td>{{ $wins->firstItem() + $loop->index }}</td>
                                        <td>{{ __($win->tickets->lottery->name) }}</td>
                                        <td>@lang('Phase')# {{ $win->tickets->phase->phase_number }}</td>
                                        <td>{{ $win->ticket_number }}</td>
                                        <td>{{ getAmount($win->win_bonus) }} {{ __($general->cur_text) }}</td>
                                        <td>@lang('Level') {{ $win->level }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="rounded-bottom text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($wins->hasPages())
                        <div class="card-footer justify-content-center">
                            {{ paginateLinks($wins) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
