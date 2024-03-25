<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make($activeTemplate . 'partials.lotteries', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <?php if($phases->hasPages()): ?>
                <div class="d-flex justify-content-center mt-5">
                    <?php echo e(paginateLinks($phases)); ?>

                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/lottery.blade.php ENDPATH**/ ?>