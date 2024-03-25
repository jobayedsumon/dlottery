@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-30">
                    <table class="table-responsive--md custom--table table">
                        <thead>
                            <tr>
                                <th>@lang('S.N.')</th>
                                <th>@lang('Lottery Name')</th>
                                <th>@lang('Phase Number')</th>
                                <th>@lang('Ticket')</th>
                                <th>@lang('Result')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td>{{ $tickets->firstItem() + $loop->index }}</td>
                                    <td>{{ __($ticket->lottery->name) }}</td>
                                    <td>@lang('Phase ' . $ticket->phase->phase_number)</td>
                                    <td class="text-center">
                                        {{ $ticket->ticket_number }}
                                    </td>
                                    <td>
                                        @php
                                            echo $ticket->statusBadge;
                                        @endphp
                                    </td>
                                @empty
                                    <td class="rounded-bottom text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        @if ($tickets->hasPages())
                            {{ paginateLinks($tickets) }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
