@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">All Cases</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-slash fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">All Cases</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">View Case</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Post-->
    <div class="content flex-column-fluid" id="kt_content">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2 class="fw-bolder">Case Details</h2>
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-3">
                        <!--begin::Section-->
                        <div class="mb-0">
                            <!--begin::Title-->
                            <h5 class="mb-4">Chief Complaint:</h5>
                            <!--end::Title-->
                            
                            <div class="table-responsive">
                                <!--begin::Complaint Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-4 mb-15">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-150px">Complaint Type</th>
                                            <th class="min-w-125px">Tooth</th>
                                            <th class="min-w-125px">Actions</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-800">
                                        @isset($case->complaints)
                                            @foreach ($case->complaints as $complaint)    
                                                <tr>
                                                    <td>{{ $complaint->type->name }}</td>
                                                    @if (!is_null($complaint->tooth))
                                                        <td>{{ $complaint->tooth->position . '/' . $complaint->tooth->quadrant . $complaint->tooth->quadrant }}</td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-light-danger">No tooth selected</span>
                                                        </td>
                                                    @endif
                                                    <td class="text-start">
                                                        <!--begin::Action-->
                                                        <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-6 w-200px py-4" data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Edit Complaint</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3" data-kt-subscriptions-view-action="delete">Delete Complaint</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::Action-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Complaint Table-->

                                <!--begin::Finding Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-4 mb-15">
                                    <!--begin::Table head-->
                                    <thead>
                                        <!--begin::Table row-->
                                        <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-150px">Clinical Findings</th>
                                            <th class="min-w-125px">Tooth</th>
                                            <th class="min-w-125px">Actions</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-800">
                                        @isset($case->findings)
                                            @foreach ($case->findings as $finding)    
                                                <tr>
                                                    <td>{{ $finding->type->name }}</td>
                                                    @if (!is_null($finding->tooth))
                                                        <td>{{ $finding->tooth->position . '/' . $finding->tooth->quadrant . $finding->tooth->number }}</td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-light-danger">No tooth selected</span>
                                                        </td>
                                                    @endif
                                                    <td class="text-start">
                                                        <!--begin::Action-->
                                                        <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-6 w-200px py-4" data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">Edit Finding</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3" data-kt-subscriptions-view-action="delete">Delete Finding</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::Action-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Finding Table-->
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Treatment Plan</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-bold gy-5">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-150px">Category Id</th>
                                        <th class="min-w-150px">Category</th>
                                        <th class="min-w-150px">Service Id</th>
                                        <th class="min-w-150px">Service</th>
                                        <th class="min-w-150px">Cost</th>
                                        <th class="min-w-100px">Quantity</th>
                                        <th class="min-w-150px">Discount</th>
                                        <th class="min-w-150px">Price</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @isset($case->treatmentPlans)
                                        @foreach ($case->treatmentPlans as $plan)    
                                            <!--begin::Table row-->
                                            <tr>
                                                <td class="min-w-150px">{{ $plan->category->uid }}</td>
                                                <td class="min-w-150px">{{ $plan->category->name }}</td>
                                                <td class="min-w-150px">{{ $plan->service->uid }}</td>
                                                <td class="min-w-150px">{{ $plan->service->name }}</td>
                                                <td class="min-w-150px"><sub>₹</sub>{{ $plan->service->cost }}</td>
                                                <td class="min-w-150px">{{ $plan->quantity }}</td>
                                                <td>
                                                    @if (is_null($plan->discount))
                                                        <span class="badge badge-light">No discount</span>
                                                    @else
                                                        <sub>₹</sub>{{ $plan->discount }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (is_null($plan->discount))
                                                        <sub>₹</sub>{{ ($plan->service->cost * $plan->quantity) }}
                                                    @else
                                                        <sub>₹</sub>{{ ($plan->service->cost * $plan->quantity) - $plan->discount }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <!--end::Table row-->
                                        @endforeach
                                    @endisset
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Invoices</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Tab nav-->
                            <ul class="nav nav-stretch fs-5 fw-bold nav-line-tabs nav-line-tabs-2x border-transparent" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_year_tab" class="nav-link text-active-primary active" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_1">This Year</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_2019_tab" class="nav-link text-active-primary ms-3" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_2">2020</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_2018_tab" class="nav-link text-active-primary ms-3" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_3">2019</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_2017_tab" class="nav-link text-active-primary ms-3" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_4">2018</a>
                                </li>
                            </ul>
                            <!--end::Tab nav-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <!--begin::Tab Content-->
                        <div id="kt_referred_users_tab_content" class="tab-content">
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_1" class="tab-pane fade show active" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_1" class="table align-middle table-row-dashed fs-6 fw-bolder gs-0 gy-4 p-0 m-0">
                                        <!--begin::Thead-->
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bolder">
                                            <tr class="text-start text-gray-400">
                                                <th class="min-w-100px">Order ID</th>
                                                <th class="min-w-100px">Amount</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-125px">Date</th>
                                                <th class="w-100px">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                                </td>
                                                <td class="text-success">$38.00</td>
                                                <td>
                                                    <span class="badge badge-light-info">In progress</span>
                                                </td>
                                                <td>Nov 01, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">423445721</a>
                                                </td>
                                                <td class="text-danger">$-2.60</td>
                                                <td>
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                </td>
                                                <td>Oct 24, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">312445984</a>
                                                </td>
                                                <td class="text-success">$76.00</td>
                                                <td>
                                                    <span class="badge badge-light-info">In progress</span>
                                                </td>
                                                <td>Oct 08, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">312445984</a>
                                                </td>
                                                <td class="text-success">$5.00</td>
                                                <td>
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                </td>
                                                <td>Sep 15, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">523445943</a>
                                                </td>
                                                <td class="text-danger">$-1.30</td>
                                                <td>
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <td>May 30, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_2" class="tab-pane fade" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_2" class="table align-middle table-row-dashed fs-6 fw-bolder gs-0 gy-4 p-0 m-0">
                                        <!--begin::Thead-->
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bolder">
                                            <tr class="text-start text-gray-400">
                                                <th class="min-w-100px">Order ID</th>
                                                <th class="min-w-100px">Amount</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-125px">Date</th>
                                                <th class="w-100px">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">523445943</a>
                                                </td>
                                                <td class="text-danger">$-1.30</td>
                                                <td>
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                </td>
                                                <td>May 30, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">231445943</a>
                                                </td>
                                                <td class="text-success">$204.00</td>
                                                <td>
                                                    <span class="badge badge-light-warning">Pending</span>
                                                </td>
                                                <td>Apr 22, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">426445943</a>
                                                </td>
                                                <td class="text-success">$31.00</td>
                                                <td>
                                                    <span class="badge badge-light-info">In progress</span>
                                                </td>
                                                <td>Feb 09, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">984445943</a>
                                                </td>
                                                <td class="text-success">$52.00</td>
                                                <td>
                                                    <span class="badge badge-light-warning">Pending</span>
                                                </td>
                                                <td>Nov 01, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">324442313</a>
                                                </td>
                                                <td class="text-danger">$-0.80</td>
                                                <td>
                                                    <span class="badge badge-light-warning">Pending</span>
                                                </td>
                                                <td>Jan 04, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_3" class="tab-pane fade" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_3" class="table align-middle table-row-dashed fs-6 fw-bolder gs-0 gy-4 p-0 m-0">
                                        <!--begin::Thead-->
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bolder">
                                            <tr class="text-start text-gray-400">
                                                <th class="min-w-100px">Order ID</th>
                                                <th class="min-w-100px">Amount</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-125px">Date</th>
                                                <th class="w-100px">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">426445943</a>
                                                </td>
                                                <td class="text-success">$31.00</td>
                                                <td>
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                </td>
                                                <td>Feb 09, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">984445943</a>
                                                </td>
                                                <td class="text-success">$52.00</td>
                                                <td>
                                                    <span class="badge badge-light-info">In progress</span>
                                                </td>
                                                <td>Nov 01, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">324442313</a>
                                                </td>
                                                <td class="text-danger">$-0.80</td>
                                                <td>
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <td>Jan 04, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">312445984</a>
                                                </td>
                                                <td class="text-success">$5.00</td>
                                                <td>
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <td>Sep 15, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                                </td>
                                                <td class="text-success">$38.00</td>
                                                <td>
                                                    <span class="badge badge-light-danger">Rejected</span>
                                                </td>
                                                <td>Nov 01, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_4" class="tab-pane fade" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_4" class="table align-middle table-row-dashed fs-6 fw-bolder gs-0 gy-4 p-0 m-0">
                                        <!--begin::Thead-->
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bolder">
                                            <tr class="text-start text-gray-400">
                                                <th class="min-w-100px">Order ID</th>
                                                <th class="min-w-100px">Amount</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-125px">Date</th>
                                                <th class="w-100px">Invoice</th>
                                            </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fs-6 fw-bold text-gray-600">
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                                </td>
                                                <td class="text-success">$38.00</td>
                                                <td>
                                                    <span class="badge badge-light-info">In progress</span>
                                                </td>
                                                <td>Nov 01, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">423445721</a>
                                                </td>
                                                <td class="text-danger">$-2.60</td>
                                                <td>
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <td>Oct 24, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                                </td>
                                                <td class="text-success">$38.00</td>
                                                <td>
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <td>Nov 01, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">423445721</a>
                                                </td>
                                                <td class="text-danger">$-2.60</td>
                                                <td>
                                                    <span class="badge badge-light-success">Approved</span>
                                                </td>
                                                <td>Oct 24, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-gray-600 text-hover-primary">426445943</a>
                                                </td>
                                                <td class="text-success">$31.00</td>
                                                <td>
                                                    <span class="badge badge-light-warning">Pending</span>
                                                </td>
                                                <td>Feb 09, 2020</td>
                                                <td class="">
                                                    <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
            <!--begin::Sidebar-->
            <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10 order-1 order-lg-2">
                <!--begin::Card-->
                <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="case-summary" data-kt-sticky-offset="{default: false, lg: '200px'}" data-kt-sticky-width="{lg: '250px', xl: '350px'}" data-kt-sticky-left="auto" data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Patient</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 fs-6">
                        <!--begin::Section-->
                        <div class="mb-7">
                            <!--begin::Details-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-60px symbol-circle me-3">
                                    <img alt="Pic" src="{{ asset('media/avatars/300-1.jpg') }}" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-2">{{ $case->patient->full_name }}</a>
                                    <!--end::Name-->
                                    <!--begin::Email-->
                                    <a href="javascript:void(0)" class="fw-bolder text-gray-600 text-hover-primary">{{ $case->patient->email }}</a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Seperator-->
                        <div class="separator separator-dashed mb-7"></div>
                        <!--end::Seperator-->
                        <!--begin::Section-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <h5 class="mb-4">Details</h5>
                            <!--end::Title-->
                            <!--begin::Details-->
                            <table class="table fs-6 fw-bold gs-0 gy-2 gx-2">
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400">Status:</td>
                                    <td class="text-gray-800">
                                        @if ($case->status === 'open')
                                            <span class="badge badge-light">{{ ucwords($case->status) }}</span>
                                        @elseif ($case->status === 'inprogress')
                                            <span class="badge badge-info">{{ ucwords($case->status) }}</span>
                                        @elseif ($case->status === 'completed')
                                            <span class="badge badge-success">{{ ucwords($case->status) }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ ucwords($case->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400">Branch:</td>
                                    <td class="text-gray-800">{{ $case->branch->full_name }}</td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400 min-w-150px">Case Id:</td>
                                    <td class="text-gray-800">{{ $case->uid }}</td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400 min-w-150px">Patient Id:</td>
                                    <td class="text-gray-800">{{ $case->patient->uid }}</td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400 min-w-150px">Patient Name:</td>
                                    <td class="text-gray-800">{{ $case->patient->full_name }}</td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400 min-w-150px">Contact No:</td>
                                    <td class="text-gray-800">{{ $case->patient->contact_no }}</td>
                                </tr>
                                <!--end::Row-->
                            </table>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Seperator-->
                        <div class="separator separator-dashed mb-7"></div>
                        <!--end::Seperator-->
                        <!--begin::Section-->
                        <div class="mb-10">
                            <!--begin::Title-->
                            <h5 class="mb-4">Investigation</h5>
                            <!--end::Title-->
                            <!--begin::Details-->
                            <table class="table fs-6 fw-bold gs-0 gy-2 gx-2">
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400">Blood Pressure:</td>
                                    <td class="text-gray-800">{{ $case->investigation->blood_pressure }}</td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400">O<sub>2</sub></td>
                                    <td class="text-gray-800">{{ $case->investigation->oxygen }}</td>
                                </tr>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <tr class="">
                                    <td class="text-gray-400">Blood Sugar:</td>
                                    <td class="text-gray-800">{{ $case->investigation->blood_sugar }}</td>
                                </tr>
                                <!--end::Row-->
                            </table>
                            <!--end::Details-->
                        </div>
                        <!--end::Section-->
                        <!--begin::Actions-->
                        <div class="mb-0">
                            <a href="javascript:void(0)" class="btn btn-primary" id="show-notes-button" data-bs-toggle="modal" data-bs-target="#case-notes-modal">Notes</a>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Sidebar-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Post-->

    <!--begin::Modals-->
    @include('cases.modal.notes')
    <!--end::Modals-->
@endsection

@section('script')
    <script>
        KTUtil.onDOMContentLoaded(function () {
            var selectedElement = $('.case_notes')

            for (let index = 0; index < selectedElement.length; index++) {
                ClassicEditor
                    .create(document.querySelector('textarea[name="case_notes['+ index +']"]'))
                    .then(editor => {
                    })
                    .catch(error => {
                    })
            }
        });
    </script>
@endsection