@php
    $banner = getContent('banner.content', true);
@endphp

<section class="hero bg_img" style="background-image: url('{{ getImage('assets/images/frontend/banner/' . @$banner->data_values->background_image, '1920x983') }}');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-7 col-xl-8 col-lg-10 text-center">
                <h2 class="hero__title wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    {{ __(@$banner->data_values->heading) }}</h2>
                <p class="hero__description wow fadeInUp mt-3" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    {{ __(@$banner->data_values->subheading) }}</p>
                <a class="btn btn--base btn--capsule wow fadeInUp mt-4" data-wow-duration="0.5s" data-wow-delay="0.7s" href="{{ @$banner->data_values->button_url }}">{{ __(@$banner->data_values->button_name) }}</a>
            </div>
        </div>
    </div>
</section>
