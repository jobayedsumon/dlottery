<?php
    $content = getContent('feature.content', true);
    $features = getContent('feature.element', false, null, true);
?>

<!-- feature section start -->
<section class="pt-100 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-header">
                    <h2 class="section-title"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row justify-content-center gy-4">
            <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    <div class="feature-card rounded-3">
                        <div class="feature-card__icon text--base text-shadow--base">
                            <?php echo @$feature->data_values->icon ?>
                        </div>
                        <div class="feature-card__content mt-4">
                            <h3 class="title"><?php echo e(__(@$feature->data_values->title)); ?></h3>
                            <p class="mt-3"><?php echo e(__(@$feature->data_values->description)); ?></p>
                        </div>
                    </div><!-- feature-card end -->
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- feature section end -->
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/feature.blade.php ENDPATH**/ ?>