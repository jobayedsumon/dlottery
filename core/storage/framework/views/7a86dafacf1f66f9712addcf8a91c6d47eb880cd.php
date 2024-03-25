<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-1.png')); ?>" alt="image"></div>
        <div class="ball-2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-2.png')); ?>" alt="image"></div>
        <div class="ball-3"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-3.png')); ?>" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="account-wrapper">
                        <form class="account-form verify-gcaptcha" method="POST" action="<?php echo e(route('user.login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="account-thumb-area text-center">
                                <h3 class="title"><?php echo app('translator')->get('Welcome Back to'); ?> <?php echo e($general->site_name); ?></h3>
                            </div>

                            <div class="form-group">
                                <label for="username"><?php echo app('translator')->get('Username or Email'); ?></label>
                                <div class="custom--field">
                                    <input class="form--control" id="username" name="username" type="text" value="<?php echo e(old('username')); ?>" required>
                                    <i class="las la-user"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo app('translator')->get('Password'); ?></label>
                                <div class="custom--field">
                                    <input class="form--control" id="password" name="password" type="password" required>
                                    <i class="las la-key"></i>
                                </div>
                            </div>

                            <div class="mt-4">
                                <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve(['path' => ''.e($activeTemplate . 'partials').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>
                            </div>

                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="form-group form-check">
                                    <input class="form-check-input" id="remember" name="remember" type="checkbox" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="remember">
                                        <?php echo app('translator')->get('Remember Me'); ?>
                                    </label>
                                </div>
                                <div class="form-group text-end">
                                    <a class="text-white" href="<?php echo e(route('user.password.request')); ?>"><?php echo app('translator')->get('Forget Password?'); ?></a>
                                </div>
                            </div>

                            <button class="btn btn--base w-100" id="recaptcha" type="submit"><?php echo app('translator')->get('Login'); ?></button>
                            <p class="mt-3 text-center"><span class="text-white"><?php echo app('translator')->get('New to'); ?> <?php echo e($general->site_name); ?>

                                    ?</span> <a class="text--base" href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Register'); ?></a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- account section end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/jobayedsumon/Client/dlottery/core/resources/views/templates/basic/user/auth/login.blade.php ENDPATH**/ ?>