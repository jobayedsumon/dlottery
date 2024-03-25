<?php
    $counters = getContent('counter.element', false, 3, true);
?>

<div class="overview-section pb-50">
    <div class="container">
        <div class="row gy-sm-0 gy-4 overview-wrapper wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4 overview-item">
                    <div class="overview-card">
                        <div class="overview-card__icon">
                            <?php echo @$counter->data_values->icon ?>
                        </div>
                        <div class="overview-card__content">
                            <h3 class="amount text--base text-shadow--base"><?php echo e(__(@$counter->data_values->number)); ?></h3>
                            <p><?php echo e(__(@$counter->data_values->title)); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/counter.blade.php ENDPATH**/ ?>