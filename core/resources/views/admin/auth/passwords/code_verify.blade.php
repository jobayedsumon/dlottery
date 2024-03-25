@extends('admin.layouts.master')
@section('content')
    <div class="login-main" style="background-image: url('{{ asset('assets/admin/images/login.jpg') }}')">
        <div class="custom-container d-flex justify-content-center container">
            <div class="login-area">
                <div class="mb-3 text-center">
                    <h2 class="mb-2 text-white">@lang('Verify Code')</h2>
                    <p class="mb-2 text-white">@lang('Please check your email and enter the verification code you got in your email.')</p>
                </div>
                <form class="login-form w-100" action="{{ route('admin.password.verify.code') }}" method="POST">
                    @csrf

                    <div class="code-box-wrapper d-flex w-100">
                        <div class="form-group flex-fill mb-3">
                            <span class="fw-bold text-white">@lang('Verification Code')</span>
                            <div class="verification-code">
                                <input class="overflow-hidden" name="code" type="text" autocomplete="off">
                                <div class="boxes">
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap">
                        <a class="forget-text" href="{{ route('admin.password.reset') }}">@lang('Try to send again')</a>
                    </div>
                    <button class="btn cmn-btn w-100 mt-4" type="submit">@lang('Submit')</button>
                </form>
                <a class="mt-4 text-white" href="{{ route('admin.login') }}"><i class="las la-sign-in-alt" aria-hidden="true"></i>@lang('Back to Login')</a>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link href="{{ asset('assets/admin/css/verification_code.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script>
        (function($) {
            'use strict';
            $('[name=code]').on('input', function() {

                $(this).val(function(i, val) {
                    if (val.length >= 6) {
                        $('form').find('button[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                        $('form').find('button[type=submit]').removeClass('disabled');
                        $('form')[0].submit();
                    } else {
                        $('form').find('button[type=submit]').addClass('disabled');
                    }
                    if (val.length > 6) {
                        return val.substring(0, val.length - 1);
                    }
                    return val;
                });

                for (let index = $(this).val().length; index >= 0; index--) {
                    $($('.boxes span')[index]).html('');
                }
            });

        })(jQuery)
    </script>
@endpush
