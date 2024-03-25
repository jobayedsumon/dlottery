@php
    $socialIcons = getContent('social_icon.element', false, null, true);
    $policyPages = getContent('policy_pages.element', false, null, true);
@endphp

<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-3 text-md-start text-center">
                <a class="footer-logo" href="{{ route('home') }}"><img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="image"></a>
            </div>
            <div class="col-lg-10 col-md-9 mt-md-0 mt-3">
                <ul class="inline-menu d-flex justify-content-md-end justify-content-center align-items-center flex-wrap">
                    <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                    <li><a href="{{ route('lottery') }}">@lang('Lotteries')</a></li>

                    @if (@$pages)
                        @foreach ($pages as $k => $data)
                            <li><a href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
                        @endforeach
                    @endif

                    @foreach ($policyPages as $page)
                        <li><a href="{{ route('policy.pages', [slug($page->data_values->title), $page->id]) }}">{{ __($page->data_values->title) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr class="mt-3">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center">
                <span class="footer-content__left-text"> @lang('Copyright') &copy;
                    {{ now()->format('Y') }}, @lang('All Right Reserved By')
                    <a class="text--base" href="{{ route('home') }}">{{ @$general->site_name }}.</a>
                </span>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <ul class="inline-social-links d-flex align-items-center justify-content-md-end justify-content-center">
                    @forelse($socialIcons as $icon)
                        <li><a href="{{ @$icon->data_values->url }}" target="_blank">@php echo @$icon->data_values->social_icon @endphp</a></li>
                    @empty
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</footer>
