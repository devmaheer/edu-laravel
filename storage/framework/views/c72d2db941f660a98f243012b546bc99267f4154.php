<div class="modal fade" id="filling-modal" tabindex="-1" aria-hidden="true">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                transform="rotate(45 7.41422 6)" fill="black" />
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
                <h2 class="fw-bolder text-center mb-15">Add Filling Blank Question</h2>
                <!--end::Modal title-->

                <!--begin::Form-->
                <form action="<?php echo e(route('admin.question.store')); ?>"  enctype="multipart/form-data" method="post">
                    <!--begin::Scroll-->
                    <input type="hidden" name="testId" value="<?php echo e($test->id); ?>">
                    <input type="hidden" name="question_type" value="listening">
                    <input type="hidden" name="filling_blanks" value="1">
                    <div class="d-flex flex-column me-n7 pe-7">
                        <!--begin::Form Row-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span >Select Image</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input accept="image/*" type='file' name="image" id="imgInp" />
                            <img id="blah" src="#" height="100" width="150" alt="your image" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Select Question Part</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select  name="part" class="form-control form-control-solid required" >
                                <option value="">Select </option>
                                 
                                 <option value="1">One</option>
                                 <option value="2">Two</option>
                                 <option value="3">Three</option>
                                 <option value="4">Four</option>
                               
                                <!-- Add more options as needed -->
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                First Sentence
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter " name="fill_1" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                Answer
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter option one " name="ans_first_1" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <div class="">
                                <input class="form-control" placeholder="Enter option Two" name="ans_first_2" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <div class="">
                                <input class="form-control" placeholder="Enter option Three" name="ans_first_3" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                Second Sentence
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter " name="fill_2" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                              Answer
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter option one " name="ans_sec_1" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <div class="">
                                <input class="form-control" placeholder="Enter option Two " name="ans_sec_2" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <div class="">
                                <input class="form-control" placeholder="Enter option Three " name="ans_sec_3" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                Third Sentence
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter " name="fill_3" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                Answer
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter option One" name="ans_third_1" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <div class="">
                                <input class="form-control" placeholder="Enter option Two" name="ans_third_2" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <div class="">
                                <input class="form-control" placeholder="Enter option Three" name="ans_third_3" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                Fourth Sentence
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="">
                                <input class="form-control" placeholder="Enter " name="fill_4" id="mcqs"
                                    autocomplete="off" />
                            </div>
                            <!--end::Input-->
                        </div>

                        <!--end::Form Row-->

                        <!--begin::Repeater-->

                        <!--end::Repeater-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                            data-dismiss="treatment-category">Discard</button>
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
<?php /**PATH D:\System\laragon\www\edu-laravel\resources\views/admin/question/listening/partials/filling-blank-modal.blade.php ENDPATH**/ ?>