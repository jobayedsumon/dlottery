@php
    $kycInstruction = getContent('kyc_instruction.content', true);
@endphp
@extends($activeTemplate . 'layouts.master')
@section('content')
    <!-- dashboard section start -->
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12">
                    @if (auth()->user()->kv == 0)
                        <div class="alert alert-danger p-3" role="alert">
                            <h4 class="alert-heading">@lang('KYC Verification required')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kycInstruction->data_values->verification_instruction) }} <a href="{{ route('user.kyc.form') }}">@lang('Click Here to Verify')</a></p>
                        </div>
                    @elseif(auth()->user()->kv == 2)
                        <div class="alert alert-warning p-3" role="alert">
                            <h4 class="alert-heading">@lang('KYC Verification pending')</h4>
                            <hr>
                            <p class="mb-0">{{ __($kycInstruction->data_values->pending_instruction) }} <a href="{{ route('user.kyc.data') }}">@lang('See KYC Data')</a></p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>@lang('Referral Link')</label>
                        <div class="input-group">
                            <input class="form--control referralURL" name="text" type="text" value="{{ route('home') }}?reference={{ auth()->user()->username }}" readonly>
                            <span class="input-group-text copytext copyBoard" id="copyBoard"> <i class="fa fa-copy"></i> </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-4 align-items-center mt-2">
                <div class="col-lg-3 col-sm-6">
                    <div class="balance-card">
                        <span class="text--dark">@lang('Total Balance')</span>
                        <h3 class="number text--dark">{{ __($general->cur_sym) }}{{ getAmount($user->balance) }}</h3>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span>@lang('Total Win')</span>
                        <a class="view--btn" href="{{ route('user.wins') }}">@lang('View log')</a>
                        <h3 class="number">{{ $user->wins->count() }}</h3>
                        <i class="las la-trophy icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span>@lang('Total Deposit')</span>
                        <a class="view--btn" href="{{ route('user.deposit.history') }}">@lang('View log')</a>
                        <h3 class="number">{{ __($general->cur_sym) }}{{ $user->deposits->sum('amount') + 0 }}</h3>
                        <i class="las la-dollar-sign icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span>@lang('Total Withdraw')</span>
                        <a class="view--btn" href="{{ route('user.withdraw.history') }}">@lang('View log')</a>
                        <h3 class="number">{{ __($general->cur_sym) }}{{ $user->withdrawals->where('status', 1)->sum('amount') + 0 }}</h3>
                        <i class="las la-hand-holding-usd icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
            </div><!-- row end -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-header text-center">
                                <h2 class="section-title">@lang('Waiting for Draw')</h2>
                            </div>
                        </div>
                    </div><!-- row end -->

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
            </div>
        </div>
    </section>
    <!-- dashboard section end -->
@endsection

@push('style-lib')
    <link type="text/css" href="{{ asset('assets/global/css/jquery.treeView.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script src="{{ asset('assets/global/js/jquery.treeView.js') }}"></script>
    <script>
        (function($) {
            "use strict"

            $('.treeview').treeView();
            $('.copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);

                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
@endpush
