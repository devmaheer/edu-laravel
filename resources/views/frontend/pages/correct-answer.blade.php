@extends('layouts.frontend-app')
@section('css')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Correct</th>
                                                <th>Your Answer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($group['questions'] as $question)
                                                @if ($question->category == 3)
                                                    <tr>
                                                        <td>{{ $itera }}</td>
                                                        <td>{!! App\Helper\Helper::correctAnswer($question->id) !!}</td>
                                                        <td>{!! App\Helper\Helper::userAnswer($userTest, $question->id) !!}</td>


                                                        @php
                                                            $itera++;
                                                        @endphp
                                                @endif



                                                <tr>
                                                    <td>{{ $itera }}</td>
                                                    <td>{!! App\Helper\Helper::correctAnswer($question->id) !!}</td>
                                                    <td>{!! App\Helper\Helper::userAnswer($userTest, $question->id) !!}</td>
                                                </tr>



                                                @php
                                                    $itera++;
                                                @endphp
                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
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
