@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('User Name')</th>
                                    <th>@lang('Lottery')</th>
                                    <th>@lang('Phase')</th>
                                    <th>@lang('Ticket Number')</th>
                                    <th>@lang('Win Level')</th>
                                    <th>@lang('Win Bonus')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($winners as $winner)
                                    <tr>
                                        <td>
                                            {{ @$winner->tickets->user->fullname }}
                                            <br>
                                            <a href="{{ route('admin.users.detail', $winner->tickets->user->id) }}">
                                               {{ @$winner->tickets->user->username }} </a>
                                        </td>
                                        <td> {{ $winner->tickets->lottery->name }}</td>
                                        <td> @lang('Phase') - {{ $winner->tickets->phase->phase_number }}</td>
                                        <td><strong>{{ $winner->ticket_number }}</strong></td>
                                        <td>@lang('Level') {{ $winner->level }}</td>
                                        <td> {{ getAmount($winner->win_bonus) }} {{ $general->cur_text }}</td>
                                    @empty
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($winners->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($winners) }}
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush
