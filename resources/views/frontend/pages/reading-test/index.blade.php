@extends('layouts.frontend-app')
@section('css')
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
@endsection
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
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ $test->name }}</h4>
                            <p id="timer">Timer: <span id="countdown">2520</span>sec</p>
                            <div style="max-width:200px;">
                                <select id="fontSizeSelect" class="form-control form-control-solid required">
                                    <option value="">Font Size</option>
                                    <option value="12">12</option>
                                    <option value="14">14</option>
                                    <option value="16">16</option>
                                    <option value="18">18</option>
                                    <option value="20">20</option>
                                    <option value="24">24</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="max-width:200px;" class="mr-2">
                                <button class="btn btn-primary" id="highlightButton">Highlight Text</button>
                                <button class="btn btn-primary" id="removeHighlightButton">Remove Highlight </button>

                            </div>
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
                <div class="container " style="max-width: 1500px;">

                    @php
                        $iteration = 1;
                    @endphp
                    @foreach ($data as $key => $group)
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row mt-5">
                                    <div class="card  shadow-lg"
                                        style="max-height: 700px; overflow-y:auto;  border: 2px solid #BFBDBD;">
                                        <div class="card-body highlightme ">
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
                                                {!! $group['questionGroup']->heading !!}
                                                {!! $group['questionGroup']->description !!}
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
        document.getElementById('highlightButton').addEventListener('click', function() {
            var selectedText = getSelectedText();
            if (selectedText !== "") {
                highlightSelectedText(selectedText);
            }
        });

        document.getElementById('removeHighlightButton').addEventListener('click', function() {
            removeHighlight();
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
                    var span = document.createElement('span');
                    span.className = 'highlight';
                    range.surroundContents(span);
                }
            } else if (document.selection && document.selection.createRange) {
                range = document.selection.createRange();
                var span = document.createElement('span');
                span.className = 'highlight';
                range.pasteHTML(span.outerHTML);
            }
        }

        function removeHighlight() {
            var highlightedElements = document.querySelectorAll('.highlight');
            highlightedElements.forEach(function(element) {
                var parent = element.parentNode;
                parent.replaceChild(document.createTextNode(element.textContent), element);
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
    </script>
@endsection
