@extends('layouts.frontend-app')
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

    .highlighted {
        background-color: yellow;
    }
</style>

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5" style="max-width: 1500px;">
        <nav class="navbar navbar-expand-lg bg-white  navbar-light shadow sticky-top p-0">


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-2">
                    {{-- @php
                    $iteration = 1;
                @endphp --}}
                    <div class="row">
                        <h1 class="mb-4">{{ $test->name }}</h1>
                        <p id="timer">Timer: <span id="countdown">2520</span> seconds</p>
                        <div style="max-width:200px;">
                            <select id="fontSizeSelect" class="form-control form-control-solid required">
                                <option value="">Change Font Size</option>
                                <option value="12">12</option>
                                <option value="14">14</option>
                                <option value="16">16</option>
                                <option value="18">18</option>
                                <option value="20">20</option>
                                <option value="24">24</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $itera = 1;
                        @endphp
                        @foreach ($data as $key => $group)
                            <div class="col-md-2">
                                <h6>
                                    @if ($key == 1)
                                        Paragraph One
                                    @endif
                                    @if ($key == 2)
                                        Paragraph Two
                                    @endif
                                    @if ($key == 3)
                                        Paragraph Three
                                    @endif
                                    @if ($key == 4)
                                        Paragraph Four
                                    @endif
                                    @if ($key == 5)
                                        Paragraph Five
                                    @endif
                                </h6>

                                <div>
                                    @foreach ($group['questionGroups'] as $group)
                                        @foreach ($group['questions'] as $question)
                                            <div class="number-box question_{{ $question->id }}">

                                                {{ $itera }}
                                                @php
                                                    $itera++;
                                                @endphp
                                            </div>
                                        @endforeach
                                    @endforeach





                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </nav>
        <div class="row g-4 justify-content-center" id="changeFontSize">
            <form action="{{ route('reading.test.finish') }}" id="readingTest" method="post">
                <div class="container" style="max-width: 1500px;" id="highlightableText">

                    @php
                        $iteration = 1;
                    @endphp
                    @foreach ($data as $key => $group)
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row mt-5">
                                    <div class="card  shadow-lg"
                                        style="max-height: 700px; overflow-y:auto;  border: 2px solid #BFBDBD;">
                                        <div class="card-body ">
                                            @if ($key == 1)
                                                {!! $test->paragraph1 !!}
                                            @endif
                                            @if ($key == 2)
                                                {!! $test->paragraph2 !!}
                                            @endif
                                            @if ($key == 3)
                                                {!! $test->paragraph3 !!}
                                            @endif
                                            @if ($key == 4)
                                                {!! $test->paragraph4 !!}
                                            @endif
                                            @if ($key == 5)
                                                {!! $test->paragraph5 !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 mt-5"
                                style="max-height: 700px; overflow-y:auto; border: 2px solid #BFBDBD;">

                                <div class="card-body">

                                    <div class="container mb-5">
                                        @foreach ($group['questionGroups'] as $group)
                                            <div class="row mt-5 p-4" style="border: 2px solid #BFBDBD;">
                                                <h5>{!! $group['questionGroup']->heading !!}</h5>
                                                <p>{!! $group['questionGroup']->description !!}</p>
                                                @foreach ($group['questions'] as $question)
                                                    {{-- @include('layouts.partials.models.question-image') --}}
                                                    @if ($question->category == 1)
                                                        @include('frontend.pages.reading-test.partials.mcqs')
                                                        @php
                                                            $iteration++;
                                                        @endphp
                                                    @endif
                                                    @if ($question->category == 2)
                                                        @include('frontend.pages.reading-test.partials.fill-in-blank')
                                                        @php
                                                            $iteration++;
                                                        @endphp
                                                    @endif
                                                @endforeach


                                            </div>
                                        @endforeach

                                    </div>
                                </div>


                            </div>
                        </div>
                    @endforeach

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
    <!-- Testimonial End -->
@endsection

@section('script')
    <script>
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

        function changeColorCode(ele) {
            let className = '.' + ele;
            $(className).css("background-color", "#06BBCC");
        }
        var countdownValue = 60 * 60;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '{{ route('getCountdownValue') }}',
            success: function(response) {
                if (response.countdownValue == null) {
                    countdownValue = 60 * 60;
                } else {
                    countdownValue = response.countdownValue;
                }
            }
        });
        // Function to update the countdown display
        function updateCountdown() {
            const minutes = Math.floor(countdownValue / 60);
            const seconds = countdownValue % 60;
            document.getElementById('countdown').innerText = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        // Function to be called every second
        function updateTimer() {
            countdownValue--;
            // Update the countdown display
            updateCountdown();

            // Check if the countdown has reached zero
            if (countdownValue === 0) {
                // Perform actions when the timer reaches zero
                alert('Time is up!');
                // You can add more actions here

                // Reset the countdown for a new timer (here, it's set to 42 minutes)
                countdownValue = 60 * 60;
            }

            // Save the countdownValue to localStorage
            localStorage.setItem('countdownValue', countdownValue);

            // Call the function again after 1 second

            setTimeout(updateTimer, 1000);
        }


        // Retrieve the countdownValue from localStorage




        // Start the timer when the page loads
        updateTimer();

        $(document).ready(function() {
            $('.image-container').each(function() {
                var $this = $(this);
                var $originalImage = $this.find('.original-image');
                var $previewContainer = $this.find('.preview-container');
                var $previewImage = $this.find('.preview-image');

                $originalImage.on('mouseenter', function() {
                    $previewImage.attr('src', $originalImage.attr('src'));
                    $previewContainer.show();
                });

                $originalImage.on('mouseleave', function() {
                    $previewContainer.hide();
                });
            });
        });
    </script>
@endsection
