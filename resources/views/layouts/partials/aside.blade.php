<!--begin::Aside-->
<div id="kt_aside" class="aside card" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid px-5">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 pe-4 me-n4" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="{lg: '75px'}">
            <div class="menu menu-column menu-rounded fw-bold fs-6" id="#branches_menu" data-kt-menu="true">
                <div class="menu-item here show">
                    <a class="menu-link" href="{{ route('home') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                    <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                    <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
            </div>

            @can('read partner')    
                <div class="menu menu-column menu-rounded fw-bold fs-6" id="#partner_menu" data-kt-menu="true">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.partners.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                        <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Partners</span>
                        </a>
                    </div>
                </div>
            @endcan

            @can('read role')    
                <div class="menu menu-column menu-rounded fw-bold fs-6" id="" data-kt-menu="true">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.roles.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                        <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                    </div>
                </div>
            @endcan
            
            @can('read permission')    
                <div class="menu menu-column menu-rounded fw-bold fs-6" id="" data-kt-menu="true">
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.permissions.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                        <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Permissions</span>
                        </a>
                    </div>
                </div>
            @endcan
            
            @can('read business unit')    
                <div class="menu menu-column menu-rounded fw-bold fs-6" id="#businessunit_menu" data-kt-menu="true">
                    <div class="menu-item here show">
                        <a class="menu-link" href="{{ route('partner.businessunits.index') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="black" />
                                        <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                                        <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Business Units</span>
                        </a>
                    </div>
                </div>
            @endcan

            @can('view patient menu')    
                <div class="menu menu-column menu-rounded fw-bold fs-6" id="#patients_menu" data-kt-menu="true">
                    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Patients</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion menu-active-bg">
                            @can('create patient')    
                                <div class="menu-item">
                                    <a href="{{ route('bu.patients.create') }}" class="menu-link">
                                        <span class="menu-title">Add New Paient</span>
                                    </a>
                                </div>
                            @endcan

                            @can('read patient')
                                <div class="menu-item">
                                    <a href="{{ route('bu.patients.index') }}" class="menu-link">
                                        <span class="menu-title">All Patients</span>
                                    </a>
                                </div>
                            @endcan
                            
                            @can('create appoinment')    
                                <div class="menu-item">
                                    <a href="{{ route('bu.appointments.create') }}" class="menu-link">
                                        <span class="menu-title">Add Appointment</span>
                                    </a>
                                </div>
                            @endcan
                            
                            @can('read appointment')    
                                <div class="menu-item">
                                    <a href="{{ route('bu.appointments.index', ['upcoming' => 'yes']) }}" class="menu-link">
                                        <span class="menu-title">Upcoming Appointments</span>
                                    </a>
                                </div>
                            @endcan

                            <div class="menu-item">
                                <a href="{{ route('bu.case.index') }}" class="menu-link">
                                    <span class="menu-title">Cases</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('view administrative menu')    
                <div class="menu menu-column menu-rounded fw-bold fs-6" id="#administrative_menu" data-kt-menu="true">
                    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Administrative</span>
                            <span class="menu-arrow"></span>
                        </span>

                        @can('view branch menu' )    
                            <div class="menu-sub menu-sub-accordion">
                                <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-title">Branches</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    <div class="menu-sub menu-sub-accordion">
                                        @can('create branch')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.branches.create') }}" class="menu-link">
                                                    <span class="menu-title">Add Branch</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('read branch')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.branches.index') }}" class="menu-link">
                                                    <span class="menu-title">All Branches</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcan
                        
                        @can('view chair menu' )    
                            <div class="menu-sub menu-sub-accordion">
                                <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-title">Chairs</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    <div class="menu-sub menu-sub-accordion">
                                        @can('create chair')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.chairs.create') }}" class="menu-link">
                                                    <span class="menu-title">Add Chair</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('read chair')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.chairs.index') }}" class="menu-link">
                                                    <span class="menu-title">All Chairs</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcan
                        
                        @can('view clinical specialization menu' )    
                            <div class="menu-sub menu-sub-accordion">
                                <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-title">Clinical Specializations</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    <div class="menu-sub menu-sub-accordion">
                                        @can('create clinical specialization')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.clinical.specialization.index', ['create' => 'yes']) }}" class="menu-link">
                                                    <span class="menu-title">Add Specialization</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('read clinical specialization')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.clinical.specialization.index') }}" class="menu-link">
                                                    <span class="menu-title">All Specializations</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @can('view treatment service menu' )    
                            <div class="menu-sub menu-sub-accordion">
                                <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-title">Treatment Service</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    <div class="menu-sub menu-sub-accordion">
                                        @can('create treatment service')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.treatment.service.create') }}" class="menu-link">
                                                    <span class="menu-title">Add Treatment Service</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('read treatment service')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.treatment.service.index') }}" class="menu-link">
                                                    <span class="menu-title">All Treatment Services</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcan
                        
                        @can('view treatment procedure menu' )    
                            <div class="menu-sub menu-sub-accordion">
                                <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-title">Treatment Procedure</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    <div class="menu-sub menu-sub-accordion">
                                        @can('create treatment procedure')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.treatment.service.procedure.create') }}" class="menu-link">
                                                    <span class="menu-title">Add Treatment Procedure</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('read treatment procedure')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.treatment.service.procedure.index') }}" class="menu-link">
                                                    <span class="menu-title">All Treatment Procedures</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcan
                        
                        @can('view employment menu' )    
                            <div class="menu-sub menu-sub-accordion">
                                <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-title">Employments</span>
                                        <span class="menu-arrow"></span>
                                    </span>

                                    <div class="menu-sub menu-sub-accordion">
                                        @can('create employment')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.employment.create') }}" class="menu-link">
                                                    <span class="menu-title">Add Employment</span>
                                                </a>
                                            </div>
                                        @endcan

                                        @can('read employment')    
                                            <div class="menu-item">
                                                <a href="{{ route('bu.employment.index') }}" class="menu-link">
                                                    <span class="menu-title">All Employments</span>
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->