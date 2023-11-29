@extends('layouts.frontend-app')
@section('css')
    <style>

    </style>
@endsection
@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <div class="card-body pt-9 pb-9">
                <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Correct Answer</h1>
                <div class="row">
                    @php
                        $itera = 1;
                    @endphp
                    @foreach ($data as $key => $group)
                        <div class="col-md-4">
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
                                        @if ($question->category == 3)
                                            <div style="border: 1px solid" class=" mt-5  ps-5 number-box question_{{ $question->id }}">

                                                {{ $itera }}

                                                @php
                                                    $itera++;
                                                @endphp
                                              {{App\Helper\Helper::correctAnswer( $question->id )}}  
                                            </div>
                                        @endif
                                        <div class="mt-5 ps-5 number-box question_{{ $question->id }}">

                                            {{ $itera }}
                                            {{App\Helper\Helper::correctAnswer( $question->id )}}
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
    </div>
    <!-- Service End -->
@endsection

@section('script')
@endsection
