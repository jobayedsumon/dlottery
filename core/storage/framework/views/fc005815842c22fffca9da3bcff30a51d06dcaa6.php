<?php $__env->startSection('panel'); ?>
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="border-line-area my-3">
                        <h6 class="border-line-title"><?php echo app('translator')->get('CURRENT SETTING'); ?></h6>
                    </div>
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Winner'); ?></th>
                                    <th><?php echo app('translator')->get('Win Bonus'); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $lottery->bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo app('translator')->get('Winner#'); ?> <?php echo e($p->level); ?></td>
                                        <td><?php echo e($p->amount); ?> <?php echo e(__($general->cur_text)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card parent">
                <div class="card-body">

                    <div class="border-line-area mt-3">
                        <h6 class="border-line-title"><?php echo app('translator')->get('Update Setting'); ?></h6>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('Number of Level'); ?></label>
                        <div class="input-group">
                            <input class="form-control" name="level" type="number" min="1" placeholder="<?php echo app('translator')->get('Type a number & hit ENTER'); ?>↵">
                            <button class="btn btn--primary generate" type="button"><?php echo app('translator')->get('Generate'); ?></button>
                        </div>
                        <span class="text--danger required-message d-none"><?php echo app('translator')->get('Please enter a number'); ?></span>
                    </div>

                    <form class="d-none levelForm" action="<?php echo e(route('admin.lottery.bonus')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input name="lottery_id" type="hidden" value="<?php echo e($lottery->id); ?>">
                        <h6 class="text--danger mb-3"><?php echo app('translator')->get('The Old setting will be removed after generating new'); ?></h6>
                        <div class="form-group">
                            <div class="winBonusLevelAmount"></div>
                        </div>
                        <button class="btn btn--primary h-45 w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </form>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if($lottery->bonuses->count()): ?>
        <a class="btn btn-sm btn-outline--warning float-sm-end" href="<?php echo e(route('admin.lottery.phase.single.lottery', $lottery->id)); ?>"> <i class="las la-layer-group"></i><?php echo app('translator')->get('Set Lottery Phase'); ?></a>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .border-line-area {
            position: relative;
            text-align: center;
            z-index: 1;
        }

        .border-line-area::before {
            position: absolute;
            content: '';
            top: 50%;
            left: 0;
            width: 100%;
            height: 1px;
            background-color: #e5e5e5;
            z-index: -1;
        }

        .border-line-title {
            display: inline-block;
            padding: 3px 10px;
            background-color: #fff;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($) {
            "use strict"

            $('[name="level"]').on('focus', function() {
                $(this).on('keyup', function(e) {
                    if (e.which == 13) {
                        generrateLevels($(this));
                    }
                });
            });

            $(".generate").on('click', function() {
                let $this = $(this).parents('.card-body').find('[name="level"]');
                generrateLevels($this);
            });

            $(document).on('click', '.deleteBtn', function() {
                $(this).closest('.input-group').remove();
                $.each($('.level-index'), function(i, e) {
                    $(e).text(`<?php echo app('translator')->get('Winner Level'); ?> ${i + 1}`)
                });

            });

            function generrateLevels($this) {
                let numberOfLevel = $this.val();
                let parent = $this.parents('.card-body');
                let html = '';
                if (numberOfLevel && numberOfLevel > 0) {
                    parent.find('.levelForm').removeClass('d-none');
                    parent.find('.required-message').addClass('d-none');

                    for (i = 1; i <= numberOfLevel; i++) {
                        html += `
                    <div class="input-group mb-3">
                        <span class="input-group-text justify-content-center"> <span class="level-index"><?php echo app('translator')->get('Winner Level'); ?> ${i}</span></span>
                        <input name="amount[]" class="form-control col-5" type="number" step="any" required placeholder="<?php echo app('translator')->get('Won Bonus Amount, By'); ?> <?php echo e($general->cur_text); ?>" >
                        <button class="btn btn--danger input-group-text border-0 deleteBtn" type="button"><i class=\'la la-times\'></i></button>
                    </div>`
                    }

                    parent.find('.winBonusLevelAmount').html(html);
                } else {
                    parent.find('.levelForm').addClass('d-none');
                    parent.find('.required-message').removeClass('d-none');
                }
            }

        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/lottery/win_bonus.blade.php ENDPATH**/ ?>