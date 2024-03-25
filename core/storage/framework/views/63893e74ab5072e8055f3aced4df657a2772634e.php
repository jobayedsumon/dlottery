<div class="mb-3">
    <label><?php echo app('translator')->get('Verification Code'); ?></label>
    <div class="verification-code">
        <input class="form--control overflow-hidden" id="verification-code" name="code" type="text" required autocomplete="off">
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

<?php $__env->startPush('style'); ?>
    <link href="<?php echo e(asset('assets/global/css/verification-code.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $(document).on('input', '#code', function() {
            $(this).val(function(i, val) {
                if (val.length >= 6) {
                    $('.submit-form').find('button[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                    $('.submit-form').submit()
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
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .form--control,
        .form-control {
            border: 0 !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/partials/verification_code.blade.php ENDPATH**/ ?>