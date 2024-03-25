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
                                <th scope="col">@lang('S.N.')</th>
                                <th scope="col">@lang('Fullname')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Phone')</th>
                                <th scope="col">@lang('Joined At')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($referrals as $referral)
                                <tr>
                                    <td> {{ $referrals->firstItem()+ $loop->index }}
                                    </td>
                                    <td>{{ __($referral->fullname) }}
                                    <td>{{ __($referral->email) }}
                                    <td>{{ __($referral->mobile) }}
                                    </td>
                                    <td>{{ showDateTime($referral->created_at) }}</td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if($referrals->hasPages())
              <div class="card-footer py-4">
                  {{ paginateLinks($referrals) }}
              </div>
              @endif
            </div>
        </div>
    </div>
@endsection


