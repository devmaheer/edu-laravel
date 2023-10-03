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
                <li class="breadcrumb-item text-gray-500">Edit Question</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Edit Question </h1>
            <div class="row">
                <h3> Test Name : {{ $question->test->name }} <br /><br />
                    Test Category : @if ($question->test->category == '1')
                        Acadamic
                    @else
                        General Training
                    @endif <br /></h3>
            </div><br />
            <form action="{{ route('admin.question.update') }}" method="post">
                @csrf
                <input type="hidden" name="question_type" value="listening">
                <input type="hidden" name="testId" value="{{ $question->test->id }}">
                <input type="hidden" name="questionId" value="{{ $question->id }}">
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column me-n7 pe-7">
                        <!--begin::Form Row-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">MCQS</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control" value="{{ $question->name }}" placeholder="Enter a MCqs"
                                name="mcqs_name" id="mcqs" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Select Question Group</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select  name="question_group" class="form-control form-control-solid required" >
                                <option value="">Select </option>
                                 @foreach( App\Helper\Helper::questionGroup(null,1) as $key => $group )
                                 <option value="{{$key}}" {{ $key == $question->question_group ? 'selected':''}}>{{$group}}</option>
                                 @endforeach
                                <!-- Add more options as needed -->
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Select Number Options</span>
                            </label>
                            <select onchange="addOptions(this)" class="form-control form-control-solid required">
                                <option value="">Select Number Options</option>
                                <option value="1" {{ count($question->options) == 1 ? 'selected' : '' }}>One</option>
                                <option value="2" {{ count($question->options) == 2 ? 'selected' : '' }}>Two</option>
                                <option value="3" {{ count($question->options) == 3 ? 'selected' : '' }}>Three</option>
                                <option value="4" {{ count($question->options) == 4 ? 'selected' : '' }}>Four</option>
                                <option value="5" {{ count($question->options) == 5 ? 'selected' : '' }}>Five</option>

                                <!-- Add more options as needed -->
                            </select>
                            <!--end::Label-->
                            <!--begin::Input-->

                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bolder form-label mb-2">
                                <span class="required">Options</span>
                            </label>
                            <div class="attach-options">
                                @foreach ($question->options as $option)
                                    <div class="row option-row">
                                        <div class="col-md-10">
                                            <input class="form-control mt-3 option" value="{{$option->name}}" placeholder="Enter a Option"
                                                name="options[name][]" id="options-" autocomplete="off" />
                                            <input type="hidden" id="trueValue" class="true-value"
                                                name='options[trueValue][]' value="{{$option->is_correct ? $option->name : ''}}" />
                                        </div>
                                        <div class="col-md-2 mt-5">
                                            <input type="radio" class="form-check-input" {{$option->is_correct ? 'checked' : ''}} onclick="addTruthValue(this)"
                                                name="true-value" value="1">
                                        </div>
                                    </div>
                                @endforeach
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
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                            data-dismiss="treatment-category">Discard</button>
                        <button type="submit" class="btn btn-primary" data-create="treatment-category">
                            <span class="indicator-label">Update Question</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->




                </div>


                <!--begin::Actions-->
             
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script>
        function addOptions(e) {
            const numOptions = parseInt($(e).val());

            // Clear the existing content in case this function is called again
            $('.attach-options').empty();

            for (let i = 1; i <= numOptions; i++) {
                let input = `
            <div class="row option-row">
                <div class="col-md-10">
                <input class="form-control mt-3 option" placeholder="Enter a Option" name="options[name][]" id="options-${i}" autocomplete="off" />
                <input type="hidden" id="trueValue" class="true-value" name='options[trueValue][]' value="" />
            </div>
            <div class="col-md-2 mt-5">
                <input type="radio"  class="form-check-input" onclick="addTruthValue(this)" name="true-value" value="1">
            </div>
            </div>`;
                $('.attach-options').append(input);
            }
        }

        function addTruthValue(e) {
            const hiddenInputs = $('.true-value');
            hiddenInputs.each(function() {
                $(this).val(null);
            });

            let input1 = $(e).closest('.option-row').find('.option').val();
            let input = $(e).closest('.option-row').find('#trueValue').val(input1);
            console.log(input);

        }
    </script>
@endsection
