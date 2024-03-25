@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-wrapper">
                        <div class="blog-details__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '') }}" alt="image">
                            <div class="post__date">
                                <span class="date">{{ showDateTime($blog->created_at, 'd') }}</span>
                                <span class="month">{{ showDateTime($blog->created_at, 'M') }}</span>
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h4 class="blog-details__title mb-3">{{ __(@$blog->data_values->title) }}</h4>

                            @php echo @$blog->data_values->description_nic @endphp

                        </div>
                    </div>

                    @if (\App\Models\Extension::where('act', 'fb-comment')->where('status', 1)->first())
                        <div class="comment-form-area">
                            <h3 class="title">@lang('Live a Comment')</h3>

                            <div class="fb-comments" data-href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" data-numposts="5"></div>
                        </div>
                    @endif

                </div>
                <div class="col-lg-4 pl-lg-5">
                    <div class="sidebar">

                        <div class="widget">
                            <h3 class="widget-title">@lang('Recent Blog Posts')</h3>
                            <ul class="small-post-list">

                                @foreach ($recentBlogs as $item)
                                    <li class="small-post-single">
                                        <div class="thumb"><img src="{{ getImage('assets/images/frontend/blog/' . @$item->data_values->image, '') }}" alt="image"></div>
                                        <div class="content">
                                            <h6 class="post-title"><a href="{{ route('blog.details', [slug($item->data_values->title), $item->id]) }}"> {{ __(@$item->data_values->title) }}</a></h6>
                                            {{ showDateTime($item->created_at) }}
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush
