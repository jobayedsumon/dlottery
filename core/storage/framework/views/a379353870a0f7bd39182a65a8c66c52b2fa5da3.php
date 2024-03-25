<div class="table-responsive--md">
    <table class="custom--table table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('Title'); ?></th>
                <th><?php echo app('translator')->get('Start Date'); ?></th>
                <th><?php echo app('translator')->get('Draw Date'); ?></th>
                <th><?php echo app('translator')->get('Price'); ?></th>
                <th><?php echo app('translator')->get('Sold'); ?></th>
                <th><?php echo app('translator')->get('Status'); ?></th>
                <th><?php echo app('translator')->get('Action'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $phases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="table-game">
                            <img src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery'))); ?>" alt="image">
                            <h6 class="name"><?php echo e(__($phase->lottery->name)); ?></h6>
                        </div>
                    </td>
                    <td><?php echo e(@showDateTime($phase->start_date, 'Y-m-d')); ?></td>
                    <td><?php echo e(@showDateTime($phase->draw_date, 'Y-m-d')); ?></td>
                    <td><?php echo e(showAmount($phase->lottery->price)); ?> <?php echo e($general->cur_text); ?></td>
                    <td>
                        <div class="progress lottery--progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo e(($phase->sold / $phase->quantity) * 100); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(($phase->sold / $phase->quantity) * 100); ?>%"></div>
                        </div>
                        <span class="fs--14px"><?php echo e(getAmount(($phase->sold / $phase->quantity) * 100)); ?>%</span>
                    </td>
                    <td>
                        <?php  echo $phase->DrawBadge; ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-outline--base" href="<?php if(request()->routeIs('user.*')): ?> <?php echo e(route('user.lottery.details', $phase->id)); ?> <?php else: ?> <?php echo e(route('lottery.details', $phase->id)); ?> <?php endif; ?>">
                            <?php if(@request()->routeIs('user.home')): ?>
                                <?php echo app('translator')->get('Play Now'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('Buy Ticket'); ?>
                            <?php endif; ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?>

                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/partials/lotteries.blade.php ENDPATH**/ ?>