
<?php $__env->startSection('css'); ?>
    <style>
        .number-box {
            width: 13px;
            height: 13px;
            background-color: #c7cfcf;
            color: #fff;
            text-align: center;
            font-size: 9px;
            line-height: 13px;
            font-weight: bold;
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
        }

        .highlight {
            background-color: yellow;
            /* You can customize the highlight color */
        }

        .card:hover {
            transform: scale(1, 1);
            /* Reset the scale transformation */
            -webkit-transform: scale(1, 1);
            backface-visibility: visible;
            /* Reset backface visibility */
            will-change: auto;
            /* Reset will-change property */
            box-shadow: none !important;
            /* Remove the box shadow */
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Service Start -->
    <div class="container-xxl py-5" style="max-width: 1500px;">
        <nav class="navbar navbar-expand-lg bg-white  navbar-light shadow sticky-top p-0">


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav p-2">
                    

                    <div class="row">
                        <?php
                            $itera = 1;
                        ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2">
                                <h6>
                                    <?php if($key == 1): ?>
                                        Part One
                                    <?php endif; ?>
                                    <?php if($key == 2): ?>
                                        Part Two
                                    <?php endif; ?>
                                    <?php if($key == 3): ?>
                                        Part Three
                                    <?php endif; ?>
                                    <?php if($key == 4): ?>
                                        Part Four
                                    <?php endif; ?>
                                    <?php if($key == 5): ?>
                                        Part Five
                                    <?php endif; ?>
                                </h6>

                                <div>
                                    <?php $__currentLoopData = $group['questionGroups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $group['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($question->category == 3): ?>
                                                <div class="number-box question_<?php echo e($question->id); ?>">

                                                    <?php echo e($itera); ?>


                                                    <?php
                                                        $itera++;
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="number-box question_<?php echo e($question->id); ?>">

                                                <?php echo e($itera); ?>


                                                <?php
                                                    $itera++;
                                                ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2">
                            <h4 class="mb-4"><?php echo e($test->name); ?></h4>
                            <h4 id="timer"><i class="far fa-clock"></i> <span id="countdown">2520</span>sec</h4>
                        </div>


                    </div>
                    <div class="col-md-2">


                        <select id="fontSizeSelect" class="form-control form-control-solid required">
                            <option value="">Font</option>
                            <option value="12">12</option>
                            <option value="14">14</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
                            <option value="20">20</option>
                            <option value="24">24</option>
                        </select>

                        <div class="mr-2">
                            <button class="btn btn-primary" id="highlightButton"><i class="fas fa-pen"></i>
                            </button>

                            <button class="btn btn-primary" id="removeHighlightButton"><i
                                    class="fas fa-trash-alt"></i></button>
                            <button class="btn btn-primary" id="removeAllButton"><i
                                    class="fas fa-times-circle"></i></button>

                        </div>
                    </div>

                </div>
            </div>
        </nav>
        <div class="row g-4 justify-content-center" id="changeFontSize">
            <div id="audioPlayer">
                <audio id="customAudio">
                    <source src="<?php echo e($test->audio); ?>" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>
                <br>
                <label for="volume">Volume:</label>
                <input type="range" id="volume" name="volume" min="0" max="1" step="0.1"
                    value="1">
            </div>
            <form action="<?php echo e(route('listening.test.finish')); ?>" id="listeningTest" method="post">
                <input type="hidden" name="test_id" value="<?php echo e($test->id); ?>">
                <input type="hidden" name="type" value="reading">
                <div class="container " style="max-width: 1500px;">

                    <?php
                        $iteration = 1;
                    ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 mt-5"
                                style="padding : 0px;max-height: 700px; overflow-y:auto; border: 2px solid #BFBDBD;">

                                <div class="card-body mb-5" style="padding : 0px; ">

                                    <div class="container mb-5">
                                        <h2>
                                            <?php if($key == 1): ?>
                                                Part One
                                            <?php endif; ?>
                                            <?php if($key == 2): ?>
                                                Part Two
                                            <?php endif; ?>
                                            <?php if($key == 3): ?>
                                                Part Three
                                            <?php endif; ?>
                                            <?php if($key == 4): ?>
                                                Part Four
                                            <?php endif; ?>
                                            <?php if($key == 5): ?>
                                                Part Five
                                            <?php endif; ?>
                                        </h2>
                                        <?php $__currentLoopData = $group['questionGroups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class=" mt-5 p-2" style="border: 2px solid #BFBDBD;">
                                                <?php echo $group['questionGroup']->heading; ?>

                                                <?php echo $group['questionGroup']->description; ?>

                                                <?php $__currentLoopData = $group['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                    <?php if($question->category == 1): ?>
                                                        <?php echo $__env->make('frontend.pages.reading-test.partials.mcqs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php
                                                            $iteration++;
                                                        ?>
                                                    <?php endif; ?>
                                                    <?php if($question->category == 2): ?>
                                                        <?php echo $__env->make('frontend.pages.reading-test.partials.fill-in-blank', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php
                                                            $iteration++;
                                                        ?>
                                                    <?php endif; ?>
                                                    <?php if($question->category == 3): ?>
                                                        <?php echo $__env->make('frontend.pages.reading-test.partials.five-choice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php
                                                            $iteration++;
                                                        ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>


                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="card-body text-center">
                        <button style="border-radius:30px" type="submit" class="btn btn-outline-primary btn-lg">
                            <span class="indicator-label">Finish Test</span>

                        </button>

                    </div>

                </div>
            </form>
        </div>
        <!-- About Start -->
    </div>
    <button style="border-radius:30px; display: none;" type="button" id="test-start" data-bs-toggle="modal"
        data-bs-target="#test-type" class="btn btn-outline-primary btn-lg">
        <span class="indicator-label">Start Praticing</span>

    </button>
    <div class="modal fade" id="test-type" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="card h-100 shadow-lg">


                    <button type="reset" class="btn btn-primary me-3" data-bs-dismiss="modal"
                        data-dismiss="test-type">Enter in Test</button>
                </div>
            </div>
        </div>
        <!--end::Modal content-->
    </div>

    <!-- Testimonial End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var audio = document.getElementById('customAudio');
            var volumeControl = document.getElementById('volume');

            // Check if there is a stored playback time
           
         

            // Update volume based on the range input
            volumeControl.addEventListener('input', function() {
                audio.volume = volumeControl.value;
            });

            // Save the playback time to localStorage on pause
            audio.addEventListener('pause', function() {
               
                console.log('Playback time saved:', audio.currentTime);
            });

            // Clear the stored playback time on ended (audio completed)
            audio.addEventListener('ended', function() {
               
                console.log('Playback time cleared');
            });
     
            // Start playback on any click event on the page
            document.body.addEventListener('click', function() {
                audio.play().catch(function(error) {
                    // Handle error, e.g., user interaction not detected
                    console.error(error.message);
                });
            });
        });
    </script>
    <script>
        $('#test-type').on("hidden.bs.modal", function() {
            console.log('ddd')

        });

        $('#test-start').click()
        $('#highlightButton').on('click', function() {
            var selectedText = getSelectedText();
            if (selectedText !== "") {
                highlightSelectedText(selectedText);
            }
        });

        $('#removeHighlightButton').on('click', function() {
            var selectedText = getSelectedText();
            removeHighlight(selectedText);
        });

        $('#removeAllButton').on('click', function() {
            removeAll();
        });

        function getSelectedText() {
            var text = "";
            if (window.getSelection) {
                text = window.getSelection().toString();
            } else if (document.selection && document.selection.type !== "Control") {
                text = document.selection.createRange().text;
            }
            return text;
        }

        function highlightSelectedText(selectedText) {
            var range, sel;
            if (window.getSelection) {
                sel = window.getSelection();
                if (sel.rangeCount) {
                    range = sel.getRangeAt(0);
                    var span = $('<span class="highlight"></span>').get(0);
                    range.surroundContents(span);
                }
            } else if (document.selection && document.selection.createRange) {
                range = document.selection.createRange();
                var span = $('<span class="highlight"></span>').get(0);
                range.pasteHTML(span.outerHTML);
            }
        }

        function removeHighlight(selectedText) {
            $('.highlight').each(function() {
                if ($(this).text() === selectedText) {
                    $(this).replaceWith($(this).contents());
                }
            });
        }

        function removeAll() {
            $('.highlight').each(function() {
                $(this).replaceWith($(this).contents());
            });
        }
        $('#fontSizeSelect').on('change', function() {
            var selectedFontSize = $(this).val();
            $('#changeFontSize').children().each(function() {
                // Update font size for each child element
                $(this).css('font-size', selectedFontSize + 'px');

            });
            $('#changeFontSize .card-body *').each(function() {
                // Update font size for each child element
                $(this).css('font-size', selectedFontSize + 'px');
            });
        });
        function changeColorCodefill(value, ele, fivechoice) {
           
            if (value) {
                let className = '.' + ele;
                $(className).css("background-color", "#06BBCC");

            } else {
                let className = '.' + ele;
                $(className).css("background-color", "#c7cfcf");
            }


        }

        function changeColorCode(ele, fivechoice) {
            let className = '.' + ele;
            console.log(ele, fivechoice);
            $(className).css("background-color", "#06BBCC");
            if (fivechoice) {
                $(className).css("background-color", "#c7cfcf");
                var checkboxes = document.getElementsByName('fivechoice[' + fivechoice + '][]');
                var checkedCount = 0;
             
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        checkedCount++;
                        if (checkedCount > 2) {
                            alert('You can only select a maximum of two options.');
                            checkboxes[i].checked = false;
                            return;
                        }
                        if(checkedCount > 0){
                            $(className).css("background-color", "#06BBCC");
                        }
                    }
                }
            }
        }
        var listeningcountdownValue = 60 * 30;
 
        // Function to update the countdown display
        function updateCountdown() {
            const minutes = Math.floor(listeningcountdownValue / 60);
            const seconds = listeningcountdownValue % 60;
            document.getElementById('countdown').innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        // Function to be called every second
        function updateTimer() {
            listeningcountdownValue--;
            // Update the countdown display
            updateCountdown();

            // Check if the countdown has reached zero
            if (listeningcountdownValue === 0) {
                // Perform actions when the timer reaches zero
                $("#listeningTest").submit();
                // You can add more actions here

                // Reset the countdown for a new timer (here, it's set to 42 minutes)
                listeningcountdownValue = 60 * 60;
            }

            // Save the listeningcountdownValue to localStorage
            localStorage.setItem('listeningcountdownValue', listeningcountdownValue);

            // Call the function again after 1 second

            setTimeout(updateTimer, 1000);
        }


        // Retrieve the countdownValue from localStorage




        // Start the timer when the page loads
        updateTimer();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/frontend/pages/listening-test/index.blade.php ENDPATH**/ ?>