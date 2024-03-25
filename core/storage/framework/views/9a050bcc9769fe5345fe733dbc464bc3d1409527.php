<?php
    $contact = getContent('contact_us.content', true);
?>

<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-50">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-lg-4">
                    <h2 class="mb-3"><?php echo e(__(@$contact->data_values->title)); ?></h2>
                    <p><?php echo e(__(@$contact->data_values->short_details)); ?></p>
                    <div class="row gy-4 mt-3">
                        <div class="col-lg-12">
                            <div class="contact-info-card rounded-3">
                                <h6 class="mb-3"><?php echo app('translator')->get('Office Address'); ?></h6>
                                <div class="contact-info d-flex">
                                    <i class="las la-map-marked-alt"></i>
                                    <p><?php echo e(__(@$contact->data_values->address)); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-info-card rounded-3">
                                <h6 class="mb-3"><?php echo app('translator')->get('Phone Number'); ?></h6>
                                <div class="contact-info d-flex">
                                    <i class="las la-phone-volume"></i>
                                    <p><a href="tel:<?php echo e(@$contact->data_values->contact_number); ?>"><?php echo e(@$contact->data_values->contact_number); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-info-card rounded-3">
                                <h6 class="mb-3"><?php echo app('translator')->get('Email Address'); ?></h6>
                                <div class="contact-info d-flex">
                                    <i class="las la-envelope"></i>
                                    <p><a href="mailto:<?php echo e(@$contact->data_values->email_address); ?>"><?php echo e(@$contact->data_values->email_address); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- row end -->

                </div>
                <div class="col-lg-8 ps-lg-5">
                    <div class="contact-wrapper rounded-3">
                        <form class="contact-form verify-gcaptcha" method="POST" action="">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label><?php echo app('translator')->get('Name'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" name="name" type="text" value="<?php if(auth()->user()): ?> <?php echo e(auth()->user()->fullname); ?> <?php else: ?><?php echo e(old('name')); ?> <?php endif; ?>" <?php if(auth()->user()): ?> readonly <?php endif; ?> required>
                                        <i class="las la-user"></i>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label><?php echo app('translator')->get('Email'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" name="email" type="email" value="<?php if(auth()->user()): ?> <?php echo e(auth()->user()->email); ?><?php else: ?><?php echo e(old('email')); ?> <?php endif; ?>" <?php if(auth()->user()): ?> readonly <?php endif; ?> required>
                                        <i class="las la-envelope"></i>
                                    </div>
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label><?php echo app('translator')->get('Subject'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" name="subject" type="text" value="<?php echo e(old('subject')); ?>" required>
                                        <i class="las la-pen"></i>
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <label><?php echo app('translator')->get('Message'); ?></label>
                                    <div class="custom--field">
                                        <textarea class="form--control" name="message" wrap="off" required><?php echo e(old('message')); ?></textarea>
                                        <i class="las la-envelope"></i>
                                    </div>
                                </div>

                                <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve(['path' => ''.e($activeTemplate . 'partials').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>

                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit"><?php echo app('translator')->get('Submit'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if($sections->secs != null): ?>
        <?php $__currentLoopData = json_decode($sections->secs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make($activeTemplate . 'sections.' . $sec, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/contact.blade.php ENDPATH**/ ?>