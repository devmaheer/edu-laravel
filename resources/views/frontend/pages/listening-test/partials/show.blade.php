@extends('layouts.frontend-app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
  
        <div class="row g-4 justify-content-center">

            <div class="container p-5">
                <div class="row">
                    <h1 class="mb-4">Listening Tests Instruction</h1>

                    <a class="btn btn-outline-primary btn-lg"
                    href="{{ route('listening.test', ['id' =>  $test->id]) }}" style="border-radius:30px"> Start Test </a>


                </div>
            </div>
        </div>
        <!-- About Start -->
    </div>
    <!-- Testimonial End -->
@endsection

@section('script')
@endsection
