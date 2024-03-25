
<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="<?php echo e(route('admin.lottery.store', @$lottery->id)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url(<?php echo e(getImage(getFilePath('lottery') . '/' . @$lottery->image, getFileSize('lottery'))); ?>)">
                                                    <button class="remove-image" type="button"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input class="profilePicUpload" id="profilePicUpload1" name="image" type="file" accept=".png, .jpg, .jpeg" requierd>
                                                <label class="bg--primary" for="profilePicUpload1"><?php echo app('translator')->get('Image'); ?></label>
                                                <small class="text-facebook mt-2"><?php echo app('translator')->get('Supported files:'); ?>
                                                    <b><?php echo app('translator')->get('jpeg, jpg, png'); ?></b>. <?php echo app('translator')->get('Image will be resized into'); ?>
                                                    <b><?php echo e(getFileSize('lottery')); ?> <?php echo app('translator')->get('px'); ?></b></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                    <input class="form-control" name="name" type="text" value="<?php echo e(old('name', @$lottery->name)); ?>" required />
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Ticket Price'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?php echo e($general->cur_sym); ?></span>
                                        <input class="form-control" name="price" type="number" value="<?php echo e(old('price', @$lottery->price)); ?>" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('Instruction'); ?></label>
                                    <textarea class="form-control nicEdit" name="instruction" rows="8"><?php echo e(old('instruction', @$lottery->instruction)); ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/admin/lottery/form.blade.php ENDPATH**/ ?>