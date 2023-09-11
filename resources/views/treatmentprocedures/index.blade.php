@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">
                    <svg width="24" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="#7e8299"/>
                    </svg>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Treatment Procedures</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">All Procedures</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <div class="card mb-6 mb-xl-9">
        <div class="card-body">
            <h1 class="text-dark fw-bolder mt-1 mb-10 fs-3">All Procedures</h1>

            <div class="table-responsive">
                <div class="d-flex flex-stack mb-5">
                    <div class="d-flex align-items-center .position-relative my-1">
                        <input type="text" data-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Services">
                    </div>

                    <div class="d-flex justify-content-end align-items-center d-none" data-table-toolbar="selected">
                        <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
                        </div>
                
                        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Coming Soon">
                            Selection Action
                        </button>
                    </div>
                </div>

                <table id="all_procedures_table" class="table table-rounded table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-bolder fs-7 ">
                            <th>
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_example_1 .form-check-input" value="0"/>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-600 fw-bold">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        "use strict";

        // Class definition
        var KTDatatablesServerSide = function () {
            // Shared variables
            var table;
            var dt;
            var filterPayment;

            // Private functions
            var initDatatable = function () {
                dt = $("#all_procedures_table").DataTable({
                    searchDelay: 500,
                    scrollY: '525px',
                    scrollCollapse: false,
                    processing: false,
                    serverSide: true,
                    stateSave: true,
                    select: {
                        style: 'os',
                        selector: 'td:first-child',
                        className: 'row-selected'
                    },
                    ajax: {
                        url: "{{ route('bu.treatment.service.procedure.fetch') }}",
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'description' },
                        { data: null },
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            orderable: false,
                            render: function (data) {
                                return `
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="${data}" />
                                    </div>`;
                            }
                        },
                        {
                            targets: -1,
                            data: null,
                            orderable: false,
                            render: function (data, type, row) {
                                return `
                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-table-filter="delete_row" data-patient-id="${data.id}">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                `;
                            },
                        },
                    ],
                    // Add data-filter attribute
                    createdRow: function (row, data, dataIndex) {
                        $(row).find('td:last-child').addClass('d-flex justify-content-start');
                    }
                });

                table = dt.$;

                // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
                dt.on('draw', function () {
                    // initToggleToolbar();
                    // toggleToolbars();
                    handleDeleteRows();
                    KTMenu.createInstances();
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = function () {
                const filterSearch = document.querySelector('[data-table-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    dt.search(e.target.value).draw();
                });
            }

            // Delete customer
            var handleDeleteRows = () => {
                // Select all delete buttons
                const deleteButtons = document.querySelectorAll('[data-table-filter="delete_row"]');

                deleteButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = e.target.closest('tr');

                        // Get customer name
                        const customerName = parent.querySelectorAll('td')[2].innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Are you sure you want to delete " + customerName + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                // Simulate delete request
                                fetch(`businessunit/patients/delete/${1}`, {
                                    method: 'GET',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }

                                    return response.json();
                                })
                                .then(data => {
                                    alert(data.deleted);
                                })
                                .catch(error => {
                                    console.error('There was a problem with the fetch operation:', error);
                                });

                                Swal.fire({
                                    text: "Deleting " + customerName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "You have deleted " + customerName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // delete row data from server and re-draw datatable
                                        dt.draw();
                                    });
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: customerName + " was not deleted.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
            }

            // Reset Filter
            // var handleResetForm = () => {
            //     // Select reset button
            //     const resetButton = document.querySelector('[data-table-filter="reset"]');

            //     // Reset datatable
            //     resetButton.addEventListener('click', function () {
            //         // Reset payment type
            //         filterPayment[0].checked = true;

            //         // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            //         dt.search('').draw();
            //     });
            // }

            // Init toggle toolbar
            // var initToggleToolbar = function () {
            //     // Toggle selected action toolbar
            //     // Select all checkboxes
            //     const container = document.querySelector('#all_procedures_table');
            //     const checkboxes = container.querySelectorAll('[type="checkbox"]');

            //     // Select elements
            //     const deleteSelected = document.querySelector('[data-table-select="delete_selected"]');

            //     // Toggle delete selected toolbar
            //     checkboxes.forEach(c => {
            //         // Checkbox on click event
            //         c.addEventListener('click', function () {
            //             setTimeout(function () {
            //                 toggleToolbars();
            //             }, 50);
            //         });
            //     });

            //     // Deleted selected rows
            //     deleteSelected.addEventListener('click', function () {
            //         // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            //         Swal.fire({
            //             text: "Are you sure you want to delete selected customers?",
            //             icon: "warning",
            //             showCancelButton: true,
            //             buttonsStyling: false,
            //             showLoaderOnConfirm: true,
            //             confirmButtonText: "Yes, delete!",
            //             cancelButtonText: "No, cancel",
            //             customClass: {
            //                 confirmButton: "btn fw-bold btn-danger",
            //                 cancelButton: "btn fw-bold btn-active-light-primary"
            //             },
            //         }).then(function (result) {
            //             if (result.value) {
            //                 // Simulate delete request -- for demo purpose only
            //                 Swal.fire({
            //                     text: "Deleting selected customers",
            //                     icon: "info",
            //                     buttonsStyling: false,
            //                     showConfirmButton: false,
            //                     timer: 2000
            //                 }).then(function () {
            //                     Swal.fire({
            //                         text: "You have deleted all selected customers!.",
            //                         icon: "success",
            //                         buttonsStyling: false,
            //                         confirmButtonText: "Ok, got it!",
            //                         customClass: {
            //                             confirmButton: "btn fw-bold btn-primary",
            //                         }
            //                     }).then(function () {
            //                         // delete row data from server and re-draw datatable
            //                         dt.draw();
            //                     });

            //                     // Remove header checked box
            //                     const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
            //                     headerCheckbox.checked = false;
            //                 });
            //             } else if (result.dismiss === 'cancel') {
            //                 Swal.fire({
            //                     text: "Selected customers was not deleted.",
            //                     icon: "error",
            //                     buttonsStyling: false,
            //                     confirmButtonText: "Ok, got it!",
            //                     customClass: {
            //                         confirmButton: "btn fw-bold btn-primary",
            //                     }
            //                 });
            //             }
            //         });
            //     });
            // }

            // Toggle toolbars
            // var toggleToolbars = function () {
            //     // Define variables
            //     const container = document.querySelector('#kt_datatable_example_1');
            //     const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
            //     const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
            //     const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

            //     // Select refreshed checkbox DOM elements
            //     const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

            //     // Detect checkboxes state & count
            //     let checkedState = false;
            //     let count = 0;

            //     // Count checked boxes
            //     allCheckboxes.forEach(c => {
            //         if (c.checked) {
            //             checkedState = true;
            //             count++;
            //         }
            //     });

            //     // Toggle toolbars
            //     if (checkedState) {
            //         selectedCount.innerHTML = count;
            //         toolbarBase.classList.add('d-none');
            //         toolbarSelected.classList.remove('d-none');
            //     } else {
            //         toolbarBase.classList.remove('d-none');
            //         toolbarSelected.classList.add('d-none');
            //     }
            // }

            // Public methods
            return {
                init: function () {
                    initDatatable();
                    handleSearchDatatable();
                    // initToggleToolbar();
                    // handleFilterDatatable();
                    handleDeleteRows();
                    // handleResetForm();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
    </script>
@endsection