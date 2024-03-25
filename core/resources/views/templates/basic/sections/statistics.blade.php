@php
    $content = getContent('statistics.content', true);
    $time = \Carbon\Carbon::now()->toDateTimeString();
    $phases = \App\Models\Phase::where('status', Status::ENABLE)
        ->where('draw_status', Status::COMPLETE)
        ->where('start_date', '<', $time)
        ->orderBy('draw_date')
        ->whereHas('lottery', function ($lottery) {
            $lottery->where('status', Status::ENABLE);
        })
        ->limit(3)
        ->with('lottery', 'winners')
        ->get();
@endphp
@if ($phases->count())
    <section class="pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-header">
                        <h2 class="section-title">{{ __(@$content->data_values->heading) }}</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                @foreach ($phases as $phase)
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-card__header">
                                <div class="thumb"><img src="{{ getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery')) }}" alt="image"></div>
                                <div class="content">
                                    <h3 class="title">{{ __($phase->lottery->name) }}</h3>
                                </div>
                            </div>
                            <ul class="caption-list-two mt-3">
                                <li>
                                    <span class="caption">@lang('Total Bet')</span>
                                    <span class="value text--base text-end">{{ $phase->sold }}</span>
                                </li>
                                <li>
                                    <span class="caption">@lang('Draw Date')</span>
                                    <span class="value text--base text-end">{{ showDateTime($phase->draw_date, 'd/m/y') }}</span>
                                </li>
                                <li>
                                    <span class="caption">@lang('Winners')</span>
                                    <span class="value text--base text-end">{{ @$phase->winners->count() }}</span>
                                </li>
                            </ul>
                        </div><!-- stat-card end -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-header">
                        <h2 class="section-title">{{ __(@$content->data_values->heading) }}</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                @foreach ($phases as $phase)
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-card__header">
                                <div class="thumb"><img src="{{ getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery')) }}" alt="image"></div>
                                <div class="content">
                                    <h3 class="title">{{ __($phase->lottery->name) }}</h3>
                                </div>
                            </div>
                            <ul class="caption-list-two mt-3">
                                <li>
                                    <span class="caption">@lang('Total Bet')</span>
                                    <span class="value text--base text-end">{{ $phase->sold }}</span>
                                </li>
                                <li>
                                    <span class="caption">@lang('Draw Date')</span>
                                    <span class="value text--base text-end">{{ showDateTime($phase->draw_date, 'd/m/y') }}</span>
                                </li>
                                <li>
                                    <span class="caption">@lang('Winners')</span>
                                    <span class="value text--base text-end">{{ @$phase->winners->count() }}</span>
                                </li>
                            </ul>
                        </div><!-- stat-card end -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endif
