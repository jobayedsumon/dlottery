<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-12">
                    <div class="card custom__bg">
                        <div class="card-body">
                            <form class="register prevent-double-click" action="" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="InputFirstname"><?php echo app('translator')->get('First Name'); ?>:</label>
                                        <input class="form--control" id="InputFirstname" name="firstname" type="text" value="<?php echo e($user->firstname); ?>" placeholder="<?php echo app('translator')->get('First Name'); ?>" minlength="3">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="lastname"><?php echo app('translator')->get('Last Name'); ?>:</label>
                                        <input class="form--control" id="lastname" name="lastname" type="text" value="<?php echo e($user->lastname); ?>" placeholder="<?php echo app('translator')->get('Last Name'); ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="email"><?php echo app('translator')->get('E-mail Address'); ?>:</label>
                                        <input class="form--control" id="email" value="<?php echo e($user->email); ?>" placeholder="<?php echo app('translator')->get('E-mail Address'); ?>" disabled>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="phone"><?php echo app('translator')->get('Mobile Number'); ?></label>
                                        <input class="form--control" id="phone" value="<?php echo e($user->mobile); ?>" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="address"><?php echo app('translator')->get('Address'); ?>:</label>
                                        <input class="form--control" id="address" name="address" type="text" value="<?php echo e(@$user->address->address); ?>" placeholder="<?php echo app('translator')->get('Address'); ?>" required="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="state"><?php echo app('translator')->get('State'); ?>:</label>
                                        <input class="form--control" id="state" name="state" type="text" value="<?php echo e(@$user->address->state); ?>" placeholder="<?php echo app('translator')->get('state'); ?>" required="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label" for="zip"><?php echo app('translator')->get('Zip Code'); ?>:</label>
                                        <input class="form--control" id="zip" name="zip" type="text" value="<?php echo e(@$user->address->zip); ?>" placeholder="<?php echo app('translator')->get('Zip Code'); ?>" required="">
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label" for="city"><?php echo app('translator')->get('City'); ?>:</label>
                                        <input class="form--control" id="city" name="city" type="text" value="<?php echo e(@$user->address->city); ?>" placeholder="<?php echo app('translator')->get('City'); ?>" required="">
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="col-form-label"><?php echo app('translator')->get('Country'); ?>:</label>
                                        <input class="form--control" value="<?php echo e(@$user->address->country); ?>" disabled>
                                    </div>

                                </div>

                                <div class="form-group row pt-5">
                                    <div class="col-sm-12 text-center">
                                        <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/profile/setting.blade.php ENDPATH**/ ?>