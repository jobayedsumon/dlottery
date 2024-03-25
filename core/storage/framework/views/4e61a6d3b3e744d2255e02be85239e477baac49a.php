 <!-- Modal -->
 <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('Confirmation Alert!'); ?></h5>
                 <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                     <i class="las la-times"></i>
                 </span>
             </div>
             <div class="modal-body">
                 <?php echo app('translator')->get('Are you sure to buy tickets?'); ?>
             </div>
             <div class="modal-footer">
                 <button class="btn btn-sm btn--danger text-white" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('No'); ?></button>
                 <button class="btn btn-sm btn--base buyTicketConfirmation" type="button"><?php echo app('translator')->get('Yes'); ?></button>
             </div>
         </div>
     </div>
 </div>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/partials/ticket_confirmation_modal.blade.php ENDPATH**/ ?>