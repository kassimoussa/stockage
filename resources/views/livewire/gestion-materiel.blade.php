<div class="py-3 ">
    <x-loading-indicator />

    <div class="d-flex justify-content-between my-3 ">
        <div class="col-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Par N° de patrimoine"
                    value="{{ $search }}">
            </div>
        </div>
        <div class="">
            <a role="button" data-bs-toggle="modal" data-bs-target="#addMateriel" type="button"
                class="btn  btn-primary fw-bold">
                <i class="fas fa-plus-circle"></i> Ajouter
            </a>
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
                            <div class="col-6 ">
                                <label for="objet" class="form-label">Objet *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <select class="form-select" wire:model="objet_id" id="objet" required>
                                        <option value="" selected>Select</option>
                                        @foreach ($objets as $m)
                                        <option value="{{ $m->id }}">{{ $m->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 ">
                                <label for="marmod" class="form-label">Marque et Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <select class="form-select" wire:model="marmod_id" id="marmod" required>
                                        <option value="" selected>Select</option>
                                        @foreach ($marmods as $m)
                                        <option value="{{ $m->id }}">{{ $m->marque }} - {{ $m->model }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 ">
                                <label for="num_patrimoine" class="form-label">N° de patrimoine *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="num_patrimoine"
                                        wire:model="num_patrimoine" placeholder="Le code bar du materiel " required>
                                </div>
                            </div>

                            <div class="col-6 d-flex justify-content-center align-items-center position-relative">
                                <x-loading-indicator2 />
                                <a id="imgupload" class="" onclick="$('#imginput').trigger('click'); return false;"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Clicker pour ajouter l'image du materiel ">
                                    <img alt="Image du materiel" hover="Image du materiel" src="{{ asset($url) }}"
                                        class="avatar border border-1 " id="avatar" width="100%" height="200">
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
                            <div class="col-6 ">
                                <label for="objet" class="form-label">Objet *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <select class="form-select" wire:model="objet_id2" id="objet" required>
                                        <option value="" selected>Select</option>
                                        @foreach ($objets as $m)
                                        <option value="{{ $m->id }}">{{ $m->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 ">
                                <label for="marmod" class="form-label">Marque et Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-cog"></i>
                                    </span>
                                    <select class="form-select" wire:model="marmod_id2" id="marmod" required>
                                        <option value="" selected>Select</option>
                                        @foreach ($marmods as $m)
                                        <option value="{{ $m->id }}">{{ $m->marque }} - {{ $m->model }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 ">
                                <label for="num_patrimoine2" class="form-label">N° de patrimoine *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="num_patrimoine2"
                                        wire:model="num_patrimoine2" placeholder="Le code bar du materiel " required>
                                </div>
                            </div>

                            <div class="col-6 d-flex justify-content-center align-items-center position-relative">
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

    <div class="col ">
        <table class="table table-bordered border-dark table-striped table-hover table-sm align-middle " id="">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">N° Patrimoine</th>
                <th scope="col">Image</th>
                <th scope="col">Objet</th>
                <th scope="col">Marque</th>
                <th scope="col">Model</th>
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
                <tr {{-- wire:click="selectMatRow({{ $materiel->id }})"
                    class="{{ $materiel->id === $selectedMatRowId ? 'selectedMat' : '' }}" --}}>
                    <td>{{ $cnt}}</td>
                    <td>{{ $materiel->num_patrimoine }}</td>
                    <td><img src="{{ asset($materiel->storage_path) }}" width="50" alt="{{ $materiel->filename }}"
                            role="button" wire:click="showImg('{{ $materiel->id }}')" data-bs-toggle="modal"
                            data-bs-target="#imgmodal"> </td>
                    <td>{{ $materiel->objet->nom }}</td>
                    <td>{{ $materiel->marmod->marque }}</td>
                    <td>{{ $materiel->marmod->model }}</td>
                    <td class="td-actions ">
                        {{-- <a class="btn " href="{{ url("materiel/show", $materiel) }}" title="Voir + ">
                            <i class="fas fa-eye"></i>
                        </a> --}}
                        <a class="btn  " data-bs-toggle="modal" data-bs-target="#editMateriel"
                            wire:click="loadid('{{ $materiel->id }}')" title="Modifier la marque">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn  " data-bs-toggle="modal" data-bs-target="#delMat"
                            wire:click="loadid('{{ $materiel->id }}')" title="Supprimer la marque">
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



</div>