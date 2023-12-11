@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Request List</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Requests</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Request List</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        < <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1" id="carCount">{{ count($requests) }} Request(s) Found
        </div>
        <!--end::Title-->
    </div>
    <div class="card mb-6 mb-xl-9">
        <div class="card-body p-9">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="test_table" class="table table-row-dashed table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">

                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Type</th>
                            <th>Plan</th>
                            <th>Date</th>

                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @isset($requests)
                            @foreach ($requests as $request)
                                <tr>


                                    <td>
                                        {{ $request->name }}
                                    </td>
                                    <td>
                                        {{ $request->email }}
                                    </td>
                                    <td>
                                        {{ $request->phone }}
                                    </td>
                                    <td>
                                        {{ $request->country }}
                                    </td>
                                    <td>
                                        @if ($request->type == '1')
                                            IELTS Preparation Courses
                                        @elseif($request->type == '2')
                                            IELTS Preparation Material
                                        @endif
                                    </td>

                            <td>    {{ $request->plan }}</td>



                            <td>    {{ $request->created_at }}</td>



                                </tr>
                            @endforeach
                        @endisset
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
                    "orderable": true,

                },
                {
                    "orderable": true,

                },
                {
                    "orderable": true,

                },

            ]
        });
    </script>
@endsection
