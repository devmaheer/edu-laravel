@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Reading Question List</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Reading Question</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Question List</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
           

            <!--begin::Button-->
            <button type="button" id="add_mcqs" data-bs-toggle="modal" data-bs-target="#mcqs-modal"
                class="btn ms-5  btn-dark">
                <span class="indicator-label">Add MCQS</span>
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#filling-modal" class="btn ms-5 btn-dark">
                <span class="indicator-label">Add Filling Blanks</span>

            </button>


            <a href="{{ route('admin.test.paragraph.create', ['type' => 'reading', 'id' => $test->id]) }}"
                class="btn btn-dark fw-bolder ms-5" id="kt_toolbar_primary_button">Add Paragraph</a>

            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Compact form-->
            <div class="row d-flex align-items-center">
                <div class="col-md-2">
                    <h5 class="mr-5"> Test Name </h5> <span>{{ $test->name }}</span>              

                </div>
                
                <div class="col-md-2">
                        
                    <h5 class="mr-5">Paragraph One Q</h5> <span>{{ $paraCount1 }}</span>

                </div>
           
                <div class="col-md-2">
                    <h5 class="mr-5">Paragraph Two Q</h5> <span>{{ $paraCount2 }}</span>              

                </div>
                <div class="col-md-2">
                   
                    <h5 class="mr-5">Paragraph Three Q</h5> <span>{{ $paraCount3 }}</span>              

                </div>
                @if($test->category == '2')
                <div class="col-md-2">
                    <h5 class="mr-5">Paragraph Four Q</h5> <span>{{ $paraCount4 }}</span>              

                </div>
                <div class="col-md-2">
                    <h5 class="mr-5">Paragraph Five Q</h5> <span>{{ $paraCount5 }}</span>              

                </div>
              @endif               
                
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
            <h3 class="fw-bolder me-5 my-1" id="carCount">{{ count($questions) }} Question(s) Found
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

                            <th>Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Paragraph</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->name }}</td>

                            <td>{{ $question->type == 1 ? 'Reading' : 'Listening' }}</td>
                            <td>{{ $question->category == 1 ? 'MCQS' : 'Filling Blanks' }}</td>
                            <td>
                                @if ($question->paragraph == '1')
                                    One
                                @elseif($question->paragraph == '2')
                                    Two
                                @elseif($question->paragraph == '3')
                                    Three
                                @elseif($question->paragraph == '4')
                                    Four
                                @elseif($question->paragraph == '5')
                                    Five
                                @endif
                            </td>
                            <td>
                                @if($question->category == '2')
                                <a href="{{ route('admin.question.fillinblanks.edit', [$question->id]) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                fill="black" />
                                            <path
                                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @else
                                <a href="{{ route('admin.question.edit', [$question->id]) }}"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                fill="black" />
                                            <path
                                                d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                @endif
                                <a href="{{ route('admin.question.delete', [$question->id,'type'=>'reading']) }}"
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
    @include('admin.question.reading.partials.mcqs-modal')
    @include('admin.question.reading.partials.filling-blank-modal')

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
