<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofP+NM6P1d5Eegx6A7Yq4MK5S+76E4uBxj" crossorigin="anonymous">
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TZ0H8BREG0"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-TZ0H8BREG0');
            </script>

    <?php echo $__env->make('layouts.partials.frontend-head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .card {
            border: none;
            padding: 10px 50px;
        }

        .card::after {
            position: absolute;
            z-index: -1;
            opacity: 0;
            -webkit-transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .card:hover {


            transform: scale(1.02, 1.02);
            -webkit-transform: scale(1.02, 1.02);
            backface-visibility: hidden;
            will-change: transform;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .75) !important;
        }

        .card:hover::after {
            opacity: 1;
        }

        label.box {
            display: flex;
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #ddd
        }


        input[type="radio"]:checked~label .circle {
            border: 6px solid #06BBCC;
            background-color: #fff
        }
        input[type="checkbox"]:checked~label .circle {
            border: 6px solid #06BBCC;
            background-color: #fff
        }


        label.box:hover {
            background: #baebf0
        }

        label.box .course {
            display: flex;
            align-items: center;
            width: 100%
        }

        label.box .circle {
            height: 22px;
            width: 22px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #ddd;

            display: inline-block}input[type="radio"] {
                display: none
            }
            input[type="checkbox"] {
                display: none
            }


            .btn.btn-primary {
                border-radius: 25px;
                margin-top: 20px
            }

            @media(max-width: 450px) {
                .subject {
                    font-size: 12px
                }
            }
    </style>

</head>
<?php echo $__env->yieldContent('css'); ?>

<body>
    <!--begin::Root-->
    <!-- Spinner Start -->
    
    <!-- Spinner End -->

    <?php if(!Request::routeIs('test.score') && !Request::routeIs('test.correct.answer') && !Request::routeIs('reading.test.finish') && !Request::routeIs('test.correct.listening.answer') &&!Request::routeIs('reading.test') && !Request::routeIs('listening.test')  && !Request::routeIs('show.listening.test') && !Request::routeIs('show.reading.test')): ?>
        <!-- Navbar Start -->
        <?php echo $__env->make('layouts.partials.frontend-navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Navbar End -->
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <!--end::Root-->
    <?php if(!Request::routeIs('test.score') && !Request::routeIs('test.correct.answer') && !Request::routeIs('reading.test.finish') && !Request::routeIs('test.correct.listening.answer') &&!Request::routeIs('reading.test') && !Request::routeIs('listening.test')  && !Request::routeIs('show.listening.test') && !Request::routeIs('show.reading.test')): ?>
    <?php echo $__env->make('layouts.partials.frontend-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php endif; ?>
    <?php echo $__env->make('layouts.partials.models.test-types', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.partials.frontend-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('script'); ?>
   
    <script>
        var queryParams = new URLSearchParams(window.location.search);
        const param = queryParams.get('success');

        if (param) {
            Swal.fire({
                title: "Success!",
                text: "We will contact you soon",
                icon: "success"
            });

            let url = window.location.href;
            let baseUrl = url.split('?')[0];
            window.history.replaceState(null, null, baseUrl);
        }


    </script>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "IELTS Prep And Practice - IPP",
          "url": "https://ieltsprepandpractice.com/",
          "logo": "https://ieltsprepandpractice.com/frontend/logo/logo.png",
          "sameAs": [
            "https://www.facebook.com/profile.php?id=61552949018684",
            "https://www.instagram.com/ielts_with_ipp/",
            "https://www.linkedin.com/company/ielts-with-ipp/",
            "https://www.pinterest.com/ieltsprepandpractice/"
          ]
        }
     </script>
</body>

</html>
<?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/layouts/frontend-app.blade.php ENDPATH**/ ?>