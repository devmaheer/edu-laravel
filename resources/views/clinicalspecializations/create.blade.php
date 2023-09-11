<div class="modal fade" tabindex="-1" id="specialization_creation_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h5 class="modal-title">Add Specialization</h5>
    
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                {{-- Form --}}
                <form action="{{ route('bu.clinical.specialization.store') }}" method="post">
                    <div class="mb-10">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Name"/>
                    </div>
    
                    <div class="mb-10">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control form-control-solid" placeholder="Enter Description"/>
                    </div>

                    <div class="d-flex justify-content-end align-items-center mb-5">
                        <button type="button" id="close_specialization_modal" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>