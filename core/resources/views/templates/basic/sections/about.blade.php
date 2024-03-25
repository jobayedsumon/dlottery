@php
    $about = getContent('about.content', true);
@endphp
<section class="pt-100 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-thumb">
                    <img src="{{ getImage('assets/images/frontend/about/' . @$about->data_values->image, '636x358') }}" alt="image">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 mt-lg-0">
                <h2 class="section-title">{{ __(@$about->data_values->heading) }}</h2>
                {{ __(@$about->data_values->description) }}
            </div>
        </div>
    </div>
</section>
