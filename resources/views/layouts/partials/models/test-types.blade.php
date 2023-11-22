<div class="modal fade" id="test-type" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="card h-100 shadow-lg">
             
               
                <div class="card-body text-center">
                    <a class="btn btn-outline-primary btn-lg"
                        href="{{ route('academic.training.test', ['type' => '1']) }}"
                        style="border-radius:30px">Academic Test  </a>
                </div>
                <div class="card-body text-center">
                    <a class="btn btn-outline-primary btn-lg"
                        href="{{ route('general.training.test', ['type' => '']) }}"
                        style="border-radius:30px"> General Training Test                  </a>
                </div>
            </div>
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog--
</div>
