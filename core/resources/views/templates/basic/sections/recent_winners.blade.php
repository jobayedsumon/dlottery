@php
    $content = getContent('recent_winners.content', true);
    $recentWinners = \App\Models\Winner::orderBy('id', 'desc')
        ->limit(8)
        ->with('user')
        ->get();
@endphp

@if ($recentWinners->count())
    <section class="pt-120 pb-120 border-top-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-header">
                        <h2 class="section-title"><span class="font-weight-normal">{{ __(@$content->data_values->heading) }}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gy-4">
                @foreach ($recentWinners as $k => $data)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="recent-winner-card">
                            <span class="recent-winner-card__number">{{ ordinal($loop->iteration) }}</span>
                            <h5 class="recent-winner-card__name">{{ $data->user->fullname }}</h5>
                            <h6 class="name">{{ @json_decode(json_encode($data->user->username)) }}</h6>
                            <span class="amount f-size-14">@lang('Win') - {{ $general->cur_sym }}{{ showAmount($data->win_bonus) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('style')
        <style>
            .recent-winner-card {
                background-color: #20204e;
                border: 1px solid #36eef3;
                box-shadow: inset 0 0 15px #37f5f9d9;
                padding: 25px;
                transition: all 0.3s;
                position: relative;
                overflow: hidden;
                border-radius: 6px;
                transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, border-radius .15s ease;
            }

            .recent-winner-card::before {
                position: absolute;
                content: "";
                width: 100px;
                height: 100px;
                right: -15px;
                bottom: -24%;
                background-color: #094e98;
                border-radius: 46% 54% 55% 45% / 35% 38% 62% 65%;
                transform: rotate(-38deg);
            }

            .recent-winner-card__number {
                position: absolute;
                right: 25px;
                font-size: 25px;
                color: #9c9898;
                font-weight: 900;
                top: 15px;
                transition: .2s linear;
            }

            .recent-winner-card__name {
                margin-bottom: 10px;
            }

            .recent-winner-card .amount {
                color: #37f5f9;
                font-weight: 400;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: "Josefin Sans", sans-serif;
                color: #e9e4e4;
                font-weight: 400;
                margin: 0;
                line-height: 1.3;
            }

            h5 {
                font-size: 20px;
            }
        </style>
    @endpush
@endif
