@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="{{ asset($activeTemplateTrue . 'images/ball-1.png') }}" alt="image"></div>
        <div class="ball-2"><img src="{{ asset($activeTemplateTrue . 'images/ball-2.png') }}" alt="image"></div>
        <div class="ball-3"><img src="{{ asset($activeTemplateTrue . 'images/ball-3.png') }}" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="account-wrapper">

                        <div class="account-form">
                            <div class="mb-3">
                                <p>@lang('To recover your account please provide your email or username to find your account.')</p>
                            </div>
                            <form method="POST" action="{{ route('user.password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label>@lang('Email or Username')</label>
                                    <div class="custom--field">
                                        <input class="form--control" name="value" type="text" value="{{ old('value') }}" required autofocus="off">
                                        <i class="las la-user-cog"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
