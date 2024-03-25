<?php
    $content = getContent('statistics.content', true);
    $time = \Carbon\Carbon::now()->toDateTimeString();
    $phases = \App\Models\Phase::where('status', Status::ENABLE)
        ->where('draw_status', Status::COMPLETE)
        ->where('start_date', '<', $time)
        ->orderBy('draw_date')
        ->whereHas('lottery', function ($lottery) {
            $lottery->where('status', Status::ENABLE);
        })
        ->limit(3)
        ->with('lottery', 'winners')
        ->get();
?>
<?php if($phases->count()): ?>
    <section class="pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-header">
                        <h2 class="section-title"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                <?php $__currentLoopData = $phases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-card__header">
                                <div class="thumb"><img src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery'))); ?>" alt="image"></div>
                                <div class="content">
                                    <h3 class="title"><?php echo e(__($phase->lottery->name)); ?></h3>
                                </div>
                            </div>
                            <ul class="caption-list-two mt-3">
                                <li>
                                    <span class="caption"><?php echo app('translator')->get('Total Bet'); ?></span>
                                    <span class="value text--base text-end"><?php echo e($phase->sold); ?></span>
                                </li>
                                <li>
                                    <span class="caption"><?php echo app('translator')->get('Draw Date'); ?></span>
                                    <span class="value text--base text-end"><?php echo e(showDateTime($phase->draw_date, 'd/m/y')); ?></span>
                                </li>
                                <li>
                                    <span class="caption"><?php echo app('translator')->get('Winners'); ?></span>
                                    <span class="value text--base text-end"><?php echo e(@$phase->winners->count()); ?></span>
                                </li>
                            </ul>
                        </div><!-- stat-card end -->
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <section class="pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-header">
                        <h2 class="section-title"><?php echo e(__(@$content->data_values->heading)); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                <?php $__currentLoopData = $phases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="stat-card">
                            <div class="stat-card__header">
                                <div class="thumb"><img src="<?php echo e(getImage(getFilePath('lottery') . '/' . @$phase->lottery->image, getFileSize('lottery'))); ?>" alt="image"></div>
                                <div class="content">
                                    <h3 class="title"><?php echo e(__($phase->lottery->name)); ?></h3>
                                </div>
                            </div>
                            <ul class="caption-list-two mt-3">
                                <li>
                                    <span class="caption"><?php echo app('translator')->get('Total Bet'); ?></span>
                                    <span class="value text--base text-end"><?php echo e($phase->sold); ?></span>
                                </li>
                                <li>
                                    <span class="caption"><?php echo app('translator')->get('Draw Date'); ?></span>
                                    <span class="value text--base text-end"><?php echo e(showDateTime($phase->draw_date, 'd/m/y')); ?></span>
                                </li>
                                <li>
                                    <span class="caption"><?php echo app('translator')->get('Winners'); ?></span>
                                    <span class="value text--base text-end"><?php echo e(@$phase->winners->count()); ?></span>
                                </li>
                            </ul>
                        </div><!-- stat-card end -->
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

<?php endif; ?>
<?php /**PATH /Users/jobayedsumon/Client/dlottery/core/resources/views/templates/basic/sections/statistics.blade.php ENDPATH**/ ?>