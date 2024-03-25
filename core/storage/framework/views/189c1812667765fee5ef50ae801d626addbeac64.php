<?php
    $payments_content = getContent('payments.content', true);
    $payments_elements = getContent('payments.element');
?>

<section class="pt-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title"><?php echo e(__(@$payments_content->data_values->heading)); ?></h2>
                    <p class="mt-3"><?php echo e(__(@$payments_content->data_values->sub_heading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="payment-slider">
                    <?php $__currentLoopData = $payments_elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-slide">
                            <div class="brand-item">
                                <img src="<?php echo e(getImage('assets/images/frontend/payments/' . @$item->data_values->image, '64x50')); ?>" alt="image">
                            </div><!-- brand-item end -->
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php if(auth()->guard()->guest()): ?>
                <div class="col-lg-12 mt-5 text-center">
                    <a class="btn btn--base btn--capsule" href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Create an Account'); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/payments.blade.php ENDPATH**/ ?>