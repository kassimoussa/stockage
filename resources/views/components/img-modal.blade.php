<div class="modal fade" id="{{ $imgmodal }}" tabindex="-1" wire:ignore.self aria-labelledby="imgmodal"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg  modal-dialog-centered  " role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h4>Image  </h4>
                <button type="button" class="btn btn-danger fw-bold " wire:click="close_img"
                    data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body position-relative">
                <x-loading-indicator2 />
                <img src="{{ asset($imgurl) }}" width="100%" height="100%" >
            </div> 
        </div>
    </div>
</div>