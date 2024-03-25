@extends($activeTemplate . 'layouts.master')

@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="mb-3 text-end">

                        <div class="show-filter mb-3 text-end">
                            <button class="btn btn--base showFilterBtn btn-sm" type="button"><i class="las la-filter"></i>
                                @lang('Filter')</button>
                        </div>
                        <div class="card responsive-filter-card custom__bg mb-4">
                            <div class="card-body">
                                <form action="">
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="flex-grow-1">
                                            <label>@lang('Transaction Number')</label>
                                            <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label>@lang('Type')</label>
                                            <select class="form-select form-control" name="commission_type">
                                                <option value="">@lang('All')</option>
                                                <option value="deposit_commission" @selected(request()->commission_type == 'deposit_commission')>
                                                    @lang('Deposit Commission')</option>
                                                <option value="buy_commission" @selected(request()->commission_type == 'buy_commission')>
                                                    @lang('Buying Commission')</option>
                                                <option value="win_commission" @selected(request()->commission_type == 'win_commission')>
                                                    @lang('Win Commission')</option>
                                            </select>
                                        </div>

                                        <div class="flex-grow-1 align-self-end">
                                            <button class="btn btn--base w-100"><i class="las la-filter"></i>
                                                @lang('Filter')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive--md">
                                <table class="custom--table table">
                                    <thead>
                                        <tr>
                                            <th>@lang('S.N.')</th>
                                            <th>@lang('Commission From')</th>
                                            <th>@lang('Commission Level')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang('Title')</th>
                                            <th>@lang('Transaction')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($commissions as $log)
                                            <tr>
                                                <td>{{ $commissions->firstItem() + $loop->index }}</td>
                                                <td>{{ $log->userFrom->username }}</td>
                                                <td>{{ $log->level }}</td>
                                                <td>{{ getAmount($log->amount) }} {{ $general->cur_text }}</td>
                                                <td>{{ __($log->title) }}</td>
                                                <td>{{ $log->trx }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="rounded-bottom text-center" colspan="100%"> {{ __($emptyMessage) }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($commissions->hasPages())
                                <div class="card-footer">
                                    {{ $commissions->links() }}
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <style>
        .responsive-filter-card label {
            width: 100%;
            text-align: left;
        }
    </style>
@endpush
