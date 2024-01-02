<div class="container">
    <div class="row">
        <div class="col-12">

            <?php if($question->image_url): ?>
                
                <img src="<?php echo e($question->image_url); ?>" alt="<?php echo e($question->image_url); ?>">

                
                </br>
            <?php endif; ?>
            <p class="fw-bold">
                <?php if($question->fillInBlank->fill_1): ?>
                    <?php echo $question->fillInBlank->fill_1; ?> <?php echo e($iteration); ?> <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                        onkeyup="changeColorCodefill(this.value,'question_<?php echo e($question->id); ?>')" name="fill[<?php echo e($question->id); ?>][]"
                        id="fill_<?php echo e($question->fillInBlank->id); ?>">
                <?php endif; ?>

                <?php if($question->fillInBlank->fill_2): ?>
                    <?php echo $question->fillInBlank->fill_2; ?> 
                    <?php if($question->fillInBlank->ans_sec_1 || $question->fillInBlank->ans_sec_2 || $question->fillInBlank->ans_sec_3): ?>
                    <?php echo e($iteration); ?>  <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                            onkeyup="changeColorCodefill(this.value,'question_<?php echo e($question->id); ?>')" name="fill[<?php echo e($question->id); ?>][]"
                            id="fill_<?php echo e($question->fillInBlank->id); ?>">
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($question->fillInBlank->fill_3): ?>

                    <?php echo $question->fillInBlank->fill_3; ?>

                    <?php if($question->fillInBlank->ans_third_1 || $question->fillInBlank->ans_third_2 || $question->fillInBlank->ans_third_3): ?>
                        <?php echo e($iteration); ?> <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                            onkeyup="changeColorCodefill(this.value,'question_<?php echo e($question->id); ?>')"
                            name="fill[<?php echo e($question->id); ?>][]" id="fill_<?php echo e($question->fillInBlank->id); ?>">
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($question->fillInBlank->fill_4): ?>
                    <?php echo $question->fillInBlank->fill_4; ?> <?php echo e($iteration); ?> <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" style="width:100px"
                        onkeyup="changeColorCodefill(this.value,'question_<?php echo e($question->id); ?>')" name="fill[<?php echo e($question->id); ?>][]"
                        id="fill_<?php echo e($question->fillInBlank->id); ?>">
                <?php endif; ?>


            </p>
            <div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/frontend/pages/reading-test/partials/fill-in-blank.blade.php ENDPATH**/ ?>