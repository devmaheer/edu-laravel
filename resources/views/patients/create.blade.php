@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Add New Patient</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Patient Details</h1>

            <form action="{{ route('bu.patients.store') }}" method="post">
                @csrf

                <div class="row g-9 mb-8">
                    <div class="col-md-4">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Branch</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid" name="branch_id">
                            <option value="">Select Branch</option>
                            @isset($branches)
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->full_name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="col-md-4">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">First Name</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter first name" name="first_name" />
                    </div>
                    <div class="col-md-4">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Last Name</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter last name" name="last_name" />
                    </div>
                </div>

                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">DOB</span>
                        </label>
                        <!--end::Label-->
                        <input id="patient_dob_datepicker" class="form-control form-control-solid" placeholder="Select date of birth" name="dob" />
                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Blood Group</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Blood group" name="blood_group" />
                    </div>
                </div>

                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Contact Number</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="+91" name="contact_no" />
                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter your email address" name="email" />
                    </div>
                </div>

                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Address</span>
                        </label>
                        <!--end::Label-->
                        <textarea class="form-control form-control-solid" rows="1" name="address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">State</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid" name="state">
                            <option value="">Select State</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Alabama">Alabama</option>
                            <option value="Alaska">Alaska</option>
                            <option value="Arizona">Arizona</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>
                
                <div class="row g-9 mb-8">
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Country</span>
                    </label>
                    <!--end::Label-->
                    <select class="form-control form-control-solid" name="country">
                        <option value="">Select Country</option>
                        <option value="India">India</option>
                        <option value="United States">United States</option>
                        <option value="Canada">Canada</option>
                        <option value="Mexico">Mexico</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">Pincode</span>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="Enter pincode" name="pin_code" />
                </div>
                </div>

                <div class="row g-9 mb-8">
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Patient Group</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid" name="patient_group">
                            <option value="">Select Group</option>
                            <option value="United States">EHS</option>
                            <option value="Canada">Clinic</option>
                            <option value="Mexico">Trust</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Reffered By</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-control form-control-solid" name="referral">
                            <option value="">Select Refferal</option>
                            <option value="United States">Direct Walk-in</option>
                            <option value="Canada">Other Dentist</option>
                            <option value="Mexico">Friend/Colleague</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <!--begin::Actions-->
                <div class="text-start">
                    <button type="reset" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
@endsection