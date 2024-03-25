<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-wrapper">
                        <div class="blog-details__thumb">
                            <img src="<?php echo e(getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '')); ?>" alt="image">
                            <div class="post__date">
                                <span class="date"><?php echo e(showDateTime($blog->created_at, 'd')); ?></span>
                                <span class="month"><?php echo e(showDateTime($blog->created_at, 'M')); ?></span>
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h4 class="blog-details__title mb-3"><?php echo e(__(@$blog->data_values->title)); ?></h4>

                            <?php echo @$blog->data_values->description_nic ?>

                        </div>
                    </div>

                    <?php if(\App\Models\Extension::where('act', 'fb-comment')->where('status', 1)->first()): ?>
                        <div class="comment-form-area">
                            <h3 class="title"><?php echo app('translator')->get('Live a Comment'); ?></h3>

                            <div class="fb-comments" data-href="<?php echo e(route('blog.details', [slug($blog->data_values->title), $blog->id])); ?>" data-numposts="5"></div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="col-lg-4 pl-lg-5">
                    <div class="sidebar">

                        <div class="widget">
                            <h3 class="widget-title"><?php echo app('translator')->get('Recent Blog Posts'); ?></h3>
                            <ul class="small-post-list">

                                <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="small-post-single">
                                        <div class="thumb"><img src="<?php echo e(getImage('assets/images/frontend/blog/' . @$item->data_values->image, '')); ?>" alt="image"></div>
                                        <div class="content">
                                            <h6 class="post-title"><a href="<?php echo e(route('blog.details', [slug($item->data_values->title), $item->id])); ?>"> <?php echo e(__(@$item->data_values->title)); ?></a></h6>
                                            <?php echo e(showDateTime($item->created_at)); ?>

                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('fbComment'); ?>
    <?php echo loadFbComment() ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/blog_details.blade.php ENDPATH**/ ?>