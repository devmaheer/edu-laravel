@extends('layouts.frontend-app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="row g-4 justify-content-center">
            <form action="{{ route('reading.test.finish') }}" id="readingTest" method="post">
                <div class="container ">
                    <h1 class="mb-4">{{ $test->name }}</h1>
                    <p id="timer">Timer: <span id="countdown">2520</span> seconds</p>
                    @php
                        $iteration = 1;
                    @endphp
                    @foreach ($data as $group)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mt-5">
                                    <div class="card  shadow-lg">
                                        <div class="card-body">

                                            {!! $test->paragraph1 !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="card-body">

                                    <div class="container mb-5">
                                        @foreach ($group['questionGroups'] as $group)
                                            <div class="row mt-5">
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
        // Set the initial countdown value for 42 minutes
        let countdownValue = 42 * 60;

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

                // Reset the countdown for a new timer
                countdownValue = 42 * 60;
            } else {
                // Call the function again after 1 second
                setTimeout(updateTimer, 1000);
            }
        }

        // Start the timer when the page loads
        updateTimer();
    </script>
@endsection
