@extends($activeTemplate .'layouts.frontend')
@section('content')
<div class="container pb-100 pt-100">
    <div class="row justify-content-center">
        <div class="col-md-8    ">
            <div class="card custom__bg">
                <div class="card-body">
                    <h3 class="text-center text-danger">@lang('You are banned')</h3>
                    <p class="fw-bold mb-1">@lang('Reason'):</p>
                    <p>{{ $user->ban_reason }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
