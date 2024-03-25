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
                                    <th>@lang('User')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Percent | Amount')</th>
                                    <th>@lang('Trx.')</th>
                                    <th>@lang('Level')</th>
                                    <th>@lang('Description')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $data)
                                    <tr @if ($data->amount < 0) class="text--warning" @endif>
                                        <td>
                                            {{ @$data->userTo->fullname }}
                                            <br>
                                            <span class="small"> <a
                                                    href="{{ route('admin.users.detail', $data->to_id) }}"><span>@</span>{{ @$data->userTo->username }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            {{ showDateTime($data->created_at) }}<br>{{ diffForHumans($data->created_at) }}
                                        </td>
                                        <td>
                                            {{ getAmount($data->percent) }}%
                                            <br>
                                            {{ getAmount($data->amount) }} {{ __($general->cur_text) }}
                                        </td>
                                        <td>
                                            {{ $data->trx }}
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
        <a href="@if (request()->routeIs('admin.report.commissions.deposit')) javascript:void(0) @else {{ route('admin.report.commissions.deposit') }} @endif"
            class="btn btn-sm btn-outline--primary h-45 {{ menuActive('admin.report.commissions.deposit') }}
        @if (request()->routeIs('admin.report.commissions.deposit')) btn-disabled @endif"><i
                class="la la-hand-holding-usd"></i>@lang('Deposit Commission')</a>
        <a href="@if (request()->routeIs('admin.report.commissions.buy')) javascript:void(0) @else {{ route('admin.report.commissions.buy') }} @endif "
            class="btn btn-sm btn-outline--primary h-45 {{ menuActive('admin.report.commissions.buy') }} @if (request()->routeIs('admin.report.commissions.buy')) btn-disabled @endif "><i
                class="la la-shopping-bag"></i> @lang('Buy Commission')</a>
        <a href=" @if (request()->routeIs('admin.report.commissions.win')) javascript:void(0)  @else {{ route('admin.report.commissions.win') }} @endif "
            class="btn btn-sm btn-outline--primary h-45 {{ menuActive('admin.report.commissions.win') }} @if (request()->routeIs('admin.report.commissions.win')) btn-disabled @endif "><i
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
