<?php $__env->startSection('panel'); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card outline-primary mb-4">
                <div class="card-header bg--primary">
                    <h4 class="card-title m-0 text-white"><?php echo app('translator')->get('Waiting For Draw'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control" name="phase_id">
                            <option value="" disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                            <?php $__empty_1 = true; $__currentLoopData = $manuals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manual): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($manual->id); ?>"><?php echo e($manual->lottery->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card outline-primary mb-4">
                <div class="card-header bg--primary">
                    <h4 class="card-title m-0 text-white"><?php echo app('translator')->get('Details'); ?></h4>
                </div>
                <div class="card-body text-center">
                    <?php if($phase): ?>
                        <ul class="list-group bonuses" data-bonuses="<?php echo e($phase->lottery->bonuses); ?>">
                            <li class="list-group-item"><?php echo app('translator')->get('Lottery Name'); ?>: <strong><?php echo e($phase->lottery->name); ?></strong></li>
                            <li class="list-group-item"><?php echo app('translator')->get('Phase Number'); ?>: <strong><?php echo app('translator')->get('Phase'); ?> <?php echo e($phase->phase_number); ?></strong></li>
                            <li class="list-group-item"><?php echo app('translator')->get('Lottery Price'); ?>: <strong><?php echo e(getAmount($phase->lottery->price)); ?> <?php echo e(__($general->cur_text)); ?></strong></li>

                            <li class="list-group-item"><?php echo app('translator')->get('Total Sell Ticket'); ?>: <strong><?php echo e($tickets->count()); ?></strong></li>

                            <li class="list-group-item"><?php echo app('translator')->get('Total Sell Amount'); ?>: <strong><?php echo e(getAmount($tickets->sum('total_price'))); ?> <?php echo e($general->cur_text); ?></strong></li>

                            <li class="list-group-item"><?php echo app('translator')->get('Winner'); ?>: <strong> <?php echo e($phase->lottery->bonuses->count()); ?> <?php echo app('translator')->get('Persons'); ?></strong></li>
                            <li class="list-group-item"><?php echo app('translator')->get('Win Bonus Amount'); ?>: <strong><?php echo e($phase->lottery->bonuses->sum('amount')); ?> <?php echo e($general->cur_text); ?></strong></li>
                        </ul>
                    <?php else: ?>
                        <h4 class="text-center"><?php echo app('translator')->get('Please select a lottery'); ?></h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php if($phase): ?>
        <form action="<?php echo e(route('admin.lottery.draw.win', $phase->id)); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="row result_panle">
                <?php $__empty_2 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                    <div class="col-md-3 mb-3">
                        <div class="card ticket-card">
                            <div class="input-fields">

                            </div>
                            <div class="card-body text-center">

                                <ol class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <?php echo app('translator')->get('Username'); ?>:
                                        </div>
                                        <strong class="text-info username" data-ticket="<?php echo e($ticket->ticket_number); ?>"><?php echo e(@$ticket->user->username); ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <?php echo app('translator')->get('Ticket Number'); ?>:
                                        </div>
                                        <strong class="ticket-number text-primary"><?php echo e($ticket->ticket_number); ?></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <?php echo app('translator')->get('Selected Level'); ?>:
                                        </div>
                                        <strong class="selectedLevel text-danger"></strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <?php echo app('translator')->get('Win Amount'); ?>:
                                        </div>
                                        <strong class="winAmount text-danger"></strong>
                                    </li>
                                </ol>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                    <div class="text-center"> <?php echo e(__($emptyMessage)); ?></div>
                <?php endif; ?>
                <div class="col-md-12">
                    <button class="w-100 btn btn--primary drawBtn d-none h-45"><?php echo app('translator')->get('Draw Now'); ?></button>
                </div>
            </div>
        </form>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('style'); ?>
    <style type="text/css">
        .ticket-card {
            cursor: pointer;
        }

        .op-0-7 {
            opacity: 0.7;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            var selector = $('.ticket-card .username');
            var selected = $('.op-0-7');

            $('select[name=phase_id]').on("change", function() {
                if ($(this).val() == '') {
                    return false;
                }
                window.location.href = "<?php echo e(route('admin.lottery.draw.find', '')); ?>/" + $(this).val();

            });
            var TotalBonusLavel = 0;
            var level = 0;
            var totalSoldTicket = [];
            var userWinAmount = 0;
            var lotteryPrice = 0;
            var totalBonus = 0;
            var bonuses = $('.bonuses').data('bonuses');

            <?php if($phase): ?>
                $('select[name=phase_id]').val(<?php echo e(@$phase->id); ?>);
                TotalBonusLavel = <?php echo e($phase->lottery->bonuses->count()); ?>;
                lotteryPrice = <?php echo e($phase->lottery->price); ?>;
            <?php endif; ?>



            $(document).on('click', '.ticket-card', function() {

                if ($(this).hasClass('op-0-7')) {
                    level--;
                    $(this).removeClass('op-0-7');
                    if (!$(this).hasClass('extra')) {

                        $(this).addClass('test-card');
                    }
                    totalSoldTicket.push($(this).find('.selectedLevel').text());
                    $(this).find('.selectedLevel').text('');
                    $(this).find('.winAmount').text('');
                    totalBonus -= parseFloat(bonuses[totalSoldTicket[totalSoldTicket.length - 1] - 1].amount);
                    $(this).find('.input-fields').html('');
                } else {
                    if (level < TotalBonusLavel) {
                        level++;
                        $(this).addClass('op-0-7');
                        if (!$(this).hasClass('extra')) {

                            $(this).removeClass('test-card');
                        }
                        if (totalSoldTicket.length > 0) {
                            var mnsVal = totalSoldTicket[0];
                            userWinAmount = bonuses[mnsVal - 1].amount;
                            $(this).find('.selectedLevel').text(mnsVal);
                            $(this).find('.selectedLevel').attr('data-level', mnsVal);
                            $(this).find('.winAmount').text(userWinAmount + ' <?php echo e($general->cur_text); ?>');
                            totalSoldTicket.shift();
                            var html = `<input type="hidden" name="number[${mnsVal}]"  value="${$(this).find('.ticket-number').text()}">`
                        } else {
                            userWinAmount = bonuses[level - 1].amount;
                            $(this).find('.selectedLevel').text(level);
                            $(this).find('.selectedLevel').attr('data-level', level);
                            $(this).find('.winAmount').text(userWinAmount + ' <?php echo e($general->cur_text); ?>');
                            var html = `<input type="hidden" name="number[${level}]" value="${$(this).find('.ticket-number').text()}">`
                        }
                        totalBonus += parseFloat(userWinAmount);

                        $(this).find('.input-fields').html(html);
                    }
                }
                $('.bonus-amount').text(totalBonus + ' <?php echo e($general->cur_text); ?>');
                <?php if($phase): ?>

                    if (level == <?php echo e($phase->lottery->bonuses->count()); ?>) {
                        $('.drawBtn').removeClass('d-none');
                    } else {
                        $('.drawBtn').addClass('d-none');
                    }
                <?php endif; ?>

            });


        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/draw/manual.blade.php ENDPATH**/ ?>