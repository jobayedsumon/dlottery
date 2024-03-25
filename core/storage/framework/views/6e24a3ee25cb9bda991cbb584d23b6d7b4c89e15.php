<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        echo $cookie->data_values->description;
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/cookie.blade.php ENDPATH**/ ?>