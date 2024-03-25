@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                          <thead>
                          <tr>
                              <th>@lang('S.N.')</th>
                              <th>@lang('Lottery Name')</th>
                              <th>@lang('Phase Number')</th>
                              <th>@lang('Tickets')</th>
                              <th>@lang('Price')</th>
                              <th>@lang('Status')</th>
                          </tr>
                          </thead>
                          <tbody>
                            @forelse($tickets as $ticket)
                            <tr>
                              <th>{{ $tickets->firstItem() + $loop->index}}</th>
                              <td>{{ __($ticket->lottery->name) }}</td>
                              <td>@lang('Phase') {{ __($ticket->phase->phase_number) }}</td>
                              <td>
                                {{ $ticket->ticket_number }}
                              </td>
                              <td>
                                {{ showAmount($ticket->total_price) }}
                              </td>
                              <td>
                                @php
                                    echo $ticket->phase->DrawBadge;
                                @endphp
                              </td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                            </tr>
                              @endforelse
                          </tbody>
                      </table>
                  </div>
              </div>
              @if($tickets->hasPages())
              <div class="card-footer py-4">
                  {{ paginateLinks($tickets) }}
              </div>
              @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
   <x-search-form/>
@endpush
