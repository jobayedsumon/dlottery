<?php $__env->startSection('content'); ?>
    <div class="login-main" style="background-image: url('<?php echo e(asset('assets/admin/images/login.jpg')); ?>')">
        <div class="custom-container d-flex justify-content-center container">
            <div class="login-area">
                <div class="mb-3 text-center">
                    <h2 class="mb-2 text-white"><?php echo app('translator')->get('Verify Code'); ?></h2>
                    <p class="mb-2 text-white"><?php echo app('translator')->get('Please check your email and enter the verification code you got in your email.'); ?></p>
                </div>
                <form class="login-form w-100" action="<?php echo e(route('admin.password.verify.code')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div class="code-box-wrapper d-flex w-100">
                        <div class="form-group flex-fill mb-3">
                            <span class="fw-bold text-white"><?php echo app('translator')->get('Verification Code'); ?></span>
                            <div class="verification-code">
                                <input class="overflow-hidden" name="code" type="text" autocomplete="off">
                                <div class="boxes">
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                    <span>-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap">
                        <a class="forget-text" href="<?php echo e(route('admin.password.reset')); ?>"><?php echo app('translator')->get('Try to send again'); ?></a>
                    </div>
                    <button class="btn cmn-btn w-100 mt-4" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                </form>
                <a class="mt-4 text-white" href="<?php echo e(route('admin.login')); ?>"><i class="las la-sign-in-alt" aria-hidden="true"></i><?php echo app('translator')->get('Back to Login'); ?></a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('assets/admin/css/verification_code.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            'use strict';
            $('[name=code]').on('input', function() {

                $(this).val(function(i, val) {
                    if (val.length >= 6) {
                        $('form').find('button[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                        $('form').find('button[type=submit]').removeClass('disabled');
                        $('form')[0].submit();
                    } else {
                        $('form').find('button[type=submit]').addClass('disabled');
                    }
                    if (val.length > 6) {
                        return val.substring(0, val.length - 1);
                    }
                    return val;
                });

                for (let index = $(this).val().length; index >= 0; index--) {
                    $($('.boxes span')[index]).html('');
                }
            });

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/auth/passwords/code_verify.blade.php ENDPATH**/ ?>