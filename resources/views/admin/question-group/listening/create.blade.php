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
                <li class="breadcrumb-item text-gray-500">Add New Question Group</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>

        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Question Group Details</h1>

            <form action="{{ route('admin.question.group.store') }}" method="post">
                @csrf
                <input type="hidden" name="testId" value="{{ $test->id }}">
                <input type="hidden" name="type" value="listening">
                <div class="row g-9 mb-8">

                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Group Heading</span>
                        </label>
                        <!--end::Label-->
                        <textarea name="name"  placeholder="Enter Heading" ></textarea>
                      
                    </div>


                    <div class="col-md-6">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Description </span>
                        </label>
                        <!--end::Label-->
                        <textarea  placeholder="Enter Description" name="description" ></textarea>
                    </div>
                    <div class="col-md-12">
                        <table id="question_table" class="table table-row-dashed table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">

                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Part</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($test->questions as $question)
                                    <tr>
                                        <td>{{ $question->name }}</td>

                                        <td>{{ $question->type == 1 ? 'Reading' : 'Listening' }}</td>
                                        <td>{{ $question->part }}</td>
                                        <td>
                                            @if ($question->category == 1)
                                                MCQS
                                            @elseif($question->category == 2)
                                                Filling Blanks
                                            @elseif($question->category == 3)
                                                5 Options
                                            @endif
                                        </td>


                                        <td>
                                            <input class="form-check-input" type="checkbox" value="{{ $question->id }}"
                                                name="questionChecked[]" id="kt_permissions_core" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
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
@section('script')
<script src="https://cdn.tiny.cloud/1/lwl2mq307v26mn2ysovc6dp0jaipaj8q019zzot9e60xlmh4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      toolbar: "undo redo | bold italic strikethrough | bullist numlist | styleselect | link unlink | insertfile | image | alignleft aligncenter alignright alignjustify | fullscreen | code",
      plugins: "advlist autolink link image lists code fullscreen charmap wordcount tinydrive ",
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
    });
  </script>
  
@endsection

