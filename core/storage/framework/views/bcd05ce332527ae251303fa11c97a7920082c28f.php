<div class="modal fade bd-example-modal-lg" id="cronModal" role="dialog" aria-labelledby="cronModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cronModalLabel"><?php echo app('translator')->get('Cron Job Setting Instruction'); ?></h5>
                <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <p class="cron-p-style"> <?php echo app('translator')->get('To automate daily return amount, run the'); ?>
                            <code> <?php echo app('translator')->get('cron job'); ?> </code> <?php echo app('translator')->get('on your server. Set the Cron time as minimum as possible. Once per'); ?>
                            <code><?php echo app('translator')->get('5-15'); ?></code> <?php echo app('translator')->get('minutes is ideal.'); ?>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <label><?php echo app('translator')->get('Cron Command'); ?></label>
                        <div class="input-group">
                            <input class="form-control" id="cronCommand" type="text" value="curl -s <?php echo e(route('cron')); ?>" readonly="">
                            <span class="input-group-text btn--success copyText" title=""> <?php echo app('translator')->get('COPY'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('style'); ?>
    <style>
        .input-group-text {
            border: 1px #28c76f !important;
            cursor: pointer;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <?php if(Carbon\Carbon::parse($general->last_cron)->diffInSeconds() >= 900 || !$general->last_cron): ?>
        <script>
            'use strict';

            var myModal = new bootstrap.Modal(document.getElementById('cronModal'))
            myModal.show();

            (function($) {
                $('.copyText').on('click', function() {
                    var copyText = document.getElementById("cronCommand");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999)
                    document.execCommand("copy");
                    notify('success', 'Url copied successfully ' + copyText.value);
                })
            })(jQuery)
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/partials/cron_instruction.blade.php ENDPATH**/ ?>