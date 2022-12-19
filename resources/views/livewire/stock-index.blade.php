<div class="containe">
    <x-loading-indicator />
    
    <div class="row row-cols-2 row-cols-md-3 g-4 py-2 d-flex justify-content-center">
        <div class="col p-2">
            <div class="card border-primary no-radius text-center bg-white">
                <div class="card-body">
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-square fa-stack-2x blciel"></i>
                        <i class="fas fa-folder-plus fa-stack-1x dore"></i>
                    </span>
                    <h2 class="StepTitle card-title">Nouveau Site</h2>
                    <p class="cl-effect-1">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#addsite">
                            Ajouter un site
                        </a>
                    </p>
                </div>
            </div>
        </div> 

        @foreach ($sites as $site )
            <x-card-icon icon="fa-folder" :title="$site->nom_site" :url="'/stocks/'. $site->nom_site" text="Voir le stock" />
        @endforeach

    </div>

    <div class="modal fade" id="addsite" tabindex="-1" aria-hidden="true"  wire:ignore.self >
        <div class="modal-dialog modal-xl modal-dialog-centered " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeSite">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajout d'un nouveau site </h3>
                        <div class="row" style="text-align: center;">
                            <div class=" form-group">
                                <button type="submit" name="submit"
                                    class="btn btn-primary fw-bold">Enregistrer</button>
                                <button type="button" class="btn btn-danger fw-bold " wire:click="close_modal"
                                    data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <label for="name" class="form-label">Nom  *</label>
                            <div class="input-group mb-3 ">
                                <span class="input-group-text txt fw-bold bg-primary text-white">
                                    <i class="fas fa-folder"></i>
                                </span>
                                <input type="text" class="form-control" id="name" wire:model="nom_site" placeholder="Nom du site" required>
                            </div>
                            <span class="text-danger">
                                @error('nom_site')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> 
