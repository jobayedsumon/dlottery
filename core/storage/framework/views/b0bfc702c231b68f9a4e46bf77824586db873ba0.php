<?php
    $content = getContent('how_it_work.content', true);
    $elements = getContent('how_it_work.element', false, null, true);
?>
<!-- how work section start -->
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    <p class="mt-3"><?php echo e(__(@$content->data_values->subheading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row gy-4">
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-sm-6 how-work-item wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    <div class="how-work-card">
                        <div class="how-work-card__step text--base text-shadow--base"><?php echo e($loop->iteration); ?></div>
                        <h3 class="title mt-4"><?php echo e(__(@$item->data_values->title)); ?></h3>
                        <p class="mt-2"><?php echo e(__(@$item->data_values->content)); ?></p>
                    </div><!-- how-work-card end -->
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- how work section end -->
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/how_it_work.blade.php ENDPATH**/ ?>