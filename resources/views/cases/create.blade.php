@extends('layouts.app')

@section('content')
    <!--begin::card-->
    <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column" id="create_case_stepper">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Nav-->
                    <div class="stepper-nav justify-content-center py-2">
                        <!--begin::Step 1-->
                        <div class="stepper-item me-5 me-md-15 current" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Chief Complaint</h3>
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Clinical Findings</h3>
                        </div>
                        <!--end::Step 2-->
                        <!--begin::Step 3-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Investigation</h3>
                        </div>
                        <!--end::Step 3-->
                        <!--begin::Step 4-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Treatment Plan</h3>
                        </div>
                        <!--end::Step 4-->
                        <!--begin::Step 5-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Attachments</h3>
                        </div>
                        <!--end::Step 5-->
                        <!--begin::Step 6-->
                        <div class="stepper-item me-5 me-md-15" data-kt-stepper-element="nav">
                            <h3 class="stepper-title">Notes</h3>
                        </div>
                        <!--end::Step 6-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Form-->
                    <form class="mx-auto w-100 mw-800px pt-15 pb-10" novalidate="novalidate" id="create_case_form" method="post" action="{{ route('bu.case.store') }}">
                        <!--begin::Chief Complaint-->
                        <div class="current" data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-7 pb-lg-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bolder text-dark">Chief Complaint</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Form Row-->
                                <div class="fv-row mb-15" data-kt-buttons="true">
                                    <div class="col-12">
                                        <!--begin::Label-->
                                        <label class="required form-label fs-6 mb-2">Patient</label>
                                        <!--end::Label-->
                                        
                                        <!--begin::HiddenInput-->
                                            <input type="hidden" name="branch_id" id="branch_id">
                                        <!--begin::HiddenInput-->

                                        <!--begin::Select2-->
                                        <select class="form-select" id="patient" name="patient_id" data-control="select2" data-placeholder="Select an option">
                                            <option></option>
                                            @isset($patients)
                                                @foreach ($patients as $patient)
                                                    <option value="{{ $patient->id }}" data-branch="{{ $patient->branch->id }}">{{ $patient->full_name }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <!--begin::Select2-->
                                    </div>
                                </div>
                                <!--end::Form Row-->

                                <!--begin::Form Row-->
                                <div class="fv-row mb-15" data-kt-buttons="true">
                                    <div class="col-12">
                                        <!--begin::Label-->
                                        <label class="required form-label fs-6 mb-2">Duty Doctor</label>
                                        <!--end::Label-->
                                        <!--begin::Select2-->
                                        <select class="form-select" id="duty-doctor" name="duty_doctor_id" data-control="select2" data-placeholder="Select an option">
                                        </select>
                                        <!--begin::Select2-->
                                    </div>
                                </div>
                                <!--end::Form Row-->

                                <!--begin::Repeater-->
                                <div id="chief-complaint-repeater">
                                    <div data-repeater-list="chief-complaint">
                                        <div data-repeater-item="chief-complaint">
                                            <!--begin::Form Row-->
                                            <div class="fv-row row mb-5">
                                                <div class="col-5">
                                                    <!--begin::Label-->
                                                    <label class="required form-label fs-6 mb-2 me-2">Complaint Type</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select data-index="0" class="form-select type_id_complaint" name="type_id_complaint[0]" data-control="select2" data-placeholder="Select an option">
                                                        <option></option>
                                                        @isset($complaintTypes)
                                                            @foreach ($complaintTypes as $type)
                                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
            
                                                <div class="col-4">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 mb-2">Tooth</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select tooth_id_complaint" name="tooth_id_complaint[0]" data-control="select2" data-placeholder="Select an option">
                                                        <option></option>
                                                        @isset($teeth)
                                                            @foreach ($teeth as $tooth)
                                                                <option value="{{ $tooth->id }}">{{ $tooth->position.'/'.$tooth->quadrant.$tooth->number }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>

                                                <div class="col-3">
                                                    <button type="button" class="btn btn-sm btn-secondary mt-3 mt-md-11" data-bs-toggle="modal" data-bs-target="#complaint-type-modal">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end::Form Row-->
                                        </div>
                                    </div>

                                    <!--begin::Form group-->
                                    <div class="form-group mb-5">
                                        <a href="javascript:;" data-repeater-create="chief-complaint" class="btn btn-sm btn-light-primary">
                                            <i class="fas fa-plus"></i>Add Complaint
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-element="complaint-next">
                                        <span class="indicator-label">Next</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Chief Complaint-->
                        <!--begin::Clinical Findings-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-7 pb-lg-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bolder text-dark">Clinical Findings</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                
                                <!--begin::Repeater-->
                                <div id="clinical-finding-repeater">
                                    <div data-repeater-list="clinical-finding">
                                        <div data-repeater-item="clinical-finding">
                                            <!--begin::Form Row-->
                                            <div class="fv-row row mb-5">
                                                <div class="col-5">
                                                    <!--begin::Label-->
                                                    <label class="required form-label fs-6 mb-2 me-2">Complaint Type</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select data-index="0" class="form-select type_id_finding" name="type_id_finding[0]" data-control="select2" data-placeholder="Select an option">
                                                        <option></option>
                                                        @isset($complaintTypes)
                                                            @foreach ($complaintTypes as $type)
                                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>
            
                                                <div class="col-4">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 mb-2">Tooth</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select tooth_id_finding" name="tooth_id_finding[0]" data-control="select2" data-placeholder="Select an option">
                                                        <option></option>
                                                        @isset($teeth)
                                                            @foreach ($teeth as $tooth)
                                                                <option value="{{ $tooth->id }}">{{ $tooth->position.'/'.$tooth->quadrant.$tooth->number }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <!--end::Select2-->
                                                </div>

                                                <div class="col-3">
                                                    <button type="button" class="btn btn-sm btn-secondary mt-3 mt-md-11" data-bs-toggle="modal" data-bs-target="#complaint-type-modal">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end::Form Row-->
                                        </div>
                                    </div>

                                    <!--begin::Form group-->
                                    <div class="form-group mb-5">
                                        <a href="javascript:;" data-repeater-create="clinical-finding" class="btn btn-sm btn-light-primary">
                                            <i class="fas fa-plus"></i>Add Finding
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="finding-previous">Previous</button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-element="finding-next">
                                        <span class="indicator-label">Next</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Clinical Findings-->
                        <!--begin::Investigation-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-10 pb-lg-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bolder text-dark">Investigation</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-15">
                                    <div class="col-12 mb-5">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">Blood Pressure</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Monitor current blood pressure" name="blood_pressure">
                                        <!--end::Input-->
                                    </div>

                                    <div class="col-12 mb-5">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">O<sub>2</sub></label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Oxygen stats" name="oxygen">
                                        <!--end::Input-->
                                    </div>

                                    <div class="col-12">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">Blood Sugar</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="Monitor current blood sugar" name="blood_sugar">
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="investigation-previous">Previous</button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-element="investigation-next">
                                        <span class="indicator-label">Next</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Investigation-->
                        <!--begin::Treatment Plan-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bolder text-dark">Treatment Plan</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Repeater-->
                                <div id="treatment-plan-repeater">
                                    <div data-repeater-list="treatment-plan">
                                        <div data-repeater-item="treatment-plan">
                                            <div class="fv-row row mb-5">
                                                <div class="col-3">
                                                    <!--begin::Label-->
                                                    <label class="required form-label fs-6 mb-2">Treatment Category</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select data-index="0" class="form-select treatment-category" name="treatmentcategory_id[0]" data-element="treatment-category-0" data-control="select2" data-placeholder="Select an option">
                                                        <option></option>
                                                        @isset($treatmentCategories)
                                                            @foreach ($treatmentCategories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                    <!--begin::Select2-->
                                                </div>

                                                <div class="col-3">
                                                    <!--begin::Label-->
                                                    <label class="required form-label fs-6 mb-2">Treatment Service</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select data-index="0" data-cost="" class="form-select treatment-service" name="treatmentservice_id[0]" data-element="treatment-service-0" data-control="select2" data-placeholder="Select an option">
                                                    </select>
                                                    <!--begin::Select2-->
                                                    <div class="text-muted fs-7">
                                                        <span class="unit-cost-0 unit-cost" data-index="0"></span>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <!--begin::Label-->
                                                    <label class="required form-label fs-6 mb-2">Quantity</label>
                                                    <!--end::Label-->
                                                    <input data-index="0" type="number" class="form-control quantity" min="1" name="quantity[0]" placeholder="Quantity" value="1"/>
                                                </div>

                                                <div class="col-2">
                                                    <!--begin::Label-->
                                                    <label class="form-label fs-6 mb-2">Discount</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input group-->
                                                    <div class="input-group">
                                                        <span class="input-group-text text-gray-500">₹</span>
                                                        <input data-index="0" type="number" class="form-control discount" name="discount[0]"/>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <div class="text-muted fs-7">
                                                        <span class="calculated-price-0 calculated-price" data-index="0"></span>
                                                    </div>
                                                </div>

                                                <div class="col-1">
                                                    <button type="button" class="btn btn-sm btn-secondary mt-3 mt-md-11" data-bs-toggle="modal" data-bs-target="#treatment-category-modal">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Form group-->
                                    <div class="form-group mb-5">
                                        <a href="javascript:;" data-repeater-create="treatment-plan" class="btn btn-sm btn-light-primary">
                                            <i class="fas fa-plus"></i>Add Treatment Plan
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="plan-previous">Previous</button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-element="plan-next">
                                        <span class="indicator-label">Next</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Treatment Plan-->
                        <!--begin::Attachments-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bolder text-dark">Attachments</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-5">
                                    <div class="col-12">
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_dropzonejs_example_1">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick">
                                                <!--begin::Icon-->
                                                {{-- <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i> --}}
                                                <!--end::Icon-->
    
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                    <span class="fs-7 fw-bold text-gray-400">Upload up to 10 files</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="attachment-previous">Previous</button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-element="attachment-next">
                                        <span class="indicator-label">Next</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Attachments-->
                        <!--begin::Notes-->
                        <div data-kt-stepper-element="content">
                            <!--begin::Wrapper-->
                            <div class="w-100">
                                <!--begin::Heading-->
                                <div class="pb-12">
                                    <!--begin::Title-->
                                    <h1 class="fw-bolder text-dark">Notes</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Repeater-->
                                <div class="case-notes-repeater">
                                    <div data-repeater-list="case-notes">
                                        <div data-repeater-item="case-notes">
                                            <!--begin::Input group-->
                                            <div class="fv-row row mb-5">
                                                <div class="col-11">
                                                    <!--begin:Textarea-->
                                                    <textarea data-index="0" class="form-control case-notes" name="case_notes[0]" id="" cols="30" rows="2"></textarea>
                                                    <!--end:Textarea-->
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>

                                    <!--begin::Form group-->
                                    <div class="form-group mb-5">
                                        <a href="javascript:;" data-repeater-create="case-notes" class="btn btn-sm btn-light-primary">
                                            <i class="fas fa-plus"></i>Add Notes
                                        </a>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->

                                <!--begin::Actions-->
                                <div class="d-flex flex-stack">
                                    <button type="button" class="btn btn-lg btn-light me-3" data-kt-element="notes-previous">Previous</button>
                                    <button type="submit" class="btn btn-lg btn-primary" data-kt-element="notes-next">
                                        <span class="indicator-label">Create Case</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notes-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--begin::Container-->
            </div>
            <!--end::Stepper-->
        </div>
    </div>
    <!--end::card-->

    <!--begin::Modals-->
        @include('global.modals.complainttype')
        @include('global.modals.treatmentcategory')
    <!--end::Modals-->
@endsection

@section('script')
    <script>
        "use strict";
        var notes = (function () {
            var e, f, o, r, token;
            return {
                init: function () {
                    (
                        ClassicEditor
                        .create(document.querySelector('textarea[name="case_notes[0]"]'))
                        .then(editor => {
                        })
                        .catch(error => {
                        })
                    ),
                    (o = createCase.getForm()),
                    (r = createCase.getStepperObj()),
                    (e = createCase.getStepper().querySelector('[data-kt-element="notes-next"]')),
                    (f = createCase.getStepper().querySelector('[data-kt-element="notes-previous"]')),
                    e.addEventListener("click", function (event) {
                        event.preventDefault(),
                        // Create the new input element
                        token = document.createElement('input');
                        token.type = 'hidden';
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        
                        // Append the new input element to the form
                        o.appendChild(token);

                        (e.disabled = !0),
                        (e.setAttribute("data-kt-indicator", "on"),
                        setTimeout(function () {
                            e.removeAttribute("data-kt-indicator"), (e.disabled = !1), o.submit();
                        }, 1e3))
                    }),
                    f.addEventListener("click", function () {
                        r.goPrevious();
                    });
                },
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.notes = module.exports = notes);

        var attachment = (function () {
            var e, f, t, o, r;
            return {
                init: function () {
                    (
                        ClassicEditor
                        .create(document.querySelector('#case_notes'))
                        .then(editor => {
                        })
                        .catch(error => {
                        })
                    ),
                    (o = createCase.getForm()),
                    (r = createCase.getStepperObj()),
                    (e = createCase.getStepper().querySelector('[data-kt-element="attachment-next"]')),
                    (f = createCase.getStepper().querySelector('[data-kt-element="attachment-previous"]')),
                    e.addEventListener("click", function (o) {
                        o.preventDefault(),
                            (e.disabled = !0),
                            (e.setAttribute("data-kt-indicator", "on"),
                            setTimeout(function () {
                                e.removeAttribute("data-kt-indicator"), (e.disabled = !1), r.goNext();
                            }, 1e3))
                    }),
                    f.addEventListener("click", function () {
                        r.goPrevious();
                    });
                },
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.attachment = module.exports = attachment);

        var treatmentPlan = (function () {
            var e, f, t, o, r, tcf, tcfv, cc, ss = [];
            return {
                init: function () {
                    (o = createCase.getForm()),
                    (tcf = createCase.getTreatmentCategoryForm()),
                    (r = createCase.getStepperObj()),
                    (e = createCase.getStepper().querySelector('[data-kt-element="plan-next"]')),
                    (f = createCase.getStepper().querySelector('[data-kt-element="plan-previous"]')),
                    (cc = document.querySelector('[data-create="treatment-category"]')),
                    (t = FormValidation.formValidation(o, {
                        fields: { 
                            'treatmentcategory_id[0]': { 
                                validators: { notEmpty: { message: "Category is required" } } 
                            },
                            'treatmentservice_id[0]': {
                                validators: { notEmpty: { message: "Service is required" } }
                            },
                            'quantity[0]': {
                                validators: { notEmpty: { message: "Quantity is required" } }
                            }
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    (
                        tcfv = FormValidation.formValidation(tcf, {
                            fields: {
                                'category_name': {
                                    validators: { notEmpty: { message: "Category name is required" } }
                                },
                                'treatmentservice_name[0]': {
                                    validators: { notEmpty: { message: "Service name is required" } }
                                },
                                'treatmentservice_cost[0]': {
                                    validators: { notEmpty: { message: "Cost is required" } }
                                }
                            },
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                        })
                    ),
                    cc.addEventListener('click', function (event) {
                        (cc.disabled = !0),
                        tcfv && tcfv.validate()
                            .then(function (validation) {
                                "Valid" == validation
                                    ? (cc.setAttribute('data-kt-indicator', 'on'),
                                    setTimeout(() => {
                                        let url = '/businessunit/treatment/categories/store' // Replace with your API endpoint URL   
                                        const data = {
                                            name: $('#category-name').val(),
                                            clinicalspecialization_id: Array.from(document.querySelectorAll('select.clinical-specialization')).map(input => $(input).find(':selected').val()),
                                            service_name: Array.from(document.querySelectorAll('.service-name')).map(input => input.value),
                                            service_cost: Array.from(document.querySelectorAll('.service-cost')).map(input => input.value)
                                        }
                                        
                                        fetch(url, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json', // Set the content type to JSON
                                            },
                                            body: JSON.stringify(data), // Convert the data to JSON format
                                        })
                                        .then(response => {
                                            return response.json(); // Parse the JSON response data
                                        })
                                        .then(data => {
                                            if (data.hasOwnProperty('errors') && !data.hasOwnProperty('categories')) {
                                                toastr.error(data.errors.name[0]);
                                            } else if (data.hasOwnProperty('exception') && !data.hasOwnProperty('categories')) {
                                                toastr.error(data.exception);
                                            } else {
                                                ss = [];
                                                document.querySelectorAll('select.treatment-category').forEach((element, index) => {
                                                    ss.push($(document.querySelectorAll('select.treatment-service')[index]).find(':selected').val());
                                                    // Add option dynamically to the select element
                                                    const option = new Option(data.category.name, data.category.id);
                                                    $(element).append(option).trigger('change');
                                                });
                            
                                                $('[data-dismiss="treatment-category"]').trigger('click');
                                                toastr.success('New category added.');
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error); // Handle any errors that occurred during the request
                                        });

                                        cc.removeAttribute('data-kt-indicator')
                                        cc.disabled = !1
                                    }, 1e3))
                                    : (cc.disabled = !1,
                                    toastr.error('Sorry, looks like there are some empty inputs, please try again.'))
                            })
                    }),
                    e.addEventListener('click', function (o) {
                        o.preventDefault(),
                            (e.disabled = !0),
                            t &&
                                t.validate().then(function (t) {
                                    o.preventDefault(),
                                    "Valid" == t
                                        ? (e.setAttribute("data-kt-indicator", "on"),
                                        setTimeout(function () {
                                            e.removeAttribute("data-kt-indicator"), (e.disabled = !1), r.goNext();
                                        }, 1e3))
                                        : ((e.disabled = !1),
                                        toastr.error('Sorry, looks like there are some empty inputs, please try again.'));
                                });
                    }),
                    f.addEventListener('click', function () {
                        r.goPrevious();
                    });
                },
                getTreatmentPlanFormValidation: function () {
                    return t;
                },
                getTreatmentCategoryFormValidation: function () {
                    return tcfv;
                },
                getSelectedServices: function () {
                    return ss;
                }
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.treatmentPlan = module.exports = treatmentPlan);

        var investigation = (function () {
            var e, f, t, o, r;
            return {
                init: function () {
                    (o = createCase.getForm()),
                    (r = createCase.getStepperObj()),
                    (e = createCase.getStepper().querySelector('[data-kt-element="investigation-next"]')),
                    (f = createCase.getStepper().querySelector('[data-kt-element="investigation-previous"]')),
                    (t = FormValidation.formValidation(o, {
                        fields: { 
                            blood_pressure: { 
                                validators: { notEmpty: { message: "Blood pressure is required" } } 
                            },
                            oxygen: {
                                validators: { notEmpty: { message: "Oxygen stats are required" } }
                            },
                            blood_sugar: { 
                                validators: { notEmpty: { message: "Blood sugar is required" } } 
                            },
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    e.addEventListener("click", function (o) {
                        o.preventDefault(),
                            (e.disabled = !0),
                            t &&
                                t.validate().then(function (t) {
                                    o.preventDefault(),
                                    "Valid" == t
                                        ? (e.setAttribute("data-kt-indicator", "on"),
                                        setTimeout(function () {
                                            e.removeAttribute("data-kt-indicator"), (e.disabled = !1), r.goNext();
                                        }, 1e3))
                                        : ((e.disabled = !1),
                                        toastr.error('Sorry, looks like there are some empty inputs, please try again.'));
                                });
                    }),
                    f.addEventListener("click", function () {
                        r.goPrevious();
                    });
                },
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.investigation = module.exports = investigation);

        var clinicalFinding = (function () {
            var e, f, t, o, r;
            return {
                init: function () {
                    (o = createCase.getForm()),
                    (r = createCase.getStepperObj()),
                    (e = createCase.getStepper().querySelector('[data-kt-element="finding-next"]')),
                    (f = createCase.getStepper().querySelector('[data-kt-element="finding-previous"]')),
                    (t = FormValidation.formValidation(o, {
                        fields: { 
                            'type_id_finding[0]': { 
                                validators: { notEmpty: { message: "Complaint type is required" } } 
                            }
                        },
                        plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    e.addEventListener("click", function (o) {
                        o.preventDefault(),
                            (e.disabled = !0),
                            t &&
                                t.validate().then(function (t) {
                                    o.preventDefault(),
                                    "Valid" == t
                                        ? (e.setAttribute("data-kt-indicator", "on"),
                                        setTimeout(function () {
                                            e.removeAttribute("data-kt-indicator"), (e.disabled = !1), r.goNext();
                                        }, 1e3))
                                        : ((e.disabled = !1),
                                        toastr.error('Sorry, looks like there are some empty inputs, please try again.'));
                                });
                    }),
                    f.addEventListener("click", function () {
                        r.goPrevious();
                    });
                },
                getClinicalFindingFormValidation: function () {
                    return t;
                }
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.clicinalFinding = module.exports = clicinalFinding);

        var chiefComplaint = (function () {
            var e, t, o, r, ctf, ctfv, cc, sc = [];
            return {
                init: function () {
                    (o = createCase.getForm()),
                    (ctf = createCase.getComplaintTypeForm()),
                    (r = createCase.getStepperObj()),
                    (e = createCase.getStepper().querySelector('[data-kt-element="complaint-next"]')),
                    (cc = document.querySelector('[data-create="complaint-type"]')),
                    (t = FormValidation.formValidation(o, {
                        fields: {
                            patient_id: { 
                                validators: { notEmpty: { message: "Patient is required" } } 
                            },
                            duty_doctor_id: {
                                validators: { notEmpty: { message: "Duty doctor is required" } }
                            },
                            'type_id_complaint[0]': {
                                validators: { notEmpty: { message: "Complaint type is required" } } 
                            }
                        },
                        plugins: { 
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                    })),
                    (
                        ctfv = FormValidation.formValidation(ctf, {
                            fields: {
                                'complainttype_name': {
                                    validators: { notEmpty: { message: "Complaint type is required" } }
                                }
                            },
                            plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) }
                        })
                    ),
                    cc.addEventListener('click', function (event) {
                        (cc.disabled = !0),
                        ctf && ctfv.validate()
                            .then(function (validation) {
                                "Valid" == validation
                                    ? (
                                        cc.setAttribute('data-kt-indicator', 'on'),
                                        setTimeout(() => {
                                            const url = '/businessunit/complaint/types/store';
                                            const data = {
                                                name: $('#complaint-type').val(),
                                                _token: '{{ csrf_token() }}'
                                            };
                                            
                                            fetch(url, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json', // Set the content type to JSON
                                                },
                                                body: JSON.stringify(data), // Convert the data to JSON format
                                            })
                                            .then(response => {
                                                return response.json(); // Parse the JSON response data
                                            })
                                            .then(data => {
                                                if (data.hasOwnProperty('errors') && !data.hasOwnProperty('categories')) {
                                                    toastr.error(data.errors.name[0]);
                                                } else if (data.hasOwnProperty('exception') && !data.hasOwnProperty('categories')) {
                                                    toastr.error(data.exception);
                                                } else {
                                                    document.querySelectorAll('select.type_id_complaint').forEach((element, index) => {
                                                        // Add option dynamically to the select element
                                                        const option = new Option(data.type.name, data.type.id);
                                                        $(element).append(option).trigger('change');
                                                    });

                                                    document.querySelectorAll('select.type_id_finding').forEach((element, index) => {
                                                        // Add option dynamically to the select element
                                                        const option = new Option(data.type.name, data.type.id);
                                                        $(element).append(option).trigger('change');
                                                    });
                                
                                                    $('[data-dismiss="complaint-type"]').trigger('click');
                                                    toastr.success('New complaint type added.');
                                                }
                                            })
                                            .catch(error => {
                                                console.error('Error:', error); // Handle any errors that occurred during the request
                                            });

                                            cc.removeAttribute('data-kt-indicator')
                                            cc.disabled = !1
                                        }, 1e3)
                                    )
                                    : (
                                        cc.disabled = !1,
                                        toastr.error('Sorry, looks like there are some empty inputs, please try again.')
                                    )
                            })
                    }),
                    e.addEventListener("click", function (o) {
                        o.preventDefault(),
                            (e.disabled = !0),
                            t &&
                                t.validate().then(function (t) {
                                    o.preventDefault(),
                                    "Valid" == t
                                        ? (e.setAttribute("data-kt-indicator", "on"),
                                        setTimeout(function () {
                                            e.removeAttribute("data-kt-indicator"), (e.disabled = !1), r.goNext();
                                        }, 1e3))
                                        : ((e.disabled = !1),
                                        toastr.error('Sorry, looks like there are some empty inputs, please try again.'));
                                });
                    });
                },
                getChiefComplaintFormValidation: function () {
                    return t;
                },
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.chiefComplaint = module.exports = chiefComplaint);

        var createCase = (function () {
            var e, t, o, tcf, ctf;
            return {
                init: function () {
                    (e = document.querySelector("#create_case_stepper")),
                    (o = document.querySelector("#create_case_form")),
                    (tcf = document.querySelector('#treatment-category-form')),
                    (ctf = document.querySelector('#complaint-type-form')),
                    (t = new KTStepper(e));
                },
                getStepperObj: function () {
                    return t;
                },
                getStepper: function () {
                    return e;
                },
                getForm: function () {
                    return o;
                },
                getTreatmentCategoryForm: function () {
                    return tcf;
                },
                getComplaintTypeForm: function () {
                    return ctf;
                }
            };
        })();
        "undefined" != typeof module && void 0 !== module.exports && (window.createCase = module.exports = createCase);
        
        KTUtil.onDOMContentLoaded(function () {
            createCase.init()
            chiefComplaint.init()
            clinicalFinding.init()
            investigation.init()
            treatmentPlan.init()
            attachment.init()
            notes.init()

            $(document).on('change', '#patient', function () {
                const branchId = $(this).find(':selected').data('branch');
                const url = `/businessunit/branch/data`;
                const data = {
                    _token: '{{ csrf_token() }}',
                    branch_id: branchId,
                    job_role: 'Duty Doctor',
                    module: 'case.complaint'
                };

                const requestOptions = {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(data)
                };

                fetch(url, requestOptions)
                    .then(response => response.json())
                    .then(data => {
                        $('#branch_id').val(branchId);

                        // Use the data returned
                        const selectElement = $('select[name="duty_doctor_id"');
                        selectElement.empty();
                        selectElement.append(new Option('', ''));

                        // Add options dynamically to the select element
                        data.dentists.forEach(dentist => {
                            const option = new Option(dentist.name, dentist.id);
                            selectElement.append(option);
                        });
                        
                        // Initialize Select2
                        selectElement.select2();
                    })
            });
            
            $(document).on('change', '.treatment-category', function () {
                let _this = $(this);
                $('.unit-cost-' + _this.data('index')).empty();
                $('.calculated-price-' + _this.data('index')).empty();
                const treatmentCategoryId = $(this).find(':selected').val();
                const url = `/treatment/categories/${treatmentCategoryId}/services`;
                fetch(url)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    // Use the data returned
                    const selectElement = $('select[name="treatmentservice_id['+ _this.data('index') +']"]');
                    selectElement.empty();
                    selectElement.append(new Option('', ''));
                    
                    // Add options dynamically to the select element
                    data.services.forEach(service => {
                        // const option = new Option(service.name, service.id);
                        selectElement.append('<option value="'+ service.id +'" data-cost="'+ service.cost +'">'+service.name+'</option>');
                    });
                    
                    // Initialize Select2
                    selectElement.select2();
                    if (treatmentPlan.getSelectedServices().length) {
                        selectElement.val(treatmentPlan.getSelectedServices()[_this.data('index')]).trigger('change');
                    }
                })
                .catch(error => {
                    // Handle any errors that occurred during the fetch
                    console.error('Error:', error);
                });
            });

            $(document).on('change', '.treatment-service', function () {
                if ($(this).find(':selected').val() !== '') {
                    const index = $(this).data('index');
                    const cost = $(this).find(':selected').data('cost');
                    let quantity = $('input[name="quantity['+ index +']"]').val();
                    let discount = $('input[name="discount['+ index +']"]').val();
                    let price = cost * quantity - (discount === '' ? 0 : parseInt(discount));
                    $('.unit-cost-' + index).empty();
                    $('.unit-cost-' + index).append('Cost: <sub>₹</sub>' + cost);
                    $('.calculated-price-' + index).empty();
                    $('.calculated-price-' + index).append('Price: <sub>₹</sub>' + price);
                }
            });

            $(document).on('change', '.quantity', function () {
                const index = $(this).data('index');
                if ($('select[name="treatmentservice_id['+ index +']"]').val()) {
                    const cost = $('select[name="treatmentservice_id['+ index +']"]').find(':selected').data('cost');
                    let quantity = $('input[name="quantity['+ index +']"]').val();
                    let discount = $('input[name="discount['+ index +']"]').val();
                    let price = cost * quantity - (discount === '' ? 0 : parseInt(discount));
                    $('.unit-cost-' + index).empty();
                    $('.unit-cost-' + index).append('Cost: <sub>₹</sub>' + cost);
                    $('.calculated-price-' + index).empty();
                    $('.calculated-price-' + index).append('Price: <sub>₹</sub>' + price);
                }
            });

            $(document).on('change', '.discount', function () {
                const index = $(this).data('index');
                if ($('select[name="treatmentservice_id['+ index +']"]').val()) {
                    const cost = $('select[name="treatmentservice_id['+ index +']"]').find(':selected').data('cost');
                    let quantity = $('input[name="quantity['+ index +']"]').val();
                    let discount = $('input[name="discount['+ index +']"]').val();
                    let price = cost * quantity - (discount === '' ? 0 : parseInt(discount));
                    $('.unit-cost-' + index).empty();
                    $('.unit-cost-' + index).append('Cost: <sub>₹</sub>' + cost);
                    $('.calculated-price-' + index).empty();
                    $('.calculated-price-' + index).append('Price: <sub>₹</sub>' + price);
                }
            });

            $(document).on('keyup', '.discount', function () {
                const index = $(this).data('index');
                if ($('select[name="treatmentservice_id['+ index +']"]').val()) {
                    const cost = $('select[name="treatmentservice_id['+ index +']"]').find(':selected').data('cost');
                    let quantity = $('input[name="quantity['+ index +']"]').val();
                    let discount = $('input[name="discount['+ index +']"]').val();
                    let price = cost * quantity - (discount === '' ? 0 : parseInt(discount));
                    $('.unit-cost-' + index).empty();
                    $('.unit-cost-' + index).append('Cost: <sub>₹</sub>' + cost);
                    $('.calculated-price-' + index).empty();
                    $('.calculated-price-' + index).append('Price: <sub>₹</sub>' + price);
                }
            });

            $('[data-repeater-create="chief-complaint"]').on('click', function () {
                $('[data-repeater-list="chief-complaint"]').append(
                    `
                    <div data-repeater-item="chief-complaint">
                        <!--begin::Input group-->
                        <div class="fv-row row mb-5">
                            <div class="col-5">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2 me-2">Complaint Type</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select data-index="`+($('select.type_id_complaint:last').data('index') + 1)+`" class="form-select type_id_complaint" name="type_id_complaint[`+($('select.type_id_complaint:last').data('index') + 1)+`]" data-control="select2" data-placeholder="Select an option">
                                </select>
                                <!--end::Select2-->
                            </div>

                            <div class="col-4">
                                <!--begin::Label-->
                                <label class="form-label fs-6 mb-2">Tooth</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select tooth_id_complaint" name="tooth_id_complaint[`+($('select.type_id_complaint:last').data('index') + 1)+`]" data-control="select2" data-placeholder="Select an option">
                                    <option></option>
                                    @isset($teeth)
                                        @foreach ($teeth as $tooth)
                                            <option value="{{ $tooth->id }}">{{ $tooth->position.'/'.$tooth->quadrant.$tooth->number }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <!--begin::Select2-->
                            </div>

                            <div class="col-3">
                                <button data-index="`+($('select.type_id_complaint:last').data('index') + 1)+`" type="button" data-repeater-delete="chief-complaint" class="btn btn-sm btn-light-danger mt-3 mt-md-11">
                                    <i class="fas fa-trash-can"></i>Delete
                                </button>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    `
                );
                
                const selectElement = $('select.type_id_complaint:last');
                selectElement.empty();
                selectElement.append(new Option('', ''));
                $('select[name="type_id_complaint['+ (selectElement.data('index') - 1) +']"] option').each(function(index, option) {
                    selectElement.append(new Option($(option).text(), $(option).val()));
                });

                selectElement.select2();
                $('select.tooth_id_complaint:last').select2();

                let fv = chiefComplaint.getChiefComplaintFormValidation();
                fv.addField(
                    'type_id_complaint['+ $('select.type_id_complaint:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Complaint type is required" } } 
                    }
                )
            });

            $('[data-repeater-create="clinical-finding"]').on('click', function () {
                $('[data-repeater-list="clinical-finding"]').append(
                    `
                    <div data-repeater-item="clinical-finding">
                        <!--begin::Input group-->
                        <div class="fv-row row mb-5">
                            <div class="col-5">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2 me-2">Complaint Type</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select data-index="`+($('select.type_id_finding:last').data('index') + 1)+`" class="form-select type_id_finding" name="type_id_finding[`+($('select.type_id_finding:last').data('index') + 1)+`]" data-control="select2" data-placeholder="Select an option">
                                </select>
                                <!--end::Select2-->
                            </div>

                            <div class="col-4">
                                <!--begin::Label-->
                                <label class="form-label fs-6 mb-2">Tooth</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select tooth_id_finding" name="tooth_id_finding[`+($('select.type_id_finding:last').data('index') + 1)+`]" data-control="select2" data-placeholder="Select an option">
                                    <option></option>
                                    @isset($teeth)
                                        @foreach ($teeth as $tooth)
                                            <option value="{{ $tooth->id }}">{{ $tooth->position.'/'.$tooth->quadrant.$tooth->number }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <!--begin::Select2-->
                            </div>

                            <div class="col-3">
                                <button data-index="`+($('select.type_id_finding:last').data('index') + 1)+`" type="button" data-repeater-delete="clinical-finding" class="btn btn-sm btn-light-danger mt-3 mt-md-11">
                                    <i class="fas fa-trash-can"></i>Delete
                                </button>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    `
                );

                const selectElement = $('select.type_id_finding:last');
                selectElement.empty();
                selectElement.append(new Option('', ''));
                $('select[name="type_id_finding['+ ($('select.type_id_finding:last').data('index') - 1) +']"] option').each(function(index, option) {
                    selectElement.append(new Option($(option).text(), $(option).val()));
                });

                $('.type_id_finding:last').select2();
                $('.tooth_id_finding:last').select2();

                let fv = clinicalFinding.getClinicalFindingFormValidation();
                fv.addField(
                    'type_id_finding['+ $('select.type_id_finding:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Complaint type is required" } } 
                    }
                )
            });

            $('[data-repeater-create="treatment-plan"]').on('click', function () {
                $('[data-repeater-list="treatment-plan"]').append(
                    `
                    <div data-repeater-item="treatment-plan">
                        <div class="fv-row row mb-5" data-kt-buttons="true">
                            <div class="col-3">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2">Treatment Category</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`" class="form-select treatment-category" name="treatmentcategory_id[`+ ($('select.treatment-category:last').data('index') + 1) +`]" data-element="treatment-category-`+ ($('select.treatment-category:last').data('index') + 1) +`" data-control="select2" data-placeholder="Select an option">
                                </select>
                                <!--begin::Select2-->
                            </div>

                            <div class="col-3">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2">Treatment Service</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`" data-cost="" class="form-select treatment-service" name="treatmentservice_id[`+ ($('select.treatment-category:last').data('index') + 1) +`]" data-element="treatment-service-`+ ($('select.treatment-category:last').data('index') + 1) +`" data-control="select2" data-placeholder="Select an option">
                                </select>
                                <!--begin::Select2-->
                                <div class="text-muted fs-7">
                                    <span class="unit-cost-`+ ($('select.treatment-category:last').data('index') + 1) +` unit-cost" data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`"></span>
                                </div>
                            </div>

                            <div class="col-3">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2">Quantity</label>
                                <!--end::Label-->
                                <input data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`" type="number" class="form-control quantity" name="quantity[`+ ($('select.treatment-category:last').data('index') + 1) +`]" placeholder="Quantity" value="1"/>
                            </div>

                            <div class="col-2">
                                <!--begin::Label-->
                                <label class="form-label fs-6 mb-2">Discount</label>
                                <!--end::Label-->
                                <!--begin::Input group-->
                                <div class="input-group">
                                    <span class="input-group-text text-gray-500">₹</span>
                                    <input data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`" type="number" class="form-control discount" name="discount[`+ ($('select.treatment-category:last').data('index') + 1) +`]"/>
                                </div>
                                <!--end::Input group-->
                                <div class="text-muted fs-7">
                                    <span class="calculated-price-`+ ($('select.treatment-category:last').data('index') + 1) +` calculated-price" data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`"></span>
                                </div>
                            </div>

                            <div class="col-1">
                                <button data-index="`+ ($('select.treatment-category:last').data('index') + 1) +`" type="button" data-repeater-delete="treatment-plan" class="btn btn-sm btn-light-danger mt-3 mt-md-11">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    `
                );

                const selectElement = $('select.treatment-category:last');
                selectElement.empty();
                selectElement.append(new Option('', ''));
                $('select[name="treatmentcategory_id['+ (selectElement.data('index') - 1) +']"] option').each(function(index, option) {
                    selectElement.append(new Option($(option).text(), $(option).val()));
                });

                selectElement.select2();
                $('select.treatment-service:last').select2();

                let fv = treatmentPlan.getTreatmentPlanFormValidation();
                fv.addField(
                    'treatmentcategory_id['+ $('select.treatment-category:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Category is required" } } 
                    }
                );
                fv.addField(
                    'treatmentservice_id['+ $('select.treatment-category:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Service is required" } } 
                    }
                );
                fv.addField(
                    'quantity['+ $('select.treatment-category:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Quantity is required" } } 
                    }
                );
            });

            $('[data-repeater-create="treatment-service"]').on('click', function () {
                $('[data-repeater-list="treatment-service"]').append(
                    `
                    <div data-repeater-item="treatment-service">
                        <div class="fv-row row mb-5">
                            <div class="col-4">
                                <!--begin::Label-->
                                <label class="form-label fs-6 mb-2">Clinical Specialization</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select data-index="`+ ($('select.clinical-specialization:last').data('index') + 1) +`" class="form-select clinical-specialization" name="clinicalspecialization_id[`+ ($('select.clinical-specialization:last').data('index') + 1) +`]" data-control="select2" data-placeholder="Select an option">
                                    <option></option>
                                    @isset($clinicalSpecializations)
                                        @foreach ($clinicalSpecializations as $specialization)
                                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <!--begin::Select2-->
                            </div>

                            <div class="col-4">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2">Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" data-index="`+ ($('select.clinical-specialization:last').data('index') + 1) +`" class="form-control service-name" name="treatmentservice_name[`+ ($('select.clinical-specialization:last').data('index') + 1) +`]" placeholder="Service Name" />
                                <!--begin::Input-->
                            </div>

                            <div class="col-3">
                                <!--begin::Label-->
                                <label class="required form-label fs-6 mb-2">Cost</label>
                                <!--end::Label-->
                                <!--begin::Input Group-->
                                <div class="input-group">
                                    <span class="input-group-text text-gray-500">₹</span>
                                    <input data-index="`+ ($('select.clinical-specialization:last').data('index') + 1) +`" type="number" class="form-control service-cost" placeholder="Enter cost" name="treatmentservice_cost[`+ ($('select.clinical-specialization:last').data('index') + 1) +`]">
                                </div>
                                <!--end::Input Group-->
                            </div>

                            <div class="col-1">
                                <button data-index="`+ ($('select.clinical-specialization:last').data('index') + 1) +`" type="button" data-repeater-delete="treatment-service" class="btn btn-sm btn-light-danger mt-3 mt-md-11">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    `
                );

                $('.clinical-specialization:last').select2();

                let fv = treatmentPlan.getTreatmentCategoryFormValidation();
                fv.addField(
                    'treatmentservice_name['+ $('select.clinical-specialization:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Service name is required" } } 
                    }
                );
                fv.addField(
                    'treatmentservice_cost['+ $('select.clinical-specialization:last').data('index') +']',
                    {
                        validators: { notEmpty: { message: "Cost is required" } } 
                    }
                );
            });

            $('[data-repeater-create="case-notes"]').on('click', function () {
                $('[data-repeater-list="case-notes"]').append(
                    `
                    <div data-repeater-item="case-notes">
                        <!--begin::Input group-->
                        <div class="fv-row row mb-5">
                            <div class="col-11">
                                <!--begin:Textarea-->
                                <textarea data-index="`+ ($('textarea.case-notes:last').data('index') + 1) +`" class="form-control case-notes" name="case_notes[`+ ($('textarea.case-notes:last').data('index') + 1) +`]" id="" cols="30" rows="2"></textarea>
                                <!--end:Textarea-->
                            </div>

                            <div class="col-1">
                                <button data-index="`+ ($('textarea.case-notes:last').data('index') + 1) +`" type="button" data-repeater-delete="case-notes" class="btn btn-sm btn-light-danger">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                        <!--end::Input group-->
                    </div>
                    `
                );

                ClassicEditor
                .create(document.querySelector('textarea[name="case_notes['+ $('textarea.case-notes:last').data('index') +']"]'))
                .then(editor => {
                })
                .catch(error => {
                })
            });

            $(document).on('click', '[data-repeater-delete="chief-complaint"]', function () {
                let fv = chiefComplaint.getChiefComplaintFormValidation();
                fv.removeField('type_id_complaint['+ $(this).data('index') +']')
                $(this).parent().parent().parent().remove();
            });

            $(document).on('click', '[data-repeater-delete="clinical-finding"]', function () {
                let fv = clinicalFinding.getClinicalFindingFormValidation();
                fv.removeField('type_id_finding['+ $(this).data('index') +']');
                $(this).parent().parent().parent().remove();
            });

            $(document).on('click', '[data-repeater-delete="treatment-plan"]', function () {
                let fv = treatmentPlan.getTreatmentPlanFormValidation();
                fv.removeField('treatmentcategory_id['+ $(this).data('index') +']');
                fv.removeField('treatmentservice_id['+ $(this).data('index') +']');
                fv.removeField('quantity['+ $(this).data('index') +']');
                $(this).parent().parent().parent().remove();
            });

            $(document).on('click', '[data-repeater-delete="treatment-service"]', function () {
                let fv = treatmentPlan.getTreatmentCategoryFormValidation();
                fv.removeField('treatmentservice_name['+ $(this).data('index') +']');
                fv.removeField('treatmentservice_cost['+ $(this).data('index') +']');
                $(this).parent().parent().parent().remove();
            });

            $(document).on('click', '[data-repeater-delete="case-notes"]', function () {
                $(this).parent().parent().parent().remove();
            });
        });
        </script>
@endsection