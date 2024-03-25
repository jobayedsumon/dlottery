<header class="header">
    <div class="header__bottom">
        <div class="container-fluid px-lg-5">
            <nav class="navbar navbar-expand-xl align-items-center p-0">
                <a class="site-logo site-title" href="<?php echo e(route('home')); ?>"><img
                        src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="logo"></a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu me-auto">
                        <li><a class="<?php echo e(menuActive('home')); ?>" href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                        <li><a class="<?php echo e(menuActive('pages', ['about'])); ?>" href="<?php echo e(route('pages', 'about')); ?>"><?php echo app('translator')->get('About'); ?></a></li>
                        <li><a class="<?php echo e(menuActive(['lottery', 'lottery.details'])); ?>" href="<?php echo e(route('lottery')); ?>"><?php echo app('translator')->get('Lotteries'); ?></a></li>

                        <?php if(@$pages): ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="<?php echo e(menuActive('pages', [$data->slug])); ?>" href="<?php echo e(route('pages', [$data->slug])); ?>"><?php echo e(__($data->name)); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <li><a class="<?php echo e(menuActive('blog')); ?>" href="<?php echo e(route('pages', ['blog'])); ?>"><?php echo app('translator')->get('Blog'); ?></a></li>
                        <li><a class="<?php echo e(menuActive('contact')); ?>" href="<?php echo e(route('contact')); ?>"><?php echo app('translator')->get('Contact'); ?></a></li>
                    </ul>
                    <div class="nav-right">
                        <?php if(auth()->guard()->check()): ?>
                            <a class="btn btn-sm btn--base me-sm-3 me-2 btn--capsule <?php echo e(menuActive('user.home')); ?> px-3" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?></a>
                            <a class="fs--14px me-sm-3 me-2 text-white" href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('Logout'); ?></a>
                        <?php else: ?>
                            <a class="btn btn-sm btn--base me-sm-3 me-2 btn--capsule px-3" href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?></a>
                            <a class="fs--14px me-sm-3 me-2 text-white" href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Register'); ?></a>
                        <?php endif; ?>
                        <select class="language-select langSel">
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->code); ?>" <?php if(session('lang') == $item->code): ?> selected <?php endif; ?>>
                                    <?php echo e(__($item->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </nav>
        </div>
    </div><!-- header__bottom end -->
</header>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/partials/header.blade.php ENDPATH**/ ?>