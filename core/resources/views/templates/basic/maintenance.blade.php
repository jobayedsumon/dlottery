@extends($activeTemplate . 'layouts.app')
@section('panel')
    <section class="maintenance-page flex-column align-items-center justify-content-center mt-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 text-center">
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-8 col-lg-12 mt-3">
                            <img class="img-fluid mx-auto mb-5" src="{{ getImage('assets/images/maintenance.png') }}" alt="@lang('image')">
                        </div>
                    </div>
                    <p class="mx-auto text-center">@php echo $maintenance->data_values->description @endphp</p>
                </div>
            </div>
        </div>
    </section>
@endsection
