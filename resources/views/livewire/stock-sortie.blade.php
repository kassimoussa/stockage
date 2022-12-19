<div class="py-4 px-3 ">
    <x-loading-indicator />

    <form  wire:submit.prevent="newSortie" class="form">
        <div class="card col-md-12 mb-3">
            <h4 class="card-header text-center">Nouvelle Sortie</h4>
            <div class="card-body">
                <div class="row">
                    <div class="float-left col-2 position-relative me-1">
                        <img src="{{ asset($stock->storage_path) }}" class=" rounde  " width="200"
                            height="200" alt="..." >
                        <a class="btn text-success  position-absolute top-0 start-100 translate-middle badge" data-bs-toggle="modal" data-bs-target="#editimage">
                            <i class="fas fa-edit fa-xl"></i> 
                        </a> 
                    </div>
                    <div class="row col">
                        <div class="col-md-6">
                            <div class="input-group mb-3 ">
                                <span class="input-group-text txt fw-bold ">Materiel</span>
                                <input type="text" class="form-control"  name="materiel"
                                    value="{{ $stock->materiel }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3 mb-3">
                                <span class="input-group-text txt fw-bold ">Quantité</span>
                                <input type="number" class="form-control" wire:model="newquantite" min="1"
                                    max="{{ $stock->quantite }}"
                                    placeholder="Quantité disponible: {{ $stock->quantite }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3 ">
                                <span class="input-group-text txt fw-bold ">Raison</span>
                                <input type="text" class="form-control" wire:model="raison"
                                    placeholder="Raison de la sortie" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3 mb-3">
                                <span class="input-group-text txt fw-bold ">Date</span>
                                <input type="date" class="form-control" wire:model="date_sortie" required>
                            </div>
                        </div>

                        <div class="row mt-3 mb-2">
                            <div class="col-md-12 form-group text-center">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                                <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </form>

    <div class="my-4">
        <h3>Dernières Sorties pour {{ $stock->materiel }}</h3>
        <table class="table table-bordered table-striped hover table-sm align-middle ">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Quantité</th>
                <th scope="col">Raison</th>
                <th scope="col">User</th>
                <th scope="col">Date</th>
            </thead>
            <tbody class="text-center">
                @if ($sorties->isNotEmpty())
                    @php
                        $cnt = 1;
                    @endphp

                    @foreach ($sorties as $key => $sortie)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $sortie->quantite }}</td>
                            <td>{{ ucfirst($sortie->raison) }}</td>
                            <td>{{ $sortie->submitedby }}</td>
                            <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
                        </tr>
                        @php
                            $cnt = $cnt + 1;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>



    <div class="modal fade" id="editimage" tabindex="-1" aria-hidden="true"  wire:ignore.self >
        <div class="modal-dialog modal-md modal-dialog-centered " role="document">
            <div class="modal-content">
                <form >
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Modification image </h3>
                        <div class="row" style="text-align: center;">
                            <div class=" form-group">
                                <button  wire:click="updateImage"
                                    class="btn btn-primary fw-bold">Enregistrer</button>
                                <button type="button" class="btn btn-danger fw-bold " 
                                    data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="form-group  control-label ">
                                <a id="imgupload" class=""
                                    onclick="$('#imginput').trigger('click'); return false;"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Clicker pour changer d'image ">
                                    <img alt="Image du materiel" hover="Image du materiel" src="{{ asset($url) }}"
                                        class="avatar border border-1 " id="avatar" width="200"
                                        height="200">
                                </a>
                                <input type="file" wire:model="newimage" id="imginput" class="dimage"
                                    style="display: none;" onchange="readURL(this);" accept="image/*">
                            </div>
                            <span class="text-danger">
                                @error('newimage')
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
