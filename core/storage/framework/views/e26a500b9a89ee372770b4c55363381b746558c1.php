<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-1.png')); ?>" alt="image"></div>
        <div class="ball-2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-2.png')); ?>" alt="image"></div>
        <div class="ball-3"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-3.png')); ?>" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="account-wrapper">
                        <div class="account-form">
                            <form method="POST" action="<?php echo e(route('user.data.submit')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="form-label"><?php echo app('translator')->get('First Name'); ?></label>
                                        <input class="form--control" name="firstname" type="text" value="<?php echo e(old('firstname')); ?>" required>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form-label"><?php echo app('translator')->get('Last Name'); ?></label>
                                        <input class="form--control" name="lastname" type="text" value="<?php echo e(old('lastname')); ?>" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label"><?php echo app('translator')->get('Address'); ?></label>
                                        <input class="form--control" name="address" type="text" value="<?php echo e(old('address')); ?>">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label"><?php echo app('translator')->get('State'); ?></label>
                                        <input class="form--control" name="state" type="text" value="<?php echo e(old('state')); ?>">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label"><?php echo app('translator')->get('Zip Code'); ?></label>
                                        <input class="form--control" name="zip" type="text" value="<?php echo e(old('zip')); ?>">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form-label"><?php echo app('translator')->get('City'); ?></label>
                                        <input class="form--control" name="city" type="text" value="<?php echo e(old('city')); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit">
                                        <?php echo app('translator')->get('Submit'); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/user_data.blade.php ENDPATH**/ ?>