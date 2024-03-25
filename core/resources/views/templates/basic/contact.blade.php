@php
    $contact = getContent('contact_us.content', true);
@endphp
@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="pt-100 pb-50">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-lg-4">
                    <h2 class="mb-3">{{ __(@$contact->data_values->title) }}</h2>
                    <p>{{ __(@$contact->data_values->short_details) }}</p>
                    <div class="row gy-4 mt-3">
                        <div class="col-lg-12">
                            <div class="contact-info-card rounded-3">
                                <h6 class="mb-3">@lang('Office Address')</h6>
                                <div class="contact-info d-flex">
                                    <i class="las la-map-marked-alt"></i>
                                    <p>{{ __(@$contact->data_values->address) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-info-card rounded-3">
                                <h6 class="mb-3">@lang('Phone Number')</h6>
                                <div class="contact-info d-flex">
                                    <i class="las la-phone-volume"></i>
                                    <p><a href="tel:{{ @$contact->data_values->contact_number }}">{{ @$contact->data_values->contact_number }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-info-card rounded-3">
                                <h6 class="mb-3">@lang('Email Address')</h6>
                                <div class="contact-info d-flex">
                                    <i class="las la-envelope"></i>
                                    <p><a href="mailto:{{ @$contact->data_values->email_address }}">{{ @$contact->data_values->email_address }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- row end -->

                </div>
                <div class="col-lg-8 ps-lg-5">
                    <div class="contact-wrapper rounded-3">
                        <form class="contact-form verify-gcaptcha" method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label>@lang('Name')</label>
                                    <div class="custom--field">
                                        <input class="form--control" name="name" type="text" value="@if (auth()->user()) {{ auth()->user()->fullname }} @else{{ old('name') }} @endif" @if (auth()->user()) readonly @endif required>
                                        <i class="las la-user"></i>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>@lang('Email')</label>
                                    <div class="custom--field">
                                        <input class="form--control" name="email" type="email" value="@if (auth()->user()) {{ auth()->user()->email }}@else{{ old('email') }} @endif" @if (auth()->user()) readonly @endif required>
                                        <i class="las la-envelope"></i>
                                    </div>
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label>@lang('Subject')</label>
                                    <div class="custom--field">
                                        <input class="form--control" name="subject" type="text" value="{{ old('subject') }}" required>
                                        <i class="las la-pen"></i>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label>@lang('Message')</label>
                                    <div class="custom--field">
                                        <textarea class="form--control" name="message" wrap="off" required>{{ old('message') }}</textarea>
                                        <i class="las la-envelope"></i>
                                    </div>
                                </div>

                                <x-captcha path="{{ $activeTemplate . 'partials' }}" />

                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
