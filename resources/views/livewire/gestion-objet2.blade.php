<div class="py-3 ">
    <x-loading-indicator />

    <div class="d-flex justify-content-between my-3 ">
        <div class="col-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Par le nom de l'objet " value="{{ $search }}">
            </div>
        </div>
        <div class="">
            <a role="button" data-bs-toggle="modal" data-bs-target="#addObjet" type="button"
                class="btn  btn-primary fw-bold">
                <i class="fas fa-plus-circle"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="modal fade" id="addObjet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeObjet">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajout Objet </h3>
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
                            <div class="col-12 ">
                                <label for="nom" class="form-label">Nom *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom" wire:model="nom"
                                        placeholder="Ex: Ecran, Clavier, Serveur, etc..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="editObjet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="updateObjet">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Modifier Objet </h3>
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
                            <div class="col-12 ">
                                <label for="nom2" class="form-label">Nom *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom2" wire:model="nom2"
                                        placeholder="Ex: Ecran, Clavier, Serveur, etc..." required>
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
                    <th scope="col">objet</th>
                    <th scope="col">Nb Model</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody class="text-center">
                    @if ($objets->isNotEmpty())
                    @php
                    $cnt = 1;
                    $addmodal = 'add' . $cnt;
                    $editmodal = 'edit' . $cnt;
                    $delmodal = 'delete' . $cnt;
                    $showmodal = 'showmodal' . $cnt;
                    @endphp

                    @foreach ($objets as $key => $objet)
                    <tr>
                        <td>{{ $cnt }}</td>
                        <td>{{ $objet->nom }}</td>
                        <td>{{ $objet->marmods->count() }}</td>
                        <td class="td-actions ">
                            <a class="btn " data-bs-toggle="modal" data-bs-target="#{{ $showmodal }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#editObjet"
                                wire:click="loadid('{{ $objet->id }}')" title="Modifier l'objet">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#delObjet"
                                wire:click="loadid('{{ $objet->id }}')" title="Supprimer l'objet">
                                <i class="fas fa-trash-alt"></i>
                            </a> 
                        </td>
                    </tr>

                    <x-delete-modal delmodal="delObjet" message="Confirmer la suppression " delf="deleteObjet" />

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
                                                <div class="col-md-4 fw-bold">Marque</div>
                                                <div class="col-md-4 fw-bold">Model</div>
                                            </div>
                                            @if ($objet->marmods->isNotEmpty())
                                            @foreach ($objet->marmods as $key => $marmod)
                                            <div class="row p-2 text-center align-items-center text-dark border">
                                                <div class="col-md-4 fw-bold ">
                                                    {{ $marmod->id }}
                                                </div>
                                                <div class="col-md-4 fw-bold ">
                                                    {{ $marmod->marque }}
                                                </div>
                                                <div class="col-md-4 fw-bold ">
                                                    {{ $marmod->model }}
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