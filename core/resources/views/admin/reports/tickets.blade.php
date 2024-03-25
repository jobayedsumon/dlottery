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
                                    <th>@lang('LotteryPhase')</th>
                                    <th>@lang('Tickets')</th>
                                    <th>@lang('Draw Status')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <span class="font-weight-bold">{{ @$ticket->user->fullname }}</span>
                                            <br>
                                            <span class="small"> <a
                                                    href="{{ route('admin.users.detail', $ticket->user_id) }}"><span>@</span>{{ @$ticket->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            {{ __($ticket->lottery->name) }} <br>
                                            @lang('Phase') {{ __($ticket->phase->phase_number) }}
                                        </td>
                                        <td class="text-center" data-label="@lang('Tickets')">
                                            <strong>{{ $ticket->ticket_number }}</strong>
                                        </td>
                                        <td> @php echo $ticket->statusBadge; @endphp </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($tickets->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($tickets) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush
