@php
    $counters = getContent('counter.element', false, 3, true);
@endphp

<div class="overview-section pb-50">
    <div class="container">
        <div class="row gy-sm-0 gy-4 overview-wrapper wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            @foreach ($counters as $counter)
                <div class="col-sm-4 overview-item">
                    <div class="overview-card">
                        <div class="overview-card__icon">
                            @php echo @$counter->data_values->icon @endphp
                        </div>
                        <div class="overview-card__content">
                            <h3 class="amount text--base text-shadow--base">{{ __(@$counter->data_values->number) }}</h3>
                            <p>{{ __(@$counter->data_values->title) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
