@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">
                    <svg width="24" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z"
                            fill="#7e8299" />
                    </svg>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Dashboard</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center py-2 py-md-1">
            <!--begin::Button-->
            <a href="{{ route('admin.test.create') }}" class="btn btn-sm btn-dark btn-icon-white fw-bolder me-1">
                Add New Test
            </a>
            <!--end::Button-->

            <!--begin::Button-->
            <a href="{{ route('admin.test.index') }}" class="btn btn-sm btn-dark btn-icon-white fw-bolder">
                All Test
            </a>
            <!--end::Button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar-->



    <div class="row mb-5 mb-lg-7">
        <div class="col-sm-12 col-md-12">
            <div class="row mb-5 mb-lg-7">
                <div class="col-sm-12 col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-around">
                                <span>Total Test</span>
                                <span>{{ count($test) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-around">
                                <span>Total Questions</span>
                                <span>{{ $questCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-around">
                                <span>Total Question G</span>
                                <span>{{ $questionGroupCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-around">
                                <span>Total Users</span>
                                <span>{{ $userCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="row mb-5 mb-lg-7">
        <div class="col-sm-12 col-md-12">
            <div class="card">

                <div class="card-body">
                    <!-- Appountment View - List -->
                    <div id="appointmentListView" class="table-responsive">


                        <table id="test_table" class="table table-rounded table-row-bordered gy-5">
                            <thead>
                                <tr class="fw-bolder fs-7 ">
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Type</th>

                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody class="text-gray-600 fw-bold">
                                @isset($test)
                                    @foreach ($test as $test)
                                        <tr>


                                            <td>
                                                {{ $test->name }}
                                            </td>
                                            <td>
                                                @if ($test->category == '1')
                                                    Acadamic
                                                @else
                                                    General Training
                                                @endif
                                            </td>


                                            <td>
                                                @if ($test->type == '1')
                                                    <span
                                                        class="badge badge-warning">{{ App\Helper\Helper::getTestType($test->type) }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-primary">{{ App\Helper\Helper::getTestType($test->type) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($test->status == '1')
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.question.index', [$test->id]) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->

                                                    <i class="fa-brands fa-readme"></i>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <a href="{{ route('admin.question.index', [$test->id, 'listening' => 'true']) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->

                                                    <i class="fa-solid fa-music"></i>
                                                    <!--end::Svg Icon-->
                                                </a>
                                                <a href="{{ route('admin.test.edit', [$test->id]) }}"
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
                                                <a href="#" onclick="deleteTest({{ $test->id }});"
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
                                @endisset
                            </tbody>
                        </table>
                    </div>

                    <!-- Appointment View - Calendar -->

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function deleteTest(id) {
            // Display a confirmation dialog
            var isConfirmed = window.confirm('Are you sure you want to delete this test?');

            // Check if the user clicked 'OK'
            if (isConfirmed) {
                // Assuming you are using Laravel's route() function to generate URLs
                var deleteUrl = "{{ route('admin.test.delete', ['id' => ':id']) }}";

                // Replace ':id' with the actual ID
                deleteUrl = deleteUrl.replace(':id', id);

                // Redirect to the delete route
                window.location.href = deleteUrl;
            }
        }

        $('#test_table').DataTable({

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
                    "orderable": true,

                },
                {
                    "orderable": false,

                }
            ]
        });
    </script>
@endsection
