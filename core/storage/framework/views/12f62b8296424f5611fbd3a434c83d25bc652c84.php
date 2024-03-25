<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="account-wrapper">

                        <div class="card-body">
                            <form action="<?php echo e(route('ticket.store')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input name="name" type="hidden" value="<?php echo e(@$user->firstname . ' ' . @$user->lastname); ?>">
                                <input name="email" type="hidden" value="<?php echo e(@$user->email); ?>">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label"><?php echo app('translator')->get('Subject'); ?></label>
                                        <input class="form--control" name="subject" type="text" value="<?php echo e(old('subject')); ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label"><?php echo app('translator')->get('Priority'); ?></label>
                                        <select class="form--control" name="priority" required>
                                            <option value="3"><?php echo app('translator')->get('High'); ?></option>
                                            <option value="2"><?php echo app('translator')->get('Medium'); ?></option>
                                            <option value="1"><?php echo app('translator')->get('Low'); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="form-label"><?php echo app('translator')->get('Message'); ?></label>
                                        <textarea class="form--control" id="inputMessage" name="message" rows="6" required><?php echo e(old('message')); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-end">
                                        <button class="btn btn--base btn-sm addFile" type="button">
                                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('Add New'); ?>
                                        </button>
                                    </div>
                                    <div class="file-upload">
                                        <div class="my-2"> <label class="form-label"><?php echo app('translator')->get('Attachments'); ?></label> <small class="text-danger"><?php echo app('translator')->get('Max 5 files can be uploaded'); ?>. <?php echo app('translator')->get('Maximum upload size is'); ?> <?php echo e(ini_get('upload_max_filesize')); ?></small></div>

                                        <input class="form--control mb-2" id="inputAttachments" name="attachments[]" type="file" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx" />
                                        <div id="fileUploadsContainer"></div>
                                        <p class="ticket-attachments-message text-muted">
                                            <?php echo app('translator')->get('Allowed File Extensions'); ?>: .<?php echo app('translator')->get('jpg'); ?>, .<?php echo app('translator')->get('jpeg'); ?>, .<?php echo app('translator')->get('png'); ?>, .<?php echo app('translator')->get('pdf'); ?>, .<?php echo app('translator')->get('doc'); ?>, .<?php echo app('translator')->get('docx'); ?>
                                        </p>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;<?php echo app('translator')->get('Submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx" class="form--control" required />
                        <button type="button" class="input-group-text btn--danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/support/create.blade.php ENDPATH**/ ?>