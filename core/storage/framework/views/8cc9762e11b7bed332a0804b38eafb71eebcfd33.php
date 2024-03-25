<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/lottery/index.blade.php ENDPATH**/ ?>