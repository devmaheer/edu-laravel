@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Question Group List</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary"> Question Group</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Question Group List</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
           
         
            <a href="{{ route('admin.question.group.create', ['id' => $test->id,'type'=>'reading']) }}"
                class="btn btn-dark fw-bolder ms-5" id="kt_toolbar_primary_button">Add Question Group</a>

            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Compact form-->
            <div class="row d-flex align-items-center">
            
                        
                
            </div>
            
            <!--end::Compact form-->
            <!--begin::Advance form-->
            {{-- class="collapse" --}}

            <!--end::Row-->

        </div>
        <!--end::Advance form-->
    </div>
    <!--end::Card body-->

    <!--end::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1" id="carCount">{{ count($questionGroup) }} Question Group(s) Found
        </div>
        <!--end::Title-->
    </div>
    <div class="card mb-6 mb-xl-9">
        <div class="card-body p-9">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="question_table" class="table table-row-dashed table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">

                            <th>Heading</th>
                            <th>Description</th>
                            <th>Position</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($questionGroup as $group)
                        <tr>
                            <td>{{ $group->heading }}</td>

                            <td>{{ $group->description }}</td>
                           
                            <td>{{ $group->position }}</td>
                            <td>
                               
                            
                       
                                <a href="{{ route('admin.question.group.delete', ['id'=>$group->id,'type'=>'reading']) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                fill="black" />
                                            <path opacity="0.5"
                                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                fill="black" />
                                            <path opacity="0.5"
                                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>

    <!--begin::Modal - New Target-->    

    <!--end::Modal - New Target-->
   

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
        $('#question_table').DataTable({

            // "responsivePriority": 1,
            // "dom": "<'table-responsive'tr>",
            searching: true,
            "order": [
                [2, "asc"]
            ],
            info: !1,
            columns: [{
                    "orderable": true,

                }, {
                    "orderable": true,

                }, {
                    "orderable": true,

                },
                {
                    "orderable": false,

                },
                {
                    "orderable": false,

                }
                

            ]
        });
        
        imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
        }
    </script>
@endsection
