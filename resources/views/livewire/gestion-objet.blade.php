<div class="py-3 ">
    <x-loading-indicator />

    <div class="d-flex justify-content-between my-3 ">
        <div class="col-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder=" .." value="{{ $search }}">
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
                                <label for="nom_obj" class="form-label">Nom *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_obj" wire:model="nom_obj"
                                        placeholder="Ex: Ecran, Clavier, Serveur, etc..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

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

    <div class="modal fade" id="addMateriel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeMateriel">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajout Materiel</h3>
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
                            {{-- <div class="input-group">
                                <span class="input-group-text txt fw-bold bg-primary text-white">
                                    <i class="fas fa-barcode"></i>
                                </span>
                                <input type="text" class="form-control" wire:model="num_patrimoine"
                                    placeholder="N° de patrimoine" required>
                                <input type="file" wire:model="filename" class="form-control" accept="image/*">

                            </div> --}}

                            <div class="col-12 ">
                                <label for="num_patrimoine" class="form-label">N° de patrimoine *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="num_patrimoine"
                                        wire:model="num_patrimoine" placeholder="Le code bar du materiel " required>
                                </div>
                            </div>

                            <div class="col d-flex justify-content-center align-items-center position-relative">
                                <x-loading-indicator2 />
                                <a id="imgupload" class="" onclick="$('#imginput').trigger('click'); return false;"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Clicker pour ajouter l'image du materiel ">
                                    <img alt="Image du materiel" hover="Image du materiel" src="{{ asset($url) }}"
                                        class="avatar border border-1 " id="avatar" width="200" height="200">
                                </a>
                                <input type="file" wire:model="filename" id="imginput" class="dimage"
                                    style="display: none;" onchange="readURL(this);" accept="image/*">

                                {{-- <i class="fas fa-arrow-right fa-2x mx-5 "></i>

                                <img src="{{ asset($url) }}" alt="" width="200" height="200"> --}}

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
                                <label for="nom_obj2" class="form-label">Nom *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nom_obj2" wire:model="nom_obj2"
                                        placeholder="Ex: Ecran, Clavier, Serveur, etc..." required>
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

    <div class="modal fade" id="editMateriel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="updateMateriel">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Modifier Materiel</h3>
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
                                <label for="num_patrimoine2" class="form-label">N° de patrimoine *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="num_patrimoine2"
                                        wire:model="num_patrimoine2" placeholder="Le code bar du materiel " required>
                                </div>
                            </div>

                            <div class="col d-flex justify-content-center align-items-center position-relative">
                                <x-loading-indicator2 />
                                <a id="imgupload" class="" onclick="$('#imginput2').trigger('click'); return false;"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Clicker pour ajouter l'image du materiel ">
                                    <img alt="Image du materiel" hover="Image du materiel" src="{{ asset($url) }}"
                                        class="avatar border border-1 " id="avatar" width="200" height="200">
                                </a>
                                <input type="file" wire:model="filename2" id="imginput2" class="dimage"
                                    style="display: none;" onchange="readURL(this);" accept="image/*">

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row  {{ $disposition }} g-2 py-2 d-flex justify-content-center">

        <div class="col ">
            <table class="table table-bordered border-dark table-striped table-hover table-sm align-middle " id="">
                <thead class="bg-dark text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">objet</th>
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
                    <tr wire:click="selectObjRow({{ $objet->id }})"
                        class="{{ $objet->id === $selectedObjRowId ? 'selectedObj' : '' }}">
                        <td>{{ $cnt }}</td>
                        <td>{{ $objet->nom }}</td>
                        <td class="td-actions ">
                            <a class="btn " wire:click="getMarmods('{{ $objet->id }}')" title="Voir les marques">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#addMarmod"
                                wire:click="setObjetId('{{ $objet->id }}')" title="Ajouter une marque">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#editObjet"
                                wire:click="getObjet('{{ $objet->id }}')" title="Modifier l'objet">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#delObjet"
                                wire:click="setObjetId('{{ $objet->id }}')" title="Supprimer l'objet">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            {{-- <div class="dropdown dropstart">
                                <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false" id="dropdownMenu2">
                                    <span class="badge rounded-pill bg-dark"><i class="fas fa-ellipsis-h"></i></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a class="btn  dropdown-item" wire:click="getModels('{{ $materiel->id }}')">
                                        <i class="fas fa-eye"></i> Voir les models
                                    </a>
                                    <a class="btn  dropdown-item " data-bs-toggle="modal" data-bs-target="#addmodel"
                                        wire:click="loadid('{{ $materiel->id }}')">
                                        <i class="fas fa-plus-circle"></i> Ajouter un model
                                    </a>
                                    <a class="btn  dropdown-item " data-bs-toggle="modal" data-bs-target="#editmodal"
                                        wire:click="loadid('{{ $materiel->id }}')">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <a class="btn  dropdown-item " data-bs-toggle="modal" data-bs-target="#delmodal"
                                        wire:click="loadid('{{ $materiel->id }}')">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </a>
                                </div>
                            </div> --}}
                        </td>
                    </tr>

                    <x-delete-modal delmodal="delObjet" message="Confirmer la suppression " delf="deleteObjet" />

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

        @if ($status_mod == "show")
        <div class="col ">
            <table class="table table-bordered border-dark table-striped table-hover table-sm align-middle " id="">
                <thead class="bg-dark text-white text-center">
                    <th scope="col">#</th>
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
                    <tr wire:click="selectModRow({{ $marmod['id']}})"
                        class="{{ $marmod['id']=== $selectedModRowId ? 'selectedMod' : '' }}">
                        <td>{{ $cnt }}</td>
                        <td>{{ $marmod['marque'] }}</td>
                        <td>{{ $marmod['model'] }}</td>
                        <td>{{ $marmod['quantite'] }}</td>
                        <td class="td-actions ">
                            <a class="btn " wire:click="getMateriels('{{ $marmod['id']}}')" title="Voir les materiels">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#addMateriel"
                                wire:click="setMarModId('{{ $marmod['id']}}')" title="Ajouter un materiel">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#editMarmod"
                                wire:click="getMarMod('{{ $marmod['id']}}')" title="Modifier la marque">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#delMod"
                                wire:click="setMarModId('{{ $marmod['id']}}')" title="Supprimer la marque">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            {{-- <div class="dropdown dropstart">
                                <button type="button" class="btn  dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false" id="dropdownMenu2">
                                    <span class="badge rounded-pill bg-dark"><i class="fas fa-ellipsis-h"></i></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a class="btn  dropdown-item" wire:click="getModels('{{ $materiel->id }}')">
                                        <i class="fas fa-eye"></i> Voir les models
                                    </a>
                                    <a class="btn  dropdown-item " data-bs-toggle="modal" data-bs-target="#addmodel"
                                        wire:click="loadid('{{ $materiel->id }}')">
                                        <i class="fas fa-plus-circle"></i> Ajouter un model
                                    </a>
                                    <a class="btn  dropdown-item " data-bs-toggle="modal" data-bs-target="#editmodal"
                                        wire:click="loadid('{{ $materiel->id }}')">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <a class="btn  dropdown-item " data-bs-toggle="modal" data-bs-target="#delmodal"
                                        wire:click="loadid('{{ $materiel->id }}')">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </a>
                                </div>
                            </div> --}}
                        </td>
                    </tr>

                    <x-delete-modal delmodal="delMod" message="Confirmer la suppression " delf="delMod" />

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
        @endif

        @if ($status_mat == "show")
        <div class="col ">
            <table class="table table-bordered border-dark table-striped table-hover table-sm align-middle " id="">
                <thead class="bg-dark text-white text-center">
                    <th scope="col">#</th>
                    <th scope="col">N° Patrimoine</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </thead>
                <tbody class="text-center">
                    @if ($materiels->isNotEmpty())
                    @php
                    $cnt = 1;
                    $addmodal = 'add' . $cnt;
                    $editmodal = 'edit' . $cnt;
                    $delmodal = 'delete' . $cnt;
                    $showmodal = 'showmodal' . $cnt;
                    @endphp

                    @foreach ($materiels as $key => $materiel)
                    <tr wire:click="selectMatRow({{ $materiel->id }})"
                        class="{{ $materiel->id === $selectedMatRowId ? 'selectedMat' : '' }}">
                        <td>{{ $materiel->id }}</td>
                        <td>{{ $materiel->num_patrimoine }}</td>
                        <td><img src="{{ asset($materiel->storage_path) }}" width="50" alt="{{ $materiel->filename }}"
                                role="button" wire:click="showImg('{{ $materiel->id }}')" data-bs-toggle="modal"
                                data-bs-target="#imgmodal"> </td>
                        <td class="td-actions ">
                            {{-- <a class="btn " href="{{ url("materiel/show", $materiel) }}" title="Voir + ">
                                <i class="fas fa-eye"></i>
                            </a> --}}
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#editMateriel"
                                wire:click="getMateriel('{{ $materiel->id }}')" title="Modifier la marque">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn  " data-bs-toggle="modal" data-bs-target="#delMat"
                                wire:click="setMaterielId('{{ $materiel->id }}')" title="Supprimer la marque">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>

                    <x-delete-modal delmodal="delMat" message="Confirmer la suppression " delf="deleteMateriel" />

                    <x-img-modal imgmodal="imgmodal" :imgurl="$imgUrl" />

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
        @endif


    </div>

    <style>
        .selectedObj {
            background-color: #c06f6f;
        }

        .selectedMod {
            background-color: #c06f6f;
        }

        .selectedMat {
            background-color: #c06f6f;
        }
    </style> 

</div>