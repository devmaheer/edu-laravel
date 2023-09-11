@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Create Appointment</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Appointment Booking</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->
    
    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <form action="{{ route('bu.appointments.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <!--begin::Input group-->
                        <div class="mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Branch</span>
                            </label>
                            <!--end::Label-->
                            <select name="branch_id" id="branch" class="form-control form-control-solid" data-control="select2">
                                <option value="">Select Branch</option>
                                @isset($branches)    
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{$branch->full_name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="col-md-4">
                        <!--begin::Input group-->
                        <div class="mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Case</span>
                            </label>
                            <!--end::Label-->
                            <select name="case_id" id="case" class="form-control form-control-solid" data-control="select2">
                                <option value="">Select Case</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <!--begin::Label-->
                        <label class="form-label">
                            <span class="required">Appointment Date</span>
                        </label>
                        <!--end::Label-->
                        <input name="date" class="form-control form-control-solid" placeholder="Pick date rage" id="appointment_date"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <!--begin::Input group-->
                        <div class="mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Chair</span>
                            </label>
                            <!--end::Label-->
                            <select name="chair_id" id="chair" class="form-control form-control-solid">
                                <option value="">Select Chair</option>
                                @isset($chairs)    
                                    @foreach ($chairs as $chair)
                                        <option value="{{ $chair->id }}">{{$chair->type}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-md-4">
                        <!--begin::Input group-->
                        <div class="mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Patient</span>
                            </label>
                            <!--end::Label-->
                            <select name="patient_id" id="patient" class="form-control form-control-solid">
                                <option value="">Select Patient</option>
                                @isset($patients)    
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}">{{$patient->full_name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <div class="col-md-4">
                        <!--begin::Input group-->
                        <div class="mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Dentist</span>
                            </label>
                            <!--end::Label-->
                            <select name="employee_id" id="dentist" class="form-control form-control-solid">
                                <option value="">Select Dentist</option>
                                @isset($dentists)    
                                    @foreach ($dentists as $dentist)
                                        <option value="{{ $dentist->id }}">{{$dentist->full_name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>

                    <!--begin::Actions-->
                    <div class="text-start">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            document.getElementById('branch').addEventListener('change', fetchChairsAndPatients)

            $("#appointment_date").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minDate: moment().startOf('day'),
                    timePicker: true,
                    timePicker24Hour: false,
                    timePickerIncrement: 5,
                    locale: {
                        format: 'YYYY-MM-DD HH:mm:ss',
                        cancelLabel: 'Clear'
                    }
                }
            );

            // Clear the input field when the "Clear" button is clicked
            $('#appointment_date').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

        function fetchChairsAndPatients(branchId) {
            $.ajax({
                url: '/businessunit/branch/data',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    branch_id: $('#branch').find('option:selected').val(),
                    module: 'appointment.create',
                },
                success: function(response) {
                    // Handle the response and update the page accordingly
                    // For example, update the chair and patient lists
                    updateChairList(response.chairs);
                    updatePatientList(response.patients);
                    updateDentistList(response.dentists);
                    updateCasesList(response.cases);
                },
                error: function() {
                    // Handle the error if necessary
                }
            });
        }

        function updateChairList(chairs) {
            // Update the chair list in the DOM
            // For example, populate a <select> element with options
            let chairInput = $('#chair');
            chairInput.empty();
            chairInput.append($('<option>').val('').text('Select Chair'));
            $.each(chairs, function(index, chair) {
                chairInput.append($('<option>').val(chair.id).text(chair.type));
            });
        }

        function updatePatientList(patients) {
            // Update the patient list in the DOM
            // For example, populate a <select> element with options
            let patientInput = $('#patient');
            patientInput.empty();
            patientInput.append($('<option>').val('').text('Select Patient'));
            $.each(patients, function(index, patient) {
                patientInput.append($('<option>').val(patient.id).text(patient.full_name));
            });
        }

        function updateDentistList(dentists) {
            // Update the dentist list in the DOM
            // For example, populate a <select> element with options
            let dentistInput = $('#dentist');
            dentistInput.empty();
            dentistInput.append($('<option>').val('').text('Select Dentist'));
            $.each(dentists, function(index, dentist) {
                dentistInput.append($('<option>').val(dentist.id).text(dentist.name));
            });
        }

        function updateCasesList(cases) {
            // Update the cases list in the DOM
            // For example, populate a <select> element with options
            let caseInput = $('#case');
            caseInput.empty();
            caseInput.append($('<option>').val('').text('Select Case'));
            $.each(cases, function(index, caseRecord) {
                caseInput.append($('<option>').val(caseRecord.id).text(caseRecord.uid+'/'+caseRecord.patient.full_name));
            });
        }
    </script>    
@endsection
