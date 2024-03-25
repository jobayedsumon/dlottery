<?php
    $socialIcons = getContent('social_icon.element', false, null, true);
    $policyPages = getContent('policy_pages.element', false, null, true);
?>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-3 text-md-start text-center">
                <a class="footer-logo" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="image"></a>
            </div>
            <div class="col-lg-10 col-md-9 mt-md-0 mt-3">
                <ul class="inline-menu d-flex justify-content-md-end justify-content-center align-items-center flex-wrap">
                    <li><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                    <li><a href="<?php echo e(route('lottery')); ?>"><?php echo app('translator')->get('Lotteries'); ?></a></li>

                    <?php if(@$pages): ?>
                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="<?php echo e(route('policy.pages', [slug($page->data_values->title), $page->id])); ?>"><?php echo e(__($page->data_values->title)); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <hr class="mt-3">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center">
                <span class="footer-content__left-text"> <?php echo app('translator')->get('Copyright'); ?> &copy;
                    <?php echo e(now()->format('Y')); ?>, <?php echo app('translator')->get('All Right Reserved By'); ?>
                    <a class="text--base" href="<?php echo e(route('home')); ?>"><?php echo e(@$general->site_name); ?>.</a>
                </span>
            </div>
            <div class="col-md-6 mt-md-0 mt-3">
                <ul class="inline-social-links d-flex align-items-center justify-content-md-end justify-content-center">
                    <?php $__empty_1 = true; $__currentLoopData = $socialIcons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li><a href="<?php echo e(@$icon->data_values->url); ?>" target="_blank"><?php echo @$icon->data_values->social_icon ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/partials/footer.blade.php ENDPATH**/ ?>