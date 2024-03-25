@php
    $content = getContent('faq.content', true);
    $faqElements = getContent('faq.element', false, null, true);
@endphp
<!-- faq section start -->
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title"><span class="font-weight-normal">{{ __(@$content->data_values->heading) }}
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between gy-4">
            <div class="col-xxl-4 col-xl-5 col-lg-6 text-lg-start wow fadeInLeft text-center" data-wow-duration="0.5s" data-wow-delay="0.3s">
                <div class="faq-thumb">
                    <img src="{{ getImage('assets/images/frontend/faq/' . @$content->data_values->image, '364x500') }}" alt="image">
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
                <div class="accordion custom--accordion" id="faqAccordion">
                    @foreach($faqElements as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="h-{{ $loop->iteration }}">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#c-{{ $loop->iteration }}" type="button" aria-expanded="false" aria-controls="c-{{ $loop->iteration }}">
                                    {{ __(@$item->data_values->question) }}
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="c-{{ $loop->iteration }}" data-bs-parent="#faqAccordion" aria-labelledby="h-{{ $loop->iteration }}">
                                <div class="accordion-body">
                                    <p>{{ __(@$item->data_values->answer) }}</p>
                                </div>
                            </div>
                        </div><!-- accordion-item-->
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq section end -->
