<div class="col-12 mt-3 ">
    <p class="fw-bold"><?php echo e($iteration); ?>: <?php echo $question->name; ?></p>
    <div>
        <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <?php if($question->image_url): ?>
                  
                    <button type="button" data-bs-toggle="modal" data-bs-target="#question-image-<?php echo e($question->id); ?>">
                        <span class="indicator-label"> <img src="<?php echo e($question->image_url); ?>" 
                                alt="<?php echo e($question->image_url); ?>"></span>

                    </button>
                </br>
                <?php endif; ?>
                <input type="radio" onclick="changeColorCode('question_<?php echo e($question->id); ?>')"
                    name="mcqs[<?php echo e($question->id); ?>]" value="<?php echo e($option->id); ?>" id="option-<?php echo e($option->id); ?>">


                <label for="option-<?php echo e($option->id); ?>" class="box first">
                    <div class="course"> <span class="circle"></span> <span class="subject">

                            <?php echo e($option->name); ?>

                        </span> </div>
                </label>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/frontend/pages/reading-test/partials/mcqs.blade.php ENDPATH**/ ?>