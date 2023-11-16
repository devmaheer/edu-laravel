@extends('layouts.frontend-app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-9">
                    <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Get Access</h1>

                    <form action="{{ route('registeration-request.store') }}" method="post">
                        @csrf

                        <div class="row g-9 mb-8">

                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Name</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control form-control-solid required"
                                    placeholder="Enter name" name="name" />
                            </div>


                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Country</span>
                                </label>
                                <!--end::Label-->
                                <select class="form-control form-control-solid required" name="country">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                        </div>





                        <div class="row g-9 mb-8">
                     


                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Email</span>
                                </label>
                                <!--end::Label-->
                                <input type="email" class="form-control form-control-solid required"
                                    placeholder="Enter Email" name="email" />
                            </div>
                            
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Phone no</span>
                                </label>
                                <!--end::Label-->
                                <input type="phone" class="form-control form-control-solid required"
                                    placeholder="Enter Number" name="phone" />
                            </div>

                        </div>
                  


                        <!--begin::Actions-->
                        <div class="text-start mt-5">
                            <button type="reset" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                {{-- <span class="indicator-progress">Please wait... --}}
                                {{-- <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span> --}}
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Service End -->
@endsection

@section('script')
@endsection
