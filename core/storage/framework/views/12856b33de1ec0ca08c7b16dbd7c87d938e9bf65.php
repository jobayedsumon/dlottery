<?php
    $kycInstruction = getContent('kyc_instruction.content', true);
?>

<?php $__env->startSection('content'); ?>
    <!-- dashboard section start -->
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <?php if(auth()->user()->kv == 0): ?>
                        <div class="alert alert-danger p-3" role="alert">
                            <h4 class="alert-heading"><?php echo app('translator')->get('KYC Verification required'); ?></h4>
                            <hr>
                            <p class="mb-0"><?php echo e(__($kycInstruction->data_values->verification_instruction)); ?> <a href="<?php echo e(route('user.kyc.form')); ?>"><?php echo app('translator')->get('Click Here to Verify'); ?></a></p>
                        </div>
                    <?php elseif(auth()->user()->kv == 2): ?>
                        <div class="alert alert-warning p-3" role="alert">
                            <h4 class="alert-heading"><?php echo app('translator')->get('KYC Verification pending'); ?></h4>
                            <hr>
                            <p class="mb-0"><?php echo e(__($kycInstruction->data_values->pending_instruction)); ?> <a href="<?php echo e(route('user.kyc.data')); ?>"><?php echo app('translator')->get('See KYC Data'); ?></a></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('Referral Link'); ?></label>
                        <div class="input-group">
                            <input class="form--control referralURL" name="text" type="text" value="<?php echo e(route('home')); ?>?reference=<?php echo e(auth()->user()->username); ?>" readonly>
                            <span class="input-group-text copytext copyBoard" id="copyBoard"> <i class="fa fa-copy"></i> </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gy-4 align-items-center mt-2">
                <div class="col-lg-3 col-sm-6">
                    <div class="balance-card">
                        <span class="text--dark"><?php echo app('translator')->get('Total Balance'); ?></span>
                        <h3 class="number text--dark"><?php echo e(__($general->cur_sym)); ?><?php echo e(getAmount($user->balance)); ?></h3>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span><?php echo app('translator')->get('Total Win'); ?></span>
                        <a class="view--btn" href="<?php echo e(route('user.wins')); ?>"><?php echo app('translator')->get('View log'); ?></a>
                        <h3 class="number"><?php echo e($user->wins->count()); ?></h3>
                        <i class="las la-trophy icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span><?php echo app('translator')->get('Total Deposit'); ?></span>
                        <a class="view--btn" href="<?php echo e(route('user.deposit.history')); ?>"><?php echo app('translator')->get('View log'); ?></a>
                        <h3 class="number"><?php echo e(__($general->cur_sym)); ?><?php echo e($user->deposits->sum('amount') + 0); ?></h3>
                        <i class="las la-dollar-sign icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dashboard-card">
                        <span><?php echo app('translator')->get('Total Withdraw'); ?></span>
                        <a class="view--btn" href="<?php echo e(route('user.withdraw.history')); ?>"><?php echo app('translator')->get('View log'); ?></a>
                        <h3 class="number"><?php echo e(__($general->cur_sym)); ?><?php echo e($user->withdrawals->where('status', 1)->sum('amount') + 0); ?></h3>
                        <i class="las la-hand-holding-usd icon"></i>
                    </div><!-- dashboard-card end -->
                </div>
            </div><!-- row end -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-header text-center">
                                <h2 class="section-title"><?php echo app('translator')->get('Waiting for Draw'); ?></h2>
                            </div>
                        </div>
                    </div><!-- row end -->

                    <div class="row">
                        <div class="col-md-12 mb-30">
                            <table class="table-responsive--md custom--table table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('S.N.'); ?></th>
                                        <th><?php echo app('translator')->get('Lottery Name'); ?></th>
                                        <th><?php echo app('translator')->get('Phase Number'); ?></th>
                                        <th><?php echo app('translator')->get('Ticket'); ?></th>
                                        <th><?php echo app('translator')->get('Result'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($tickets->firstItem() + $loop->index); ?></td>
                                            <td><?php echo e(__($ticket->lottery->name)); ?></td>
                                            <td><?php echo app('translator')->get('Phase ' . $ticket->phase->phase_number); ?></td>
                                            <td class="text-center">
                                                <?php echo e($ticket->ticket_number); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    echo $ticket->statusBadge;
                                                ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <td class="rounded-bottom text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
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

                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style-lib'); ?>
    <link type="text/css" href="<?php echo e(asset('assets/global/css/jquery.treeView.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/jquery.treeView.js')); ?>"></script>
    <script>
        (function($) {
            "use strict"

            $('.treeview').treeView();
            $('.copyBoard').click(function() {
                var copyText = document.getElementsByClassName("referralURL");
                copyText = copyText[0];
                copyText.select();
                copyText.setSelectionRange(0, 99999);

                /*For mobile devices*/
                document.execCommand("copy");
                copyText.blur();
                this.classList.add('copied');
                setTimeout(() => this.classList.remove('copied'), 1500);
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/dashboard.blade.php ENDPATH**/ ?>