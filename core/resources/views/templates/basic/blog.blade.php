@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <!-- blog section start -->
    <section class="pt-100 pb-50">
        <div class="container">
            <div class="row justify-content-center mb-none-30">
                @forelse($blogs as $item)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="blog-card">
                            <div class="blog-card__thumb">
                                <img src="{{ getImage('assets/images/frontend/blog/' . @$item->data_values->image, '768x512') }}" alt="image">
                            </div>
                            <div class="blog-card__content">
                                <h4 class="blog-card__title mb-3"><a
                                        href="{{ route('blog.details', [slug($item->data_values->title), $item->id]) }}">{{ __(strLimit(@$item->data_values->title, 66)) }}</a>
                                </h4>
                                <ul class="blog-card__meta d-flex mb-4 flex-wrap">
                                    <li>
                                        <i class="las la-calendar"></i>
                                        {{ showDateTime($item->created_at) }}
                                    </li>
                                </ul>
                                <p>{{ __(@$item->data_values->short_description) }}</p>
                                <a class="btn btn--base mt-4" href="{{ route('blog.details', [slug($item->data_values->title), $item->id]) }}">@lang('Read More')</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center"> {{ __($emptyMessage) }}</div>
                @endforelse

            </div>
            @if ($blogs->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ paginateLinks($blogs) }}
                </div>
            @endif
            <div>
            </div>
        </div>
    </section>
    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
    <!-- blog section end -->
@endsection
