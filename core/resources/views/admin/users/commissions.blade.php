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
                                    <th>@lang('Date')</th>
                                    <th>@lang('Trx.')</th>
                                    <th>@lang('Percent')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Level')</th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $data)
                                    <tr>
                                        <td> {{ showDateTime($data->created_at) }}<br>{{ diffForHumans($data->created_at) }}</td>
                                        <td> {{ $data->trx }} </td>
                                        <td> {{ showAmount($data->percent, 0) }}%</td>
                                        <td> {{ showAmount($data->amount) }} {{ __($general->cur_text) }}</td>
                                        <td>
                                            @if($data->commission_type == 'deposit_commission')
                                        <span class="badge badge--success">@lang('Deposit')</span>
                                        @elseif($data->type == 'buy_commission')
                                        <span class="badge badge--info">@lang('Buy')</span>
                                        @else
                                        <span class="badge badge--primary">@lang('Win')</span>
                                        @endif
                                        </td>
                                        <td>{{__(ordinal($data->level))}}</td>
                                        <td>{{ __($data->title) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    @if ($logs->hasPages())
                        {{ paginateLinks($logs) }}
                    @endif
                </div>

            </div><!-- card end -->
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-search-form />

    <div class="activeColor">
        <a href="@if (request()->routeIs('admin.users.commissions.deposit')) javascript:void(0) @else {{ route('admin.users.commissions.deposit',$user->id) }} @endif"
            class="btn btn-sm btn-outline--primary h-45 {{ menuActive('admin.users.commissions.deposit',$user->id) }}
        @if (request()->routeIs('admin.users.commissions.deposit')) btn-disabled @endif"><i
                class="la la-hand-holding-usd"></i>@lang('Deposit Commission')</a>
        <a href="@if (request()->routeIs('admin.users.commissions.buy')) javascript:void(0) @else {{ route('admin.users.commissions.buy',$user->id) }} @endif "
            class="btn btn-sm btn-outline--primary h-45 {{ menuActive('admin.users.commissions.buy',$user->id) }} @if (request()->routeIs('admin.users.commissions.buy')) btn-disabled @endif "><i
                class="la la-shopping-bag"></i> @lang('Buy Commission')</a>
        <a href=" @if (request()->routeIs('admin.users.commissions.win')) javascript:void(0)  @else {{ route('admin.users.commissions.win',$user->id) }} @endif "
            class="btn btn-sm btn-outline--primary h-45 {{ menuActive('admin.users.commissions.win',$user->id) }} @if (request()->routeIs('admin.users.commissions.win',$user->id)) btn-disabled @endif "><i
                class="las la-trophy"></i>@lang('Win Commission')</a>
    </div>
@endpush

@push('style')
    <style>
        .activeColor a.active {
            background-color: #4634ff;
            color: white;
        }
    </style>
@endpush
