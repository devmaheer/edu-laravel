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
                                            <div style="border: 1px solid" class=" number-box question_{{ $question->id }}">

                                                <table class="table">
                                                    <header>
                                                        <th style="border: 1px solid black;">No</th>
                                                        <th style="border: 1px solid black;">Correct</th>
                                                        <th style="border: 1px solid black;">Your Answer</th>
                                                    </header>
                                                    <tbody>
                                                        <td style="border: 1px solid black;"> {{ $itera }}</td>
                                                        <td style="border: 1px solid black;">  {!!App\Helper\Helper::correctAnswer( $question->id )!!}</td>
                                                        <td style="border: 1px solid black;" >{!!App\Helper\Helper::userAnswer( $userTest,$question->id )!!}</td>
                                                    </tbody>
                                                  </table>

                                                @php
                                                    $itera++;
                                                @endphp
                                           
                                            </div>
                                        @endif
                                        <div  class=" number-box question_{{ $question->id }}">
                                              <table class="table">
                                                <header>
                                                    <th style="border: 1px solid black;">No</th>
                                                    <th style="border: 1px solid black;">Correct</th>
                                                    <th style="border: 1px solid black;">Your Answer</th>
                                                </header>
                                                <tbody>
                                                    <td style="border: 1px solid black;"> {{ $itera }}</td>
                                                    <td style="border: 1px solid black;">  {!!App\Helper\Helper::correctAnswer( $question->id )!!}</td>
                                                    <td style="border: 1px solid black;" >{!!App\Helper\Helper::userAnswer( $userTest,$question->id )!!}</td>
                                                </tbody>
                                              </table>
                                           
                                          
                                           
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
