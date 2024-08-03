@extends('layouts.frontend-app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
  
        <div class="row g-4 justify-content-center">

            <div class="container p-5">
                <div class="row">
                    <h1 class="mb-4">IELTS Academic Practice Test</h1>
                    <p class="mb-4">The IELTS Academic test assesses English language proficiency 
                        for higher education and professional purposes. 
                        It evaluates reading, writing, listening, and speaking skills. 
                        The test is recognized globally and used by universities and employers 
                        to determine a candidate's ability to use English in an academic environment. </p>
                    
                        @foreach ($tests as $test)
                        <div class="col-lg-3 col-md-3 mb-4">
                            <div class="card  shadow-lg">
                                <div class="card-body">
                                    <div class="text-center p-3">
                                        <h5 class="card-title" style="font-size:17px;">{{ $test->name }}</h5>

                                    </div>

                                </div>

                                <div class="card-body text-center">
                                    <button style="border-radius:30px;" type="button" data-bs-toggle="modal"
                                        data-bs-target="#test-category-{{ $test->id }}"
                                        class="btn btn-outline-primary btn-lg">
                                        <span class="indicator-label">Start Test</span>

                                    </button>

                                </div>
                            </div>
                        </div>
                        @include('layouts.partials.models.test-category')
                    @endforeach


                </div>
            </div>
        </div>
        <!-- About Start -->
    </div>
    <!-- Testimonial End -->
@endsection

@section('script')
@endsection
