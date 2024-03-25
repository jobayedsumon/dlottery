

<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg-transparent">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table bg-white">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('S.N.'); ?></th>
                                    <th><?php echo app('translator')->get('Image'); ?></th>
                                    <th><?php echo app('translator')->get('Lottery Name'); ?></th>
                                    <th><?php echo app('translator')->get('Price'); ?></th>
                                    <th><?php echo app('translator')->get('Total Phase'); ?></th>
                                    <th><?php echo app('translator')->get('Total Draw'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $__empty_1 = true; $__currentLoopData = $lotteries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lottery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($lotteries->firstItem() + $loop->index); ?></td>
                                        <td>
                                            <div class="customer-details d-block">
                                                <a class="thumb" href="javascript:void(0)">
                                                    <img src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$lottery->image, getFileSize('lottery'))); ?>" alt="image">
                                                </a>
                                            </div>
                                        </td>
                                        <td><?php echo e($lottery->name); ?></td>
                                        <td><?php echo e($general->cur_sym); ?><?php echo e(showAmount($lottery->price)); ?></td>
                                        <td><?php echo e($lottery->phase->count()); ?></td>
                                        <td>
                                            <?php echo e($lottery->phase->where('draw_status', Status::COMPLETE)->count()); ?></td>
                                        <td>
                                            <?php echo $lottery->statusBadge ?>

                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <?php if($lottery->status == Status::ACTIVE): ?>
                                                    <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-id="<?php echo e($lottery->id); ?>" data-status="<?php echo e($lottery->status); ?>">
                                                        <i class="la la-eye-slash"></i> <?php echo app('translator')->get('Inactive'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-id="<?php echo e($lottery->id); ?>" data-status="<?php echo e($lottery->status); ?>">
                                                        <i class="la la-eye"></i> <?php echo app('translator')->get('Active'); ?>
                                                    </button>
                                                <?php endif; ?>
                                                <a class="btn btn-sm btn-outline--primary ms-1 editBtn" href="<?php echo e(route('admin.lottery.edit', $lottery->id)); ?>">
                                                    <i class="la la-pen"></i> <?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                                <button class="btn btn-sm btn-outline--info ms-1 dropdown-toggle" data-bs-toggle="dropdown" type="button" aria-expanded="false">
                                                    <i class="la la-ellipsis-v"></i><?php echo app('translator')->get('More'); ?>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item editBtn text--info" href="<?php echo e(route('admin.lottery.win.bonus', $lottery->id)); ?>">
                                                            <i class="las la-trophy"></i> <?php echo app('translator')->get('Set Win Bonus'); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item editBtn text--warning" href="<?php echo e(route('admin.lottery.phase.single.lottery', $lottery->id)); ?>">
                                                            <i class="fas fa-layer-group"></i> <?php echo app('translator')->get('Ticket phases'); ?>
                                                        </a>
                                                    </li>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-center" colspan="100"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($lotteries->hasPages()): ?>
                        <div class="card-footer py-4">
                            <?php echo e(paginateLinks($lotteries)); ?>

                        </div>
                    <?php endif; ?>
                </div>
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
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'lottery name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'lottery name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <a class="btn btn-sm btn-outline--primary" href="<?php echo e(route('admin.lottery.form')); ?>"><i class="la la-plus"></i>
        <?php echo app('translator')->get('Add New'); ?></a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .table-responsive {
            min-height: 300px;
            background: transparent
        }

        .card {
            box-shadow: none;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            $('.confirmationBtn').on('click', function() {
                var status = $(this).data('status');
                var id = $(this).data('id');
                var modal = $('#confirmationModal');
                var text = status ? `<?php echo app('translator')->get('Are you sure to inactive this lottery?'); ?>` : `<?php echo app('translator')->get('Are you sure to active this lottery?'); ?>`;
                var url = `<?php echo e(route('admin.lottery.status', '')); ?>/${id}`;
                modal.find('.modal-body').text(text);
                modal.find('form').attr('action', url);
                console.log(url);
                modal.modal('show')

            });


        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/lottery/index.blade.php ENDPATH**/ ?>