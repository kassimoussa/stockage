<div class="py-3 ">
    <x-loading-indicator />

    <div class="d-flex justify-content-between my-3 ">
        <div class="col-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Par Marque ou Model"
                    value="{{ $search }}">
            </div>
        </div>
        <div class="">
            <a role="button" data-bs-toggle="modal" data-bs-target="#addMarmod" type="button"
                class="btn  btn-primary fw-bold">
                <i class="fas fa-plus-circle"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="modal fade" id="addMarmod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeMarmod">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajout </h3>
                        <div class="row" style="text-align: center;">
                            <div class=" form-group">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold"
                                    data-bs-dismiss="modal">Enregistrer</button>
                                <button type="button" class="btn btn-danger fw-bold " wire:click="close_modal"
                                    data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6 ">
                                <label for="marque" class="form-label">Marque *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="marque" wire:model="marque"
                                        placeholder="Ex: Dell, HP, Acer, etc... " required>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <label for="model" class="form-label">Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="model" wire:model="model"
                                        placeholder="Ex: Pavillon-452, Z-book 17, etc..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editMarmod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="updateMarmod">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Modifer </h3>
                        <div class="row" style="text-align: center;">
                            <div class=" form-group">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold"
                                    data-bs-dismiss="modal">Enregistrer</button>
                                <button type="button" class="btn btn-danger fw-bold " wire:click="close_modal"
                                    data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6 ">
                                <label for="marque2" class="form-label">Marque *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="marque2" wire:model="marque2"
                                        placeholder="Ex: Dell, HP, Acer, etc... " required>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <label for="model2" class="form-label">Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="model2" wire:model="model2"
                                        placeholder="Ex: Pavillon-452, Z-book 17, etc..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <div class="col ">
        <table class="table table-bordered border-dark table-striped table-hover table-sm align-middle " id="">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Objet</th>
                <th scope="col">Marque</th>
                <th scope="col">Model</th>
                <th scope="col">Quantité</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($marmods->isNotEmpty())
                    @php
                        $cnt = 1;
                        $addmodal = 'add' . $cnt;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                        $showmodal = 'showmodal' . $cnt;
                    @endphp

                    @foreach ($marmods as $key => $marmod)
                        <tr {{-- wire:click="selectModRow({{ $marmod['id']}})"
                            class="{{ $marmod['id']=== $selectedModRowId ? 'selectedMod' : '' }}" --}}>
                            <td>{{ $cnt }}</td>
                            <td>{{ $marmod->objet->nom }}</td>
                            <td>{{ $marmod->marque }}</td>
                            <td>{{ $marmod->model }}</td>
                            <td>{{ $marmod->materiels->count()}}</td>
                            <td class="td-actions ">
                                <a class="btn " data-bs-toggle="modal" data-bs-target="#{{ $showmodal }}"
                                    title="Voir les materiels">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn  " data-bs-toggle="modal" data-bs-target="#editMarmod"
                                    wire:click="loadid('{{ $marmod->id}}')" title="Modifier la marque">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn  " data-bs-toggle="modal" data-bs-target="#delMod"
                                    wire:click="loadid('{{ $marmod->id}}')" title="Supprimer la marque">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                        <x-delete-modal delmodal="delMod" message="Confirmer la suppression " delf="deleteMarmod" />

                        <div class="modal fade" id="{{ $showmodal }}" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog modal-lg " role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-between">
                                        <h3>Modifer </h3>
                                        <button type="button" class="btn btn-danger fw-bold " data-bs-dismiss="modal"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="container mt-4">
                                            <div class="row bg-dark p-3 text-center text-white border">
                                                <div class="col-md-4 fw-bold">ID</div>
                                                <div class="col-md-4 fw-bold">N° Patrimoine</div>
                                                <div class="col-md-4 fw-bold">Image</div>
                                            </div>
                                            @if ($marmod->materiels->isNotEmpty())
                                            @foreach ($marmod->materiels as $key => $materiel)
                                            <div class="row p-2 text-center align-items-center text-dark border">
                                                <div class="col-md-4 fw-bold ">
                                                    {{ $materiel->id }}
                                                </div>
                                                <div class="col-md-4 fw-bold ">
                                                    {{ $materiel->num_patrimoine }}
                                                </div>
                                                <div class="col-md-4 fw-bold ">
                                                    <img src="{{ asset($materiel->storage_path) }}" width="50"
                                                        alt="{{ $materiel->filename }}">
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row p-2 text-center align-items-center text-dark border">
                                                <div class="col-md-12 fw-bold">
                                                    There are no data.
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $cnt += 1;
                            $addmodal = 'add' . $cnt;
                            $editmodal = 'edit' . $cnt;
                            $delmodal = 'delete' . $cnt;
                            $showmodal = 'showmodal' . $cnt;
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



</div>