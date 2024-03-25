<?php $__env->startSection('content'); ?>
    <section class="pb-100 pt-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 account-wrapper">
                    <div class="account-form">
                        <div class="card-header card-header-bg d-flex justify-content-between align-items-center flex-wrap">
                            <h5 class="mt-0 text-white">
                                <?php echo $myTicket->statusBadge; ?>
                                [<?php echo app('translator')->get('Ticket'); ?>#<?php echo e($myTicket->ticket); ?>] <?php echo e($myTicket->subject); ?>

                            </h5>
                            <?php if($myTicket->status != Status::TICKET_CLOSE && $myTicket->user): ?>
                                <button class="btn btn-danger close-button btn-sm confirmationBtn" data-question="<?php echo app('translator')->get('Are you sure to close this ticket?'); ?>" data-action="<?php echo e(route('ticket.close', $myTicket->id)); ?>" type="button"><i class="fa fa-lg fa-times-circle"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo e(route('ticket.reply', $myTicket->id)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row justify-content-between">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form--control" name="message" rows="4"><?php echo e(old('message')); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a class="btn btn--base btn-sm addFile" href="javascript:void(0)"><i class="fa fa-plus"></i> <?php echo app('translator')->get('Add New'); ?></a>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo app('translator')->get('Attachments'); ?></label> <small class="text-danger"><?php echo app('translator')->get('Max 5 files can be uploaded'); ?>. <?php echo app('translator')->get('Maximum upload size is'); ?> <?php echo e(ini_get('upload_max_filesize')); ?></small>
                                    <input class="form--control" name="attachments[]" type="file" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx" />
                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted my-2">
                                        <?php echo app('translator')->get('Allowed File Extensions'); ?>: .<?php echo app('translator')->get('jpg'); ?>, .<?php echo app('translator')->get('jpeg'); ?>, .<?php echo app('translator')->get('png'); ?>, .<?php echo app('translator')->get('pdf'); ?>, .<?php echo app('translator')->get('doc'); ?>, .<?php echo app('translator')->get('docx'); ?>
                                    </p>
                                </div>
                                <button class="btn btn--base w-100" type="submit"> <i class="fa fa-reply"></i> <?php echo app('translator')->get('Reply'); ?></button>
                            </form>
                        </div>
                    </div>

                    <div class="custom__bg mt-4">
                        <div class="card-body">
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($message->admin_id == 0): ?>
                                    <div class="row border-primary rounded-bottom border-radius-3 my-3 mx-2 border py-3" style="background-color: #d4b55829">
                                        <div class="col-md-3 border-end text-end">
                                            <h6 class="my-2"><?php echo e($message->ticket->name); ?></h6>
                                        </div>
                                        <div class="col-md-9">
                                            <small class="text-muted fw-bold my-3">
                                                <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></small>
                                            <p><?php echo e($message->message); ?></p>
                                            <?php if($message->attachments->count() > 0): ?>
                                                <div class="mt-2">
                                                    <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a class="me-3" href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="row border-warning border-radius-3 rounded-top my-3 mx-2 border py-3">
                                        <div class="col-md-3 border-end text-end">
                                            <h6 class="my-2"><?php echo e($message->admin->name); ?></h6>
                                            <p class="lead text-muted"><?php echo app('translator')->get('Staff'); ?></p>
                                        </div>
                                        <div class="col-md-9">
                                            <small class="text-muted fw-bold my-3">
                                                <?php echo app('translator')->get('Posted on'); ?> <?php echo e($message->created_at->format('l, dS F Y @ H:i')); ?></small>
                                            <p><?php echo e($message->message); ?></p>
                                            <?php if($message->attachments->count() > 0): ?>
                                                <div class="mt-2">
                                                    <?php $__currentLoopData = $message->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a class="me-3" href="<?php echo e(route('ticket.download', encrypt($image->id))); ?>"><i class="fa fa-file"></i> <?php echo app('translator')->get('Attachment'); ?> <?php echo e(++$k); ?> </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    
    <div class="modal fade" id="confirmationModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Confirmation Alert!'); ?></h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p class="question"></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn--danger text-white" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('No'); ?></button>
                        <button class="btn btn-sm btn--base" type="submit"><?php echo app('translator')->get('Yes'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        <button type="submit" class="input-group-text btn-danger text--dark remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });

            //confirmation-modal
            $(document).on('click', '.confirmationBtn', function() {
                var modal = $('#confirmationModal');
                let data = $(this).data();
                modal.find('.question').text(`${data.question}`);
                modal.find('form').attr('action', `${data.action}`);
                modal.modal('show');
            });

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.' . $layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/support/view.blade.php ENDPATH**/ ?>