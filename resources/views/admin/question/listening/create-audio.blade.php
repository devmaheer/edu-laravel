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
                <li class="breadcrumb-item text-gray-500">Add New Listening Audio</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-9">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">Listening Audio Details </h1>
            <div class="row">
                <h3> Test Name : {{ $test->name }} <br /><br />
                    Test Category : @if ($test->category == '1') Acadamic @else General Training @endif <br /></h3>
            </div><br />
            <form action="{{ route('admin.test.audio.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="type" value="listening">
                <input type="hidden" name="testId" value="{{$test->id}}">
                <div class="row g-9 mb-8">

                    <div class="col-md-12">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Audio </span>
                        </label>
                       
                        <input type="file" id="upload"  name="audio" />
                        <audio id="audio" controls>
                            {{-- <source src="audio651db3e5b3706.mp3" id="src" /> --}}
                          <source  id="src" src="{{$test->audio}}" />
                        </audio>
                   
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

 function handleFiles(event) {
    var files = event.target.files;
    $("#src").attr("src", URL.createObjectURL(files[0]));
    document.getElementById("audio").load();
}

document.getElementById("upload").addEventListener("change", handleFiles, false);
   </script>
  
@endsection