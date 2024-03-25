@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('SL@')</th>
                                    <th>@lang('Image')</th>
                                    <th>@lang('Lottery Name | Phase Number ')</th>
                                    <th>@lang('Ticket Qty')</th>
                                    <th>@lang('Sold Tickets | Remaining Qty')</th>
                                    <th>@lang('Start Date | Draw Date')</th>
                                    <th>@lang('Draw Status | Draw Type')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($phases as $phase)
                                    <tr>
                                        <td>{{ $phases->firstItem() + $loop->index }}</td>
                                        <td>
                                            <div class="customer-details d-block">
                                                <a class="thumb" href="javascript:void(0)">
                                                    <img src="{{ getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery')) }}" alt="image">
                                                </a>
                                            </div>
                                        </td>
                                        <td><span class="fw-bold">{{ $phase->lottery->name }}</span>
                                            <br>
                                            @lang('Phase')# {{ $phase->phase_number }}
                                        </td>
                                        <td>{{ $phase->quantity }}</td>
                                        <td>
                                            <span class="fw-bold">{{ $phase->sold }}</span>
                                            <br>
                                            {{ $phase->available }}
                                        </td>

                                        <td>
                                            {{ showDateTime($phase->start_date, 'Y-M-d') }}
                                            <br>
                                            {{ showDateTime($phase->draw_date, 'Y-M-d') }}
                                        </td>
                                        <td>
                                            @php echo $phase->DrawBadge @endphp
                                            <br>
                                            @php echo $phase->DrawTypeBadge @endphp
                                        </td>
                                        <td> @php echo $phase->statusBadge @endphp </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary @if ($phase->draw_status == Status::RUNNING) cuModalBtn @endif" data-resource="{{ $phase }}" data-modal_title="@lang('Edit Lottery Phase')" type="button" @if ($phase->draw_status == Status::COMPLETE) disabled @endif>
                                                <i class="la la-pencil"></i>@lang('Edit')
                                            </button>
                                            @if ($phase->status == Status::ACTIVE)
                                                <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-id="{{ $phase->id }}" data-status="{{ $phase->status }}" @if ($phase->draw_status == Status::COMPLETE) disabled @endif>
                                                    <i class="la la-eye-slash"></i> @lang('Inactive')
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-id="{{ $phase->id }}" data-status="{{ $phase->status }}" @if ($phase->draw_status == Status::COMPLETE) disabled @endif>
                                                    <i class="la la-eye"></i> @lang('Active')
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">@lang('Please go to add new phase!')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($phases->hasPages())
                        <div class="card-footer py-4">
                            {{ paginateLinks($phases) }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span>@lang('Add Expense')</span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.lottery.phase.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            @if (!request()->routeIs('admin.lottery.phases'))
                                <label>@lang('Lottery')</label>
                                <input name="lottery_id" type="hidden" value="{{ $lottery->id }}">
                                <input class="form-control" type="text" value="{{ $lottery->name }}" disabled>
                            @else
                                <label>@lang('Lottery')</label>
                                <select class="form-control" name="lottery_id" required>
                                    <option value="" disabled selected>@lang('Select One')</option>
                                    @foreach ($lotteries as $lottery)
                                        <option data-running="{{ $lottery->isRunning }}" value="{{ $lottery->id }}">{{ $lottery->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>@lang('Start Date')</label>
                            <input class="modal-datepicker form-control bg--white" name="start_date" data-language="en" data-date-format="yyyy-mm-dd" type="text" value="{{ date('Y-m-d') }}" autocomplete="off" required>
                            <small class="text-muted text--small"> <i class="la la-info-circle"></i>
                                @lang('Year-Month-Date')</small>
                        </div>
                        <div class="form-group">
                            <label>@lang('Draw Date')</label>
                            <input class="datepicker-here form-control bg--white" name="draw_date" data-language="en" data-date-format="yyyy-mm-dd" type="text" value="{{ date('Y-m-d') }}" autocomplete="off" required>
                            <small class="text-muted text--small"> <i class="la la-info-circle"></i>
                                @lang('Year-Month-Date')</small>
                        </div>

                        <div class="form-group">
                            <label>@lang('Quantity')</label>
                            <input class="form-control" name="quantity" type="number" step="any" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Draw Type')</label>
                            <select class="form-control" name="draw_type" required>
                                <option value="" disabled selected>@lang('Select One')</option>
                                <option value="1">@lang('Auto Draw')</option>
                                <option value="2">@lang('Manual Draw')</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100 actionBtn" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">@lang('Confirmation Alert!')</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark" data-bs-dismiss="modal" type="button">@lang('No')</button>
                        <button class="btn btn--primary" type="submit">@lang('Yes')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@push('breadcrumb-plugins')

    @if (request()->routeIs('admin.lottery.phases'))
        <x-search-form placeholder="Lottery Name" dateSearch='yes' />
    @else
        <x-search-form keySearch='no' dateSearch='yes' />
        <x-back route="{{ route('admin.lottery.index') }}" />
    @endif

    <button class="btn btn-sm btn-outline--primary float-sm-end cuModalBtn" data-modal_title="@lang('Add Lottery Phase')" type="button" @if (@$isRunning) disabled @endif>
        <i class="las la-plus"></i>@lang('Add new')
    </button>
@endpush

@push('style')
    <style>
        .datepicker {
            z-index: 9999
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.modal-datepicker').datepicker();
            //Check-Lottery
            $('[name=lottery_id]').on('change', function() {
                let lottery_id = $("option:selected").val();
                let isRunning = $("option:selected").data('running');
                if (lottery_id && isRunning) {
                    $('.actionBtn').attr('disabled', 'disabled');
                } else {
                    $('.actionBtn').removeAttr("disabled");
                }
            });
            $('.confirmationBtn').on('click', function() {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var modal = $('#confirmationModal');
                var text = status ? `@lang('Are you sure to inactive this lottery?')` : `@lang('Are you sure to active this lottery?')`;
                var url = `{{ route('admin.lottery.phase.status', '') }}/${id}`;
                modal.find('.modal-body').text(text);
                modal.find('form').attr('action', url);
                console.log(url);
                modal.modal('show')

            });
        })(jQuery)
    </script>
@endpush
