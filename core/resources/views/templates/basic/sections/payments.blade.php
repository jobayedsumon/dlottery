@php
    $payments_content = getContent('payments.content', true);
    $payments_elements = getContent('payments.element');
@endphp

<section class="pt-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title">{{ __(@$payments_content->data_values->heading) }}</h2>
                    <p class="mt-3">{{ __(@$payments_content->data_values->sub_heading) }}</p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-slider">
                    @foreach ($payments_elements as $item)
                        <div class="single-slide">
                            <div class="brand-item">
                                <img src="{{ getImage('assets/images/frontend/payments/' . @$item->data_values->image, '64x50') }}" alt="image">
                            </div><!-- brand-item end -->
                        </div>
                    @endforeach
                </div>
            </div>
            @guest
                <div class="col-lg-12 mt-5 text-center">
                    <a class="btn btn--base btn--capsule" href="{{ route('user.register') }}">@lang('Create an Account')</a>
                </div>
            @endguest
        </div>
    </div>
</section>
