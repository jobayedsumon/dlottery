<?php
    $policyPages = getContent('policy_pages.element', false, null, true);
?>


<?php $__env->startSection('content'); ?>
    <section class="pt-100 pb-100 position-relative z-index-2">
        <div class="ball-1"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-1.png')); ?>" alt="image"></div>
        <div class="ball-2"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-2.png')); ?>" alt="image"></div>
        <div class="ball-3"><img src="<?php echo e(asset($activeTemplateTrue . 'images/ball-3.png')); ?>" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="account-wrapper">
                        <form class="account-form verify-gcaptcha" action="<?php echo e(route('user.register')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="account-thumb-area text-center">
                                <h3 class="title"><?php echo app('translator')->get('Welcome to'); ?> <?php echo e($general->site_name); ?></h3>
                            </div>

                            <div class="row">
                                <?php if(session()->get('reference') != null): ?>
                                    <div class="form-group col-12">
                                        <label for="referenceBy"><?php echo app('translator')->get('Reference By'); ?> <sup class="text-danger">*</sup></label>
                                        <div class="custom--field">
                                            <input class="form--control" id="referenceBy" name="referBy" type="text" value="<?php echo e(session()->get('reference')); ?>" readonly>
                                            <i class="las la-user-alt"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group col-lg-6">
                                    <label for="username"><?php echo app('translator')->get('Username'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control checkUser" id="username" name="username" type="text" value="<?php echo e(old('username')); ?>" required>
                                        <i class="las la-user"></i>
                                    </div>
                                    <small class="text-danger usernameExist"></small>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email"><?php echo app('translator')->get('E-Mail Address'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control checkUser" id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required>
                                        <i class="las la-envelope-open"></i>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="country"><?php echo app('translator')->get('Country'); ?></label>
                                    <div class="custom--field">
                                        <select class="form--control" id="country" name="country" required>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-mobile_code="<?php echo e($country->dial_code); ?>" data-code="<?php echo e($key); ?>" value="<?php echo e($country->country); ?>">
                                                    <?php echo e(__($country->country)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="mobile"><?php echo app('translator')->get('Mobile Number'); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text mobile-code"></span>
                                        <input name="mobile_code" type="hidden">
                                        <input name="country_code" type="hidden">
                                        <input class="form--control border-start-0 checkUser" id="mobile" name="mobile" type="text" value="<?php echo e(old('mobile')); ?>" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="password"><?php echo app('translator')->get('Password'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" id="password" name="password" type="password" required>
                                        <?php if($general->secure_password): ?>
                                            <div class="input-popup">
                                                <p class="error lower"><?php echo app('translator')->get('1 small letter minimum'); ?></p>
                                                <p class="error capital"><?php echo app('translator')->get('1 capital letter minimum'); ?></p>
                                                <p class="error number"><?php echo app('translator')->get('1 number minimum'); ?></p>
                                                <p class="error special"><?php echo app('translator')->get('1 special character minimum'); ?></p>
                                                <p class="error minimum"><?php echo app('translator')->get('6 character password'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <i class="las la-key"></i>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="password-confirm"><?php echo app('translator')->get('Confirm Password'); ?></label>
                                    <div class="custom--field">
                                        <input class="form--control" id="password-confirm" name="password_confirmation" type="password" autocomplete="password" required>
                                        <i class="las la-key"></i>
                                    </div>
                                </div>

                                <div class="py-3">
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
                                </div>

                                <?php if($general->agree): ?>
                                    <div class="form-group col-lg-12">
                                        <input id="agree" name="agree" type="checkbox" required>
                                        <label for="agree"><?php echo app('translator')->get('I agree with'); ?> <span class="text--base">
                                                <?php $__currentLoopData = $policyPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a class="text--base" href="<?php echo e(route('policy.pages', [slug($policy->data_values->title), $policy->id])); ?>"><?php echo e(__($policy->data_values->title)); ?></a>
                                                    <?php if(!$loop->last): ?>
                                                        ,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </label> </span>
                                    </div>
                                <?php endif; ?>

                                <div class="col-12">
                                    <button class="btn btn--base w-100 mt-3" id="recaptcha" type="submit"><?php echo app('translator')->get('Register'); ?></button>
                                    <p class="mt-3 text-center"><span class="text-white"><?php echo app('translator')->get('Have an account'); ?> ?</span> <a
                                            class="text--base" href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?></a>
                                    </p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="existModalCenter" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle"><?php echo app('translator')->get('You are with us'); ?></h5>
                    <span class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center"><?php echo app('translator')->get('You already have an account please Login '); ?></h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn--danger text-white" data-bs-dismiss="modal" type="button"><?php echo app('translator')->get('Close'); ?></button>
                    <a class="btn btn-sm btn--base" href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php if($general->secure_password): ?>
    <?php $__env->startPush('script-lib'); ?>
        <script src="<?php echo e(asset('assets/global/js/secure_password.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        (function($) {
            <?php if($mobileCode): ?>
                $(`option[data-code=<?php echo e($mobileCode); ?>]`).attr('selected', '');
            <?php endif; ?>

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '<?php echo e(route('user.checkUser')); ?>';
                var value = $(this).val();
                var token = '<?php echo e(csrf_token()); ?>';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/user/auth/register.blade.php ENDPATH**/ ?>