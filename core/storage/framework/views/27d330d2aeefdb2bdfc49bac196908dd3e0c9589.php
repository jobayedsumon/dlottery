<?php
    $subscribe = getContent('subscribe.content', true);
?>

<section class="pb-100">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                <div class="subscribe-wrapper bg_img" data-background="assets/images/bg/arrow.png">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <h2 class="title"><?php echo e(__(@$subscribe->data_values->heading)); ?></h2>
                        </div>
                        <div class="col-lg-7 mt-lg-0 mt-4">
                            <form class="subscribe-form" action="<?php echo e(route('subscribe')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input class="form--control" name="email" type="email" autocomplete="off" placeholder="Email Address">
                                <button class="btn btn-md btn--base btn--capsule"><?php echo app('translator')->get('Subscribe'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('script'); ?>
    <script type="text/javascript">
        $('.subscribe-form').on('submit', function(e) {
            e.preventDefault();
            let url = `<?php echo e(route('subscribe')); ?>`;

            let data = {
                email: $(this).find('input[name=email]').val()
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': `<?php echo e(csrf_token()); ?>`
                }
            });

            $.post(url, data, function(response) {
                if (response.errors) {
                    for (var i = 0; i < response.errors.length; i++) {
                        iziToast.error({
                            message: response.errors[i],
                            position: "topRight"
                        });
                    }
                } else {
                    $('.subscribe-form').trigger("reset");
                    iziToast.success({
                        message: response.success,
                        position: "topRight"
                    });
                }
            });
            this.reset();
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/subscribe.blade.php ENDPATH**/ ?>