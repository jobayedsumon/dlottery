@extends('admin.layouts.app')
@section('panel')
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="border-line-area my-3">
                        <h6 class="border-line-title">@lang('CURRENT SETTING')</h6>
                    </div>
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Winner')</th>
                                    <th>@lang('Win Bonus')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($lottery->bonuses as $key => $p)
                                    <tr>
                                        <td>@lang('Winner#') {{ $p->level }}</td>
                                        <td>{{ $p->amount }} {{ __($general->cur_text) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card parent">
                <div class="card-body">

                    <div class="border-line-area mt-3">
                        <h6 class="border-line-title">@lang('Update Setting')</h6>
                    </div>

                    <div class="form-group">
                        <label>@lang('Number of Level')</label>
                        <div class="input-group">
                            <input class="form-control" name="level" type="number" min="1" placeholder="@lang('Type a number & hit ENTER')↵">
                            <button class="btn btn--primary generate" type="button">@lang('Generate')</button>
                        </div>
                        <span class="text--danger required-message d-none">@lang('Please enter a number')</span>
                    </div>

                    <form class="d-none levelForm" action="{{ route('admin.lottery.bonus') }}" method="post">
                        @csrf
                        <input name="lottery_id" type="hidden" value="{{ $lottery->id }}">
                        <h6 class="text--danger mb-3">@lang('The Old setting will be removed after generating new')</h6>
                        <div class="form-group">
                            <div class="winBonusLevelAmount"></div>
                        </div>
                        <button class="btn btn--primary h-45 w-100" type="submit">@lang('Submit')</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection
@push('breadcrumb-plugins')
    @if ($lottery->bonuses->count())
        <a class="btn btn-sm btn-outline--warning float-sm-end" href="{{ route('admin.lottery.phase.single.lottery', $lottery->id) }}"> <i class="las la-layer-group"></i>@lang('Set Lottery Phase')</a>
    @endif
    <x-back route="{{ route('admin.lottery.index') }}" />
@endpush

@push('style')
    <style>
        .border-line-area {
            position: relative;
            text-align: center;
            z-index: 1;
        }

        .border-line-area::before {
            position: absolute;
            content: '';
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #e5e5e5;
            z-index: -1;
        }

        .border-line-title {
            display: inline-block;
            padding: 3px 10px;
            background-color: #fff;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"

            $('[name="level"]').on('focus', function() {
                $(this).on('keyup', function(e) {
                    if (e.which == 13) {
                        generrateLevels($(this));
                    }
                });
            });

            $(".generate").on('click', function() {
                let $this = $(this).parents('.card-body').find('[name="level"]');
                generrateLevels($this);
            });

            $(document).on('click', '.deleteBtn', function() {
                $(this).closest('.input-group').remove();
                $.each($('.level-index'), function(i, e) {
                    $(e).text(`@lang('Winner Level') ${i + 1}`)
                });

            });

            function generrateLevels($this) {
                let numberOfLevel = $this.val();
                let parent = $this.parents('.card-body');
                let html = '';
                if (numberOfLevel && numberOfLevel > 0) {
                    parent.find('.levelForm').removeClass('d-none');
                    parent.find('.required-message').addClass('d-none');

                    for (i = 1; i <= numberOfLevel; i++) {
                        html += `
                    <div class="input-group mb-3">
                        <span class="input-group-text justify-content-center"> <span class="level-index">@lang('Winner Level') ${i}</span></span>
                        <input name="amount[]" class="form-control col-5" type="number" step="any" required placeholder="@lang('Won Bonus Amount, By') {{ $general->cur_text }}" >
                        <button class="btn btn--danger input-group-text border-0 deleteBtn" type="button"><i class=\'la la-times\'></i></button>
                    </div>`
                    }

                    parent.find('.winBonusLevelAmount').html(html);
                } else {
                    parent.find('.levelForm').addClass('d-none');
                    parent.find('.required-message').removeClass('d-none');
                }
            }

        })(jQuery);
    </script>
@endpush
