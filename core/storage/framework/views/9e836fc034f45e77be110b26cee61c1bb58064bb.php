
<?php $__env->startSection('content'); ?>
    <!-- blog section start -->
    <section class="pt-100 pb-50">
        <div class="container">
            <div class="row justify-content-center mb-none-30">
                <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="blog-card">
                            <div class="blog-card__thumb">
                                <img src="<?php echo e(getImage('assets/images/frontend/blog/' . @$item->data_values->image, '768x512')); ?>" alt="image">
                            </div>
                            <div class="blog-card__content">
                                <h4 class="blog-card__title mb-3"><a
                                        href="<?php echo e(route('blog.details', [slug($item->data_values->title), $item->id])); ?>"><?php echo e(__(strLimit(@$item->data_values->title, 66))); ?></a>
                                </h4>
                                <ul class="blog-card__meta d-flex mb-4 flex-wrap">
                                    <li>
                                        <i class="las la-calendar"></i>
                                        <?php echo e(showDateTime($item->created_at)); ?>

                                    </li>
                                </ul>
                                <p><?php echo e(__(@$item->data_values->short_description)); ?></p>
                                <a class="btn btn--base mt-4" href="<?php echo e(route('blog.details', [slug($item->data_values->title), $item->id])); ?>"><?php echo app('translator')->get('Read More'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center"> <?php echo e(__($emptyMessage)); ?></div>
                <?php endif; ?>

            </div>
            <?php if($blogs->hasPages()): ?>
                <div class="d-flex justify-content-center mt-5">
                    <?php echo e(paginateLinks($blogs)); ?>

                </div>
            <?php endif; ?>
            <div>
            </div>
        </div>
    </section>
    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <!-- blog section end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/blog.blade.php ENDPATH**/ ?>