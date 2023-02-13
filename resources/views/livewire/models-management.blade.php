<div class="py-3 ">
    <x-loading-indicator />

    <div class="d-flex justify-content-between my-3 ">
        <div class="col-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Par le nom de l'objet "
                    value="{{ $search }}">
            </div>
        </div>
        <div class="">
            <a role="button" data-bs-toggle="modal" data-bs-target="#add" type="button"
                class="btn  btn-primary fw-bold">
                <i class="fas fa-plus-circle"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="store">
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
                            <div class="col-4 ">
                                <label for="category_id" class="form-label">Categorie *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-server"></i>
                                    </span>
                                    <select class="form-control" id="category_id" wire:model="category_id">
                                        <option>--Select option--</option>
                                        @foreach ($categories as $choi)
                                        <option value="{{ $choi->id }}">{{ $choi->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <label for="marque_id" class="form-label">Marque *</label>
                                <div class="input-group mb-3  ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-server"></i>
                                    </span>
                                    <select class="form-control" id="marque_id" wire:model="marque_id">
                                        <option>--Select option--</option>
                                        @foreach ($marques as $choi)
                                        <option value="{{ $choi->id }}">{{ $choi->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <label for="name" class="form-label">Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="name" wire:model="name"
                                        placeholder="ex KB1755" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="update">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Modification </h3>
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
                            <div class="col-4 ">
                                <label for="category_id2" class="form-label">Categorie *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-server"></i>
                                    </span>
                                    <select class="form-control" id="category_id2" wire:model="category_id2">
                                        <option>--Select option--</option>
                                        @foreach ($categories as $choi)
                                        <option value="{{ $choi->id }}">{{ $choi->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <label for="marque_id2" class="form-label">Marque *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-server"></i>
                                    </span>
                                    <select class="form-control" id="marque_id2" wire:model="marque_id2">
                                        <option>--Select option--</option>
                                        @foreach ($marques as $choi)
                                        <option value="{{ $choi->id }}">{{ $choi->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <label for="name2" class="form-label">Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="name2" wire:model="name2"
                                        placeholder="ex KB1755" required>
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
                <th scope="col">Model</th>
                <th scope="col">Categorie</th>
                <th scope="col">Marque</th>
                <th scope="col">Nb Materiel</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($models->isNotEmpty())
                @php
                $cnt = 1;
                $addmodal = 'add' . $cnt;
                $editmodal = 'edit' . $cnt;
                $delmodal = 'delete' . $cnt;
                $showmodal = 'showmodal' . $cnt;
                @endphp

                @foreach ($models as $key => $model)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $model->name }}</td>
                    <td>{{ $model->category->name }}</td>
                    <td>{{ $model->marque->name }}</td>
                    <td>{{ $model->materiels->count() }}</td>
                    <td class="td-actions ">
                        <a class="btn " data-bs-toggle="modal" data-bs-target="#{{ $showmodal }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn  " data-bs-toggle="modal" data-bs-target="#edit"
                            wire:click="loadid('{{ $model->id }}')" title="Modifier le categorie">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn  " data-bs-toggle="modal" data-bs-target="#delete"
                            wire:click="loadid('{{ $model->id }}')" title="Supprimer le categorie">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>

                <x-delete-modal delmodal="delete" message="Confirmer la suppression " delf="delete" />

                {{-- <div class="modal fade" id="{{ $showmodal }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
                </div> --}}

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