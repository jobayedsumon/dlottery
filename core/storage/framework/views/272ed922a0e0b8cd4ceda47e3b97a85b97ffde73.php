<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="lottery-details-header">
                        <div class="thumb"><img
                                src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery'))); ?>" alt="image"></div>
                        <div class="content text-center">
                            <h3 class="game-name mb-4"><?php echo e(__($phase->lottery->name)); ?></h3>
                            <div class="clock" data-clock="<?php echo e(showDateTime($phase->draw_date, 'Y/m/d H:i:s')); ?>" data-title="<?php echo app('translator')->get('The lottery is expired'); ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">

                    <?php if($phase->available): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <form class="submit-form" method="post" action="<?php echo e(route('user.buy.ticket')); ?>">
                                <?php echo csrf_field(); ?>
                                <input name="lottery_id" type="hidden" value="<?php echo e($phase->lottery->id); ?>">
                                <input name="phase_id" type="hidden" value="<?php echo e($phase->id); ?>">

                                <div class="lottery-details-body">
                                    <div class="top-part">
                                        <div class="left">
                                            <h4><?php echo app('translator')->get('Available Ticket'); ?>: <?php echo e(__($phase->available)); ?></h4>
                                            <h4 class="mt-2"><?php echo app('translator')->get('Price'); ?>:
                                                <?php echo e(__($general->cur_sym)); ?><?php echo e(__(showAmount($phase->lottery->price))); ?></h4>
                                        </div>
                                        <div class="middle">
                                            <div class="balance"><?php echo app('translator')->get('Balance'); ?>:
                                                <?php echo e(__($general->cur_sym)); ?><?php echo e(showAmount(auth()->user()->balance)); ?></div>
                                        </div>
                                        <div class="right">
                                            <button class="btn btn-md btn-outline--base addMore" type="button"><i
                                                    class="la la-plus"></i> <?php echo app('translator')->get('Add New'); ?></button>
                                        </div>
                                    </div>
                                    <div class="body-part">
                                        <div class="row gy-4" id="tickets">

                                            <div class="col-xl-4 col-md-6">
                                                <div class="ticket-card">
                                                    <div class="ticket-card__header">
                                                        <h4><?php echo app('translator')->get('Your Ticket Number'); ?></h4>
                                                    </div>
                                                    <div class="ticket-card__body elements">
                                                        <input class="numVal" name="number[]" type="hidden">
                                                        <div class="numbers uniqueNumbers mb-4">
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                            <span>0</span>
                                                        </div>
                                                        <button class="btn btn-md btn--base w-100 generate" type="button"><?php echo app('translator')->get('Generate'); ?></button>
                                                    </div>
                                                </div><!-- ticket-card end -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-part gap-3">
                                        <div class="left">
                                            <p><?php echo app('translator')->get('1 Draw with'); ?> <span class="qnt">1</span> <?php echo app('translator')->get('ticket'); ?> : <span
                                                    class="qnt">1</span> x <?php echo e(getAmount($phase->lottery->price)); ?>

                                                <?php echo e(__($general->cur_text)); ?></p>
                                            <p class="mt-2"><?php echo app('translator')->get('Total Amount'); ?> : <span
                                                    class="tam"><?php echo e(getAmount($phase->lottery->price)); ?></span>
                                                <span><?php echo e($general->cur_text); ?></span>
                                            </p>
                                        </div>
                                        <div class="right">
                                            <?php if(auth()->guard()->check()): ?>
                                                <button class="btn btn-md btn-outline--base buyBtn" type="button"><i
                                                        class="la la-shopping-bag"></i> <?php echo app('translator')->get('Buy Now'); ?></button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div><!-- lottery-details-body end -->
                            </form>
                        <?php else: ?>
                            <div class="lottery-details-body">
                                <div class="top-part">
                                    <div class="left">
                                        <h4><?php echo app('translator')->get('Available Ticket'); ?>: <?php echo e(__($phase->available)); ?></h4>
                                        <h4 class="mt-2"><?php echo app('translator')->get('Price'); ?>:
                                            <?php echo e(__($general->cur_sym)); ?><?php echo e(__(showAmount($phase->lottery->price))); ?></h4>
                                    </div>
                                </div>
                                <div class="footer-part gap-3">
                                    <div class="middle">
                                        <h4><?php echo app('translator')->get('Please log in to purchase lottery tickets'); ?></h4>
                                    </div>
                                    <div class="right">
                                        <a href="<?php echo e(route('user.login')); ?>"><button class="btn btn-md btn-outline--base" type="button"><i class="la la-user"></i> <?php echo app('translator')->get('Login'); ?></button></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="lottery-details-body">
                            <div class="top-part">
                                <div class="w-100">
                                    <h4> <?php echo app('translator')->get('All Tickets are sold'); ?> </h4>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="lottery-details-instruction mt-5">
                        <ul class="nav nav-tabs cumtom--nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active px-4" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><?php echo app('translator')->get('Instruction'); ?></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><?php echo app('translator')->get('Win Bonuses'); ?></button>
                            </li>
                            <?php if(auth()->guard()->check()): ?>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4" id="profile-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="false"><?php echo app('translator')->get('Purchased Tickets'); ?></button>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="d-block">
                                    <h3 class="mb-3"><?php echo app('translator')->get('Introduction'); ?></h3>
                                    <?php echo $phase->lottery->instruction ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="table-responsive--md">
                                    <table class="level-table custom--table table">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase"><?php echo app('translator')->get('Winners'); ?></th>
                                                <th class="text-uppercase"><?php echo app('translator')->get('Win Bonus'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $phase->lottery->bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-white"><?php echo app('translator')->get('Winner'); ?>- <?php echo e($bonus->level); ?></td>
                                                    <td class="text-white"><?php echo e($bonus->amount); ?>

                                                        <?php echo e(__($general->cur_text)); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php if(auth()->guard()->check()): ?>
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                    <div class="table-responsive--md">
                                        <table class="level-table custom--table table">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                                    <th><?php echo app('translator')->get('Phase Number'); ?></th>
                                                    <th><?php echo app('translator')->get('Ticket'); ?></th>
                                                    <th><?php echo app('translator')->get('Result'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = @$tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($tickets->firstItem() + $loop->index); ?></td>
                                                        <td><?php echo app('translator')->get('Phase ' . $ticket->phase->phase_number); ?></td>
                                                        <td> <?php echo e($ticket->ticket_number); ?></td>
                                                        <td>
                                                            <?php
                                                                echo $ticket->statusBadge;
                                                            ?>
                                                        </td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <td class="text-center rounded-bottom" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-3">
                                            <?php if($tickets->hasPages()): ?>
                                                <?php echo e(paginateLinks($tickets)); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div><!-- row end -->
        </div>
    </section>

    <!-- Modal -->
    <?php echo $__env->make($activeTemplate . 'partials.ticket_confirmation_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- lottery details section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        (function($) {
            "use strict";
            $(window).on('load', function() {
                var element = $('.elements').length;
                addMoreBtn(element);
            });

            $('.addMore').click(function() {
                var element = $('.elements').length + 1

                var html = `
                        <div class="col-xl-4 col-md-6 elem">
                            <div class="ticket-card">
                                <button type="button" class="ticket-card-del removeBtn"><i class="las la-times"></i></button>
                                <div class="ticket-card__header">
                                    <h4><?php echo app('translator')->get('Your Ticket Number'); ?></h4>
                                </div>
                                <div class="ticket-card__body elements">
                                    <input type="hidden" class="numVal" name="number[]">
                                    <div class="numbers uniqueNumbers mb-4">
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                        <span>0</span>
                                    </div>
                                    <button type="button" class="btn btn-md btn--base w-100 generate"><?php echo app('translator')->get('Generate Number'); ?></button>
                                </div>
                            </div>
                        </div>
                	`;
                $('#tickets').append(html);
                $('.qnt').html(element);
                $('.tam').html(element * <?php echo e($phase->lottery->price); ?>);
                $('input[name=ticket_quantity]').val(element);
                $('input[name=total_price]').val(element * <?php echo e($phase->lottery->price); ?>);
                randomTicketGenerate();
                remove();
                addMoreBtn(element);
            });

            function remove() {
                $('.removeBtn').click(function() {
                    $(this).parents('.elem').remove();
                    var elem = $('.elements').length;
                    addMoreBtn(elem);
                    $('.qnt').html(elem);
                    $('.tam').html(elem * <?php echo e($phase->lottery->price); ?>);
                    $('input[name=ticket_quantity]').val(elem);
                    $('input[name=total_price]').val(elem * <?php echo e($phase->lottery->price); ?>);
                });
            }

            function addMoreBtn(count) {
                if (count >= <?php echo e($phase->available); ?>) {
                    $('.addMore').addClass('d-none');
                } else {
                    $('.addMore').removeClass('d-none');
                }
            }

            function randomTicketGenerate() {
                $('.generate').click(function() {
                    var randomNum = Math.floor(1000000000 + Math.random() * 9000000000);
                    var array = randomNum.toString().split('');
                    var newArray = [];

                    $.each(array, function(index, value) {
                        newArray[index] = `<span>${value}</span>`;
                    });

                    $(this).parents('.elements').children('.numbers').html(newArray);
                    $(this).parents('.elements').children('.numbers').addClass('active');
                    $(this).parents('.elements').children('.numbers').removeClass('op-0-3');
                    $(this).parents('.elements').children('.numVal').val(randomNum);
                });
            }

            $('.generate').click(function() {
                var tendigitrandom = Math.floor(1000000000 + Math.random() * 9000000000);
                var array = tendigitrandom.toString().split('');
                var newArray = [];

                $.each(array, function(index, value) {
                    newArray[index] = `<span>${value}</span>`;
                });

                $(this).parents('.elements').children('.numbers').html(newArray);

                $(this).parents('.elements').children('.numbers').addClass('active');
                $(this).parents('.elements').children('.numbers').removeClass('op-0-3');
                $(this).parents('.elements').children('.numVal').val(tendigitrandom);
            });


            $('.buyBtn').on('click', function() {
                let emptyValueCheck = false;
                $.each($('#tickets').find('.numVal'), function(i, val) {
                    if (!val.value) {
                        emptyValueCheck = true;
                    }
                });
                if (emptyValueCheck) {
                    notify('error', 'Ticket number field is required!')
                    return;
                } else {
                    $('.submit-form').find('.buyBtn').html(
                        '<i class="la la-shopping-bag fa-spin"></i> Buy Now');

                    var modal = $('#exampleModal');
                    modal.modal('show');
                    $('.buyTicketConfirmation').on('click', function() {
                        $('.submit-form').submit();
                        modal.modal('show');
                    })

                }

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/lottery/details.blade.php ENDPATH**/ ?>