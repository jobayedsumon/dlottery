<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="mb-3 text-end">

                        <div class="show-filter mb-3 text-end">
                            <button class="btn btn--base showFilterBtn btn-sm" type="button"><i class="las la-filter"></i>
                                <?php echo app('translator')->get('Filter'); ?></button>
                        </div>
                        <div class="card responsive-filter-card custom__bg mb-4">
                            <div class="card-body">
                                <form action="">
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="flex-grow-1">
                                            <label><?php echo app('translator')->get('Transaction Number'); ?></label>
                                            <input class="form-control" name="search" type="text" value="<?php echo e(request()->search); ?>">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label><?php echo app('translator')->get('Type'); ?></label>
                                            <select class="form-select form-control" name="commission_type">
                                                <option value=""><?php echo app('translator')->get('All'); ?></option>
                                                <option value="deposit_commission" <?php if(request()->commission_type == 'deposit_commission'): echo 'selected'; endif; ?>>
                                                    <?php echo app('translator')->get('Deposit Commission'); ?></option>
                                                <option value="buy_commission" <?php if(request()->commission_type == 'buy_commission'): echo 'selected'; endif; ?>>
                                                    <?php echo app('translator')->get('Buying Commission'); ?></option>
                                                <option value="win_commission" <?php if(request()->commission_type == 'win_commission'): echo 'selected'; endif; ?>>
                                                    <?php echo app('translator')->get('Win Commission'); ?></option>
                                            </select>
                                        </div>

                                        <div class="flex-grow-1 align-self-end">
                                            <button class="btn btn--base w-100"><i class="las la-filter"></i>
                                                <?php echo app('translator')->get('Filter'); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive--md">
                                <table class="custom--table table">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('S.N.'); ?></th>
                                            <th><?php echo app('translator')->get('Commission From'); ?></th>
                                            <th><?php echo app('translator')->get('Commission Level'); ?></th>
                                            <th><?php echo app('translator')->get('Amount'); ?></th>
                                            <th><?php echo app('translator')->get('Title'); ?></th>
                                            <th><?php echo app('translator')->get('Transaction'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($commissions->firstItem() + $loop->index); ?></td>
                                                <td><?php echo e($log->userFrom->username); ?></td>
                                                <td><?php echo e($log->level); ?></td>
                                                <td><?php echo e(getAmount($log->amount)); ?> <?php echo e($general->cur_text); ?></td>
                                                <td><?php echo e(__($log->title)); ?></td>
                                                <td><?php echo e($log->trx); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td class="rounded-bottom text-center" colspan="100%"> <?php echo e(__($emptyMessage)); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if($commissions->hasPages()): ?>
                                <div class="card-footer">
                                    <?php echo e($commissions->links()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .responsive-filter-card label {
            width: 100%;
            text-align: left;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/referral/commissions.blade.php ENDPATH**/ ?>