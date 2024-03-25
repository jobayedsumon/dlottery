@extends($activeTemplate.'layouts.master')
@section('content')
<div class="container pt-100 pb-100">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom__bg">
                    <div class="card-body">
                        <form action="{{route('user.kyc.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <x-viser-form identifier="act" identifierValue="kyc" />

                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
