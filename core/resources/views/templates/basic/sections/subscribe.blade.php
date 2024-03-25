@php
    $subscribe = getContent('subscribe.content', true);
@endphp

<section class="pb-100">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                <div class="subscribe-wrapper bg_img" data-background="assets/images/bg/arrow.png">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <h2 class="title">{{ __(@$subscribe->data_values->heading) }}</h2>
                        </div>
                        <div class="col-lg-7 mt-lg-0 mt-4">
                            <form class="subscribe-form" action="{{ route('subscribe') }}" method="post">
                                @csrf
                                <input class="form--control" name="email" type="email" autocomplete="off" placeholder="Email Address">
                                <button class="btn btn-md btn--base btn--capsule">@lang('Subscribe')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script type="text/javascript">
        $('.subscribe-form').on('submit', function(e) {
            e.preventDefault();
            let url = `{{ route('subscribe') }}`;

            let data = {
                email: $(this).find('input[name=email]').val()
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`
                }
            });

            $.post(url, data, function(response) {
                if (response.errors) {
                    for (var i = 0; i < response.errors.length; i++) {
                        iziToast.error({
                            message: response.errors[i],
                            position: "topRight"
                        });
                    }
                } else {
                    $('.subscribe-form').trigger("reset");
                    iziToast.success({
                        message: response.success,
                        position: "topRight"
                    });
                }
            });
            this.reset();
        })
    </script>
@endpush
