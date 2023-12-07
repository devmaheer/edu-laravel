<div class="modal fade"  id="mcqs-modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header justify-content-end border-0 pb-0">
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-lg-5 my-7">
                <!--begin::Modal title-->
                <h2 class="fw-bolder text-center mb-15">Add MCQS Question</h2>
                <!--end::Modal title-->

                <!--begin::Form-->
                <form action="{{ route('admin.question.store') }}" method="post">
                    <!--begin::Scroll-->
                    <input type="hidden" name="testId" value="{{$test->id}}">
                    <input type="hidden" name="question_type" value="reading">
                    <div class="d-flex flex-column me-n7 pe-7">
                        <!--begin::Form Row-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">MCQS</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control" placeholder="Enter a MCqs" name="mcqs_name" id="mcqs" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Select Paragraph</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select  name="paragraph" class="form-control form-control-solid required" >
                                <option value="">Select </option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                @if($test->category == '2')
                                <option value="4">Four</option>
                                <option value="5">Five</option>
                                 @endif
                                <!-- Add more options as needed -->
                            </select>
                            <!--end::Input-->
                        </div>
                    
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Select Number Options</span>
                            </label>
                            <select name="option_number" onchange="addOptions(this)" class="form-control form-control-solid required" >
                                <option value="">Select Number Options</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                <option value="4">Four</option>
                                <option value="5">Five</option>

                                <!-- Add more options as needed -->
                            </select>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10" >
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Options</span>
                            </label>
                            <div class="attach-options">

                            </div>
                           
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Form Row-->

                        <!--begin::Repeater-->
                    
                        <!--end::Repeater-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" data-dismiss="treatment-category">Discard</button>
                        <button type="submit" class="btn btn-primary" data-create="treatment-category">
                            <span class="indicator-label">Save Question</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>