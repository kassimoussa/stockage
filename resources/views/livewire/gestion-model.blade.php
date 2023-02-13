<div class="py-3 ">

    <div class="d-flex justify-content-between my-3 ">
        <div class="col-6">
            <div class="input-group  mb-3">
            <span class="btn btn-dark" >Chercher</span>
            <input type="text" class="form-control " wire:model="search" placeholder="Par matériel ou model"
                value="{{ $search }}">
        </div>
        </div>
        <div class="">
            <a role="button" data-bs-toggle="modal" data-bs-target="#addmodel" type="button"
                class="btn  btn-primary fw-bold">
                <i class="fas fa-plus-circle"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="modal fade" id="addmodel"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeModel">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajout </h3>
                        <div class="row" style="text-align: center;">
                            <div class=" form-group">
                                <button type="submit" name="submit"
                                    class="btn btn-primary fw-bold" data-bs-dismiss="modal" >Enregistrer</button>
                                <button type="button" class="btn btn-danger fw-bold " wire:click="close_modal"
                                    data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6 ">
                                <label for="model" class="form-label">Model *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-server"></i>
                                    </span>
                                    <input type="text" class="form-control" id="model" wire:model="model" placeholder="Ex: Ecran, Clavier, Serveur, etc..."   required>
                                </div>
                            </div>
                            <div class="col-6 ">
                                <label for="materiel" class="form-label">materiel *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-server"></i>
                                    </span>
                                    <select class="form-control" id="materiel" wire:model="materiel">
                                        <option>--Select option--</option>
                                        @foreach ($materiels as $choi)
                                            <option value="{{ $choi->nom }}">{{ $choi->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div>
        <table class="table table-bordered border-dark table-striped table-hover table-sm align-middle "
            id="">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Model</th>
                <th scope="col">Materiel</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($models->isNotEmpty())
                    @php
                        $cnt = 1;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                        $showmodal = 'showmodal' . $cnt;
                    @endphp

                    @foreach ($models as $key => $model)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $model->model }}</td>
                            <td>{{ $model->materiel }}</td>
                            <td class="td-actions ">

                                <a class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editmodal"
                                    wire:click="loadid('{{ $model->id }}')">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <a class="btn" data-bs-toggle="modal"
                                    data-bs-target="#delmodal"
                                    wire:click="loadid('{{ $model->id }}')">
                                    <i class="fas fa-trash-alt"></i> 
                                </a>
                            </td>
                        </tr>

                        @php
                            $cnt += 1;
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

        <x-delete-modal delmodal="delmodal" message="Confirmer la suppression " />

        <div class="modal fade" id="editmodal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-xl " role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="edit">
                        <div class="modal-header d-flex justify-content-between">
                            <h3>Modification </h3>
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
                            <div class="row my-2">
                                <div class="col-6 ">
                                    <label for="model2" class="form-label">Model *</label>
                                    <div class="input-group mb-3 ">
                                        <span class="input-group-text txt fw-bold bg-primary text-white">
                                            <i class="fas fa-server"></i>
                                        </span>
                                        <input type="text" class="form-control" id="model2" wire:model="model2" placeholder="Ex: Ecran, Clavier, Serveur, etc..."   required>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <label for="materiel2" class="form-label">Materiel *</label>
                                    <div class="input-group mb-3 ">
                                        <span class="input-group-text txt fw-bold bg-primary text-white">
                                            <i class="fas fa-server"></i>
                                        </span>
                                        <select class="form-control" id="materiel2" wire:model="materiel2">
                                            <option>--Select option--</option>
                                            @foreach ($materiels as $choi)
                                                <option value="{{ $choi->nom }}">{{ $choi->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
    
            </div>
        </div>

    </div>

</div>
