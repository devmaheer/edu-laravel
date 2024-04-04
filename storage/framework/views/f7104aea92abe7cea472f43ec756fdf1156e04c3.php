
<?php $__env->startSection('css'); ?>
    <style>

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <div class="card-body pt-9 pb-9">
                <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Test Score</h1>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <p>Total Mcqs <?php echo e($finishtest->mcqs_score); ?>/<?php echo e($totalMcqs); ?></p>
                        <div class="" id="chart">

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p>Total Fill In Blanks <?php echo e($finishtest->fill_score); ?>/<?php echo e($totalFills); ?></p>
                        <div class="" id="chart1">

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p>Total Five Choice <?php echo e($finishtest->five_choice_score + $finishtest->five_choice_score); ?>/<?php echo e($totalFiveChoice + $totalFiveChoice); ?>

                        </p>
                        <div class="" id="chart2">

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <p>Total Correct Ans <?php echo e($finishtest->total_score); ?>/40</p>
                        <div class="" id="chart3">

                        </div>
                    </div>


                </div>
                <div class="row">
                    <center>
                       
                        <h4><?php echo e(App\Helper\Helper::calculateBand($test, $type, $finishtest)); ?>/9 Bands </h4>
                    </center>
                    <div class="progress" style="padding: 0">

                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: <?php echo e(floor(App\Helper\Helper::calculateBand($test, $type, $finishtest))); ?>0%"
                            aria-valuenow=" <?php echo e(App\Helper\Helper::calculateBand($test, $type, $finishtest)); ?>"
                            aria-valuemin="0" aria-valuemax="9"></div>
                    </div>

                </div>
                <?php if($type == 1): ?>
                    <div class="row">
                        <center>
                            <h4><a class="btn btn-primary" href="<?php echo e(route('test.correct.answer', $finishtest->id)); ?>">View
                                    Correct Answers</a>
                        </center>


                    </div>
                <?php else: ?>
                    <div class="row">
                        <center>
                            <h4><a class="btn btn-primary" href="<?php echo e(route('test.correct.listening.answer', $finishtest->id)); ?>">View
                                    Correct Answers</a>
                        </center>


                    </div>
                <?php endif; ?>


            </div>

        </div>
    </div>
    <!-- Service End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            series: [<?php echo e($mcqsPercentage); ?>],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '60%',
                    }
                },
            },
            labels: ['MCQS'],
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var options = {
            series: [<?php echo e($fillPercentage); ?>],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '60%',
                    }
                },
            },
            labels: ['Fill in Blanks'],
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();

        var options = {
            series: [<?php echo e($fiveChoicePercentage); ?>],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '60%',
                    }
                },
            },
            labels: ['Five Choice'],
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
        var options = {
            series: [<?php echo e($toalPercentage); ?>],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: '60%',
                    }
                },
            },
            labels: ['Total Correct Ques'],
        };

        var chart = new ApexCharts(document.querySelector("#chart3"), options);
        chart.render();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/frontend/pages/score.blade.php ENDPATH**/ ?>