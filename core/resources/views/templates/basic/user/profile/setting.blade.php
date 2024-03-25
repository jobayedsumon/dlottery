@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12">
                    <div class="card custom__bg">
                        <div class="card-body">
                            <form class="register prevent-double-click" action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="InputFirstname">@lang('First Name'):</label>
                                        <input class="form--control" id="InputFirstname" name="firstname" type="text" value="{{ $user->firstname }}" placeholder="@lang('First Name')" minlength="3">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="lastname">@lang('Last Name'):</label>
                                        <input class="form--control" id="lastname" name="lastname" type="text" value="{{ $user->lastname }}" placeholder="@lang('Last Name')" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="email">@lang('E-mail Address'):</label>
                                        <input class="form--control" id="email" value="{{ $user->email }}" placeholder="@lang('E-mail Address')" disabled>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="phone">@lang('Mobile Number')</label>
                                        <input class="form--control" id="phone" value="{{ $user->mobile }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="address">@lang('Address'):</label>
                                        <input class="form--control" id="address" name="address" type="text" value="{{ @$user->address->address }}" placeholder="@lang('Address')" required="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="state">@lang('State'):</label>
                                        <input class="form--control" id="state" name="state" type="text" value="{{ @$user->address->state }}" placeholder="@lang('state')" required="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label" for="zip">@lang('Zip Code'):</label>
                                        <input class="form--control" id="zip" name="zip" type="text" value="{{ @$user->address->zip }}" placeholder="@lang('Zip Code')" required="">
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label" for="city">@lang('City'):</label>
                                        <input class="form--control" id="city" name="city" type="text" value="{{ @$user->address->city }}" placeholder="@lang('City')" required="">
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label">@lang('Country'):</label>
                                        <input class="form--control" value="{{ @$user->address->country }}" disabled>
                                    </div>

                                </div>

                                <div class="form-group row pt-5">
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
