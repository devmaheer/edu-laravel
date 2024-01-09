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
                <li class="breadcrumb-item text-gray-500">Add New Reading Passage</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Reading Passage Details </h1>
            <div class="row">
                <h3> Test Name : {{ $test->name }} <br /><br />
                    Test Category : @if ($test->category == '1') Acadamic @else General Training @endif <br /></h3>
            </div><br />
            <form action="{{ route('admin.test.paragraph.store') }}" method="post">
                @csrf
                <input type="hidden" name="type" value="reading">
                <input type="hidden" name="testId" value="{{$test->id}}">
                <div class="row g-9 mb-8">

                    <div class="col-md-12">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Passage One </span>
                        </label>
                        <!--end::Label-->
                        <textarea name="paragraph1">{{$test->paragraph1}}</textarea>
                    </div>

                    <div class="col-md-12">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Passage  Two </span>
                        </label>
                        <!--end::Label-->
                        <textarea name="paragraph2">{{$test->paragraph2}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Passage Three </span>
                        </label>
                        <!--end::Label-->
                        <textarea name="paragraph3">{{$test->paragraph3}}</textarea>
                    </div>
                    @if($test->category == '2')

                    <div class="col-md-12">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Passage Four </span>
                        </label>
                        <!--end::Label-->
                        <textarea name="paragraph4">{{$test->paragraph4}}</textarea>
                    </div>
                    <div class="col-md-12">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Passage Five </span>
                        </label>
                        <!--end::Label-->
                        <textarea name="paragraph5">{{$test->paragraph3}}</textarea>
                    </div>
                    @endif




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