

<?php $__env->startSection('content'); ?>
    <!-- Service Start -->
    <div class="container-xxl py-5">
  
        <div class="row g-4 justify-content-center">

            <div class="container p-5">
                <div class="row">
                    <h1 class="mb-4">Academic Tests</h1>

                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-3 mb-4">
                            <div class="card  shadow-lg">
                                <div class="card-body">
                                    <div class="text-center p-3">
                                        <h5 class="card-title"><?php echo e($test->name); ?></h5>

                                    </div>

                                </div>

                                <div class="card-body text-center">
                                    <button style="border-radius:30px" type="button" data-bs-toggle="modal"
                                        data-bs-target="#test-category-<?php echo e($test->id); ?>"
                                        class="btn btn-outline-primary btn-lg">
                                        <span class="indicator-label">Start Test</span>

                                    </button>

                                </div>
                            </div>
                        </div>
                        <?php echo $__env->make('layouts.partials.models.test-category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </div>
            </div>
        </div>
        <!-- About Start -->
    </div>
    <!-- Testimonial End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/frontend/pages/academic-test.blade.php ENDPATH**/ ?>