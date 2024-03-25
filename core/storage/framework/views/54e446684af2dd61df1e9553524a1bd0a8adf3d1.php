<?php
    $content = getContent('testimonial.content', true);
    $testimonials = getContent('testimonial.element', false, null, true);
?>
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    <p class="mt-3"><?php echo e(__(@$content->data_values->sub_heading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="testimonial-slider">
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="single-slide">
                    <div class="testimonial-item rounded-3">
                        <div class="ratings">
                            <?php for($i = 0; $i < 5; $i++): ?>
                                <?php if($i < $testimonial->data_values->rating): ?>
                                    <i class="las la-star"></i>
                                <?php else: ?>
                                    <i class="lar la-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <p class="mt-2 text-white"><?php echo e(__(@$testimonial->data_values->review)); ?></p>
                        <div class="client-details d-flex align-items-center mt-4">
                            <div class="thumb">
                                <img src="<?php echo e(getImage('assets/images/frontend/testimonial/' . @$testimonial->data_values->image, '75x75')); ?>" alt="image">
                            </div>
                            <div class="content">
                                <h4 class="name text-white"><?php echo e(__(@$testimonial->data_values->name)); ?></h4>
                                <span class="designation text-white-50 fs--14px"><?php echo e(__(@$item->data_values->designation)); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /Users/jobayedsumon/Client/dlottery/core/resources/views/templates/basic/sections/testimonial.blade.php ENDPATH**/ ?>