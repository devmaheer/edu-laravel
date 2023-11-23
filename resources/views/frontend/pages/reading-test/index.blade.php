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
</style>

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <nav class="navbar navbar-expand-lg bg-white  navbar-light shadow sticky-top p-0">


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-2">
                    {{-- @php
                    $iteration = 1;
                @endphp --}}
                    <div class="row">
                        <h1 class="mb-4">{{ $test->name }}</h1>
                        <p id="timer">Timer: <span id="countdown">2520</span> seconds</p>
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

                                                {{ $question->id }}
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
        <div class="row g-4 justify-content-center">
            <form action="{{ route('reading.test.finish') }}" id="readingTest" method="post">
                <div class="container" id="highlightableText">

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
                if(response.countdownValue == null){
                    countdownValue = 60 * 60;
                }else{
                countdownValue =   response.countdownValue;
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

        function updateTimerInSession() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                data: {countdownValue},
                url: '{{ route('startTimer') }}',
                success: function(response) {
                    console.log(response);
                }
            });
        }
        // Retrieve the countdownValue from localStorage
        setInterval(updateTimerInSession, 10000);



        // Start the timer when the page loads
        updateTimer();
    </script>
@endsection
