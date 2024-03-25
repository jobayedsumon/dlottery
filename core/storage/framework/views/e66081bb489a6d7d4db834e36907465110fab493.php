<?php
    $about = getContent('about.content', true);
?>
<section class="pt-100 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-thumb">
                    <img src="<?php echo e(getImage('assets/images/frontend/about/' . @$about->data_values->image, '636x358')); ?>" alt="image">
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5 mt-lg-0">
                <h2 class="section-title"><?php echo e(__(@$about->data_values->heading)); ?></h2>
                <?php echo e(__(@$about->data_values->description)); ?>

            </div>
        </div>
    </div>
</section>
<?php /**PATH /home/dlotonli/public_html/core/resources/views/templates/basic/sections/about.blade.php ENDPATH**/ ?>