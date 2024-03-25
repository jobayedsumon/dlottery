@php
    $policyPages = getContent('policy_pages.element', false, null, true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="{{ asset($activeTemplateTrue . 'images/ball-1.png') }}" alt="image"></div>
        <div class="ball-2"><img src="{{ asset($activeTemplateTrue . 'images/ball-2.png') }}" alt="image"></div>
        <div class="ball-3"><img src="{{ asset($activeTemplateTrue . 'images/ball-3.png') }}" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="account-wrapper">
                        <form class="account-form verify-gcaptcha" action="{{ route('user.register') }}" method="POST">
                            @csrf
                            <div class="account-thumb-area text-center">
                                <h3 class="title">@lang('Welcome to') {{ $general->site_name }}</h3>
                            </div>

                            <div class="row">
                                @if (session()->get('reference') != null)
                                    <div class="form-group col-12">
                                        <label for="referenceBy">@lang('Reference By') <sup class="text-danger">*</sup></label>
                                        <div class="custom--field">
                                            <input class="form--control" id="referenceBy" name="referBy" type="text" value="{{ session()->get('reference') }}" readonly>
                                            <i class="las la-user-alt"></i>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group col-lg-6">
                                    <label for="username">@lang('Username')</label>
                                    <div class="custom--field">
                                        <input class="form--control checkUser" id="username" name="username" type="text" value="{{ old('username') }}" required>
                                        <i class="las la-user"></i>
                                    </div>
                                    <small class="text-danger usernameExist"></small>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email">@lang('E-Mail Address')</label>
                                    <div class="custom--field">
                                        <input class="form--control checkUser" id="email" name="email" type="email" value="{{ old('email') }}" required>
                                        <i class="las la-envelope-open"></i>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="country">@lang('Country')</label>
                                    <div class="custom--field">
                                        <select class="form--control" id="country" name="country" required>
                                            @foreach ($countries as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}" data-code="{{ $key }}" value="{{ $country->country }}">
                                                    {{ __($country->country) }}</option>
                                            @endforeach
                                        </select>
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="mobile">@lang('Mobile Number')</label>
                                    <div class="input-group">
                                        <span class="input-group-text mobile-code"></span>
                                        <input name="mobile_code" type="hidden">
                                        <input name="country_code" type="hidden">
                                        <input class="form--control border-start-0 checkUser" id="mobile" name="mobile" type="text" value="{{ old('mobile') }}" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="password">@lang('Password')</label>
                                    <div class="custom--field">
                                        <input class="form--control" id="password" name="password" type="password" required>
                                        @if ($general->secure_password)
                                            <div class="input-popup">
                                                <p class="error lower">@lang('1 small letter minimum')</p>
                                                <p class="error capital">@lang('1 capital letter minimum')</p>
                                                <p class="error number">@lang('1 number minimum')</p>
                                                <p class="error special">@lang('1 special character minimum')</p>
                                                <p class="error minimum">@lang('6 character password')</p>
                                            </div>
                                        @endif
                                        <i class="las la-key"></i>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="password-confirm">@lang('Confirm Password')</label>
                                    <div class="custom--field">
                                        <input class="form--control" id="password-confirm" name="password_confirmation" type="password" autocomplete="password" required>
                                        <i class="las la-key"></i>
                                    </div>
                                </div>

                                <div class="py-3">
                                    <x-captcha path="{{ $activeTemplate . 'partials' }}" />
                                </div>

                                @if ($general->agree)
                                    <div class="form-group col-lg-12">
                                        <input id="agree" name="agree" type="checkbox" required>
                                        <label for="agree">@lang('I agree with') <span class="text--base">
                                                @foreach ($policyPages as $policy)
                                                    <a class="text--base" href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}">{{ __($policy->data_values->title) }}</a>
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                        </label> </span>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <button class="btn btn--base w-100 mt-3" id="recaptcha" type="submit">@lang('Register')</button>
                                    <p class="mt-3 text-center"><span class="text-white">@lang('Have an account') ?</span> <a
                                            class="text--base" href="{{ route('user.login') }}">@lang('Login')</a>
                                    </p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="existModalCenter" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn--danger text-white" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                    <a class="btn btn-sm btn--base" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
