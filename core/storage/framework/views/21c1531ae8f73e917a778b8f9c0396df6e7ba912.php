<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('SL@'); ?></th>
                                    <th><?php echo app('translator')->get('Image'); ?></th>
                                    <th><?php echo app('translator')->get('Lottery Name | Phase Number '); ?></th>
                                    <th><?php echo app('translator')->get('Ticket Qty'); ?></th>
                                    <th><?php echo app('translator')->get('Sold Tickets | Remaining Qty'); ?></th>
                                    <th><?php echo app('translator')->get('Start Date | Draw Date'); ?></th>
                                    <th><?php echo app('translator')->get('Draw Status | Draw Type'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $phases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($phases->firstItem() + $loop->index); ?></td>
                                        <td>
                                            <div class="customer-details d-block">
                                                <a class="thumb" href="javascript:void(0)">
                                                    <img src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery'))); ?>" alt="image">
                                                </a>
                                            </div>
                                        </td>
                                        <td><span class="fw-bold"><?php echo e($phase->lottery->name); ?></span>
                                            <br>
                                            <?php echo app('translator')->get('Phase'); ?># <?php echo e($phase->phase_number); ?>

                                        </td>
                                        <td><?php echo e($phase->quantity); ?></td>
                                        <td>
                                            <span class="fw-bold"><?php echo e($phase->sold); ?></span>
                                            <br>
                                            <?php echo e($phase->available); ?>

                                        </td>

                                        <td>
                                            <?php echo e(showDateTime($phase->start_date, 'Y-M-d')); ?>

                                            <br>
                                            <?php echo e(showDateTime($phase->draw_date, 'Y-M-d')); ?>

                                        </td>
                                        <td>
                                            <?php echo $phase->DrawBadge ?>
                                            <br>
                                            <?php echo $phase->DrawTypeBadge ?>
                                        </td>
                                        <td> <?php echo $phase->statusBadge ?> </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary <?php if($phase->draw_status == Status::RUNNING): ?> cuModalBtn <?php endif; ?>" data-resource="<?php echo e($phase); ?>" data-modal_title="<?php echo app('translator')->get('Edit Lottery Phase'); ?>" type="button" <?php if($phase->draw_status == Status::COMPLETE): ?> disabled <?php endif; ?>>
                                                <i class="la la-pencil"></i><?php echo app('translator')->get('Edit'); ?>
                                            </button>
                                            <?php if($phase->status == Status::ACTIVE): ?>
                                                <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-id="<?php echo e($phase->id); ?>" data-status="<?php echo e($phase->status); ?>" <?php if($phase->draw_status == Status::COMPLETE): ?> disabled <?php endif; ?>>
                                                    <i class="la la-eye-slash"></i> <?php echo app('translator')->get('Inactive'); ?>
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-id="<?php echo e($phase->id); ?>" data-status="<?php echo e($phase->status); ?>" <?php if($phase->draw_status == Status::COMPLETE): ?> disabled <?php endif; ?>>
                                                    <i class="la la-eye"></i> <?php echo app('translator')->get('Active'); ?>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo app('translator')->get('Please go to add new phase!'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($phases->hasPages()): ?>
                        <div class="card-footer py-4">
                            <?php echo e(paginateLinks($phases)); ?>

                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="type"></span> <span><?php echo app('translator')->get('Add Expense'); ?></span></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.lottery.phase.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <?php if(!request()->routeIs('admin.lottery.phases')): ?>
                                <label><?php echo app('translator')->get('Lottery'); ?></label>
                                <input name="lottery_id" type="hidden" value="<?php echo e($lottery->id); ?>">
                                <input class="form-control" type="text" value="<?php echo e($lottery->name); ?>" disabled>
                            <?php else: ?>
                                <label><?php echo app('translator')->get('Lottery'); ?></label>
                                <select class="form-control" name="lottery_id" required>
                                    <option value="" disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                                    <?php $__currentLoopData = $lotteries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lottery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option data-running="<?php echo e($lottery->isRunning); ?>" value="<?php echo e($lottery->id); ?>"><?php echo e($lottery->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Start Date'); ?></label>
                            <input class="modal-datepicker form-control bg--white" name="start_date" data-language="en" data-date-format="yyyy-mm-dd" type="text" value="<?php echo e(date('Y-m-d')); ?>" autocomplete="off" required>
                            <small class="text-muted text--small"> <i class="la la-info-circle"></i>
                                <?php echo app('translator')->get('Year-Month-Date'); ?></small>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Draw Date'); ?></label>
                            <input class="datepicker-here form-control bg--white" name="draw_date" data-language="en" data-date-format="yyyy-mm-dd" type="text" value="<?php echo e(date('Y-m-d')); ?>" autocomplete="off" required>
                            <small class="text-muted text--small"> <i class="la la-info-circle"></i>
                                <?php echo app('translator')->get('Year-Month-Date'); ?></small>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('Quantity'); ?></label>
                            <input class="form-control" name="quantity" type="number" step="any" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo app('translator')->get('Draw Type'); ?></label>
                            <select class="form-control" name="draw_type" required>
                                <option value="" disabled selected><?php echo app('translator')->get('Select One'); ?></option>
                                <option value="1"><?php echo app('translator')->get('Auto Draw'); ?></option>
                                <option value="2"><?php echo app('translator')->get('Manual Draw'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn--primary h-45 w-100 actionBtn" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><?php echo app('translator')->get('Confirmation Alert!'); ?></h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('No'); ?></button>
                        <button class="btn btn--primary" type="submit"><?php echo app('translator')->get('Yes'); ?></button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>

    <?php if(request()->routeIs('admin.lottery.phases')): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Lottery Name','dateSearch' => 'yes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Lottery Name','dateSearch' => 'yes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['keySearch' => 'no','dateSearch' => 'yes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['keySearch' => 'no','dateSearch' => 'yes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.back','data' => ['route' => ''.e(route('admin.lottery.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('back'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => ''.e(route('admin.lottery.index')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>

    <button class="btn btn-sm btn-outline--primary float-sm-end cuModalBtn" data-modal_title="<?php echo app('translator')->get('Add Lottery Phase'); ?>" type="button" <?php if(@$isRunning): ?> disabled <?php endif; ?>>
        <i class="las la-plus"></i><?php echo app('translator')->get('Add new'); ?>
    </button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .datepicker {
            z-index: 9999
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict";
            $('.modal-datepicker').datepicker();
            //Check-Lottery
            $('[name=lottery_id]').on('change', function() {
                let lottery_id = $("option:selected").val();
                let isRunning = $("option:selected").data('running');
                if (lottery_id && isRunning) {
                    $('.actionBtn').attr('disabled', 'disabled');
                } else {
                    $('.actionBtn').removeAttr("disabled");
                }
            });
            $('.confirmationBtn').on('click', function() {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var modal = $('#confirmationModal');
                var text = status ? `<?php echo app('translator')->get('Are you sure to inactive this lottery?'); ?>` : `<?php echo app('translator')->get('Are you sure to active this lottery?'); ?>`;
                var url = `<?php echo e(route('admin.lottery.phase.status', '')); ?>/${id}`;
                modal.find('.modal-body').text(text);
                modal.find('form').attr('action', url);
                console.log(url);
                modal.modal('show')

            });
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/lottery/phases.blade.php ENDPATH**/ ?>