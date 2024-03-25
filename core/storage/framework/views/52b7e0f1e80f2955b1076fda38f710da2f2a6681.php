<?php
    $cta = getContent('cta.content', true);
?>

<!-- cta section start -->
<section class="pt-100 pb-100 bg_img" style="background-image: url(<?php echo e(getImage('assets/images/frontend/cta/' . @$cta->data_values->image, '1920x999')); ?>);">
    <div class="container">
        <div class="row justify-content-center wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
            <div class="col-lg-7 text-center">
                <h2 class="section-title"><?php echo e(__(@$cta->data_values->heading)); ?></h2>
                <p class="mt-3"><?php echo e(__(@$cta->data_values->subheading)); ?></p>
                <a class="btn btn--base btn--capsule mt-4" href="<?php echo e(@$cta->data_values->button_url); ?>"><?php echo e(__(@$cta->data_values->button_name)); ?></a>
            </div>
        </div>
    </div>
</section>
<!-- cta section end -->
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/cta.blade.php ENDPATH**/ ?>