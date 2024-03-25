<?php
    $blogContent = getContent('blog.content', true);
    $blogElement = getContent('blog.element', false, 3, true);
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title"><span
                            class="font-weight-normal"><?php echo e(__(@$blogContent->data_values->heading)); ?></span></h2>
                    <p><?php echo e(__(@$blogContent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row justify-content-center">
            <?php $__currentLoopData = $blogElement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-card">
                        <div class="blog-card__thumb">
                            <img src="<?php echo e(getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '768x512')); ?>" alt="image">
                        </div>
                        <div class="blog-card__content">
                            <h4 class="blog-card__title mb-3"><a
                                    href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>"><?php echo e(__(strLimit(@$blog->data_values->title, 66))); ?></a>
                            </h4>
                            <ul class="blog-card__meta d-flex mb-4 flex-wrap">
                                <li>
                                    <i class="las la-calendar"></i>
                                    <?php echo e(showDateTime($blog->created_at)); ?>

                                </li>
                            </ul>
                            <p><?php echo e(__(@$blog->data_values->short_description)); ?></p>
                            <a class="btn btn--base mt-4" href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>"><?php echo app('translator')->get('Read More'); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /Users/jobayedsumon/Client/dlottery/core/resources/views/templates/basic/sections/blog.blade.php ENDPATH**/ ?>