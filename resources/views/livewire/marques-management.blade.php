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
        <div class="modal-dialog modal-md " role="document">
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
                        <div class="row">
                            <div class="col-12 ">
                                <label for="name" class="form-label">Marque *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="name" wire:model="name"
                                        placeholder="ex HP, Logtech, ..." required>
                                </div>
                            </div>
                            <div class="d-grid  dropdown-center btn align-middle">
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false">
                                    Selectionner les categories
                                </button>
                                <div class="dropdown-menu" wire:ignore>
                                    @php
                                    $cntcb = 1;
                                    $cbidadd = 'cbidadd' . $cntcb;
                                    @endphp
                                    @foreach ($allCategories as $choi)
                                    <div class="form-check mx-3 py-1">
                                        <input type="checkbox" class="form-check-input" id="{{ $cbidadd }}"
                                            value="{{ $choi->id }}" wire:model="categories">
                                        <label class="form-check-label" for="{{ $cbidadd }}">{{ $choi->name }}</label>
                                    </div>
                                    @unless($loop->last)
                                    <hr class="dropdown-divider">
                                    @endunless
                                    @php
                                    $cntcb += 1;
                                    $cbidadd = 'cbidadd' . $cntcb;
                                    @endphp
                                    @endforeach
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
        <div class="modal-dialog modal-md " role="document">
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
                            <div class="col-12 ">
                                <label for="name2" class="form-label">Marque *</label>
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <input type="text" class="form-control" id="name2" wire:model="name2" required>
                                </div>
                            </div>
                            <div class="d-grid  dropdown-center btn align-middle">
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false">
                                    Selectionner les categories
                                </button>
                                <div class="dropdown-menu" wire:ignore>
                                    @php
                                    $cntcb = 1;
                                    $cbidedit = 'cbidedit' . $cntcb;
                                    @endphp
                                    @foreach ($allCategories as $choi)
                                    <div class="form-check mx-3 py-1">
                                        <input type="checkbox" class="form-check-input" id="{{ $cbidedit }}"
                                            value="{{ $choi->id }}" wire:model="selected_categories">
                                        <label class="form-check-label" for="{{ $cbidedit }}">{{ $choi->name }}</label>
                                    </div>
                                    @unless($loop->last)
                                    <hr class="dropdown-divider">
                                    @endunless
                                    @php
                                    $cntcb += 1;
                                    $cbidedit = 'cbidedit' . $cntcb;
                                    @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="modal fade" id="attach" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="attach">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajouter à une categorie </h3>
                        <div class="row" style="text-align: center;">
                            <div class=" form-group">
                                <button type="submit" name="submit" class="btn btn-primary fw-bold"
                                    data-bs-dismiss="modal">Enregistrer</button>
                                <button type="button" class="btn btn-danger fw-bold " wire:click="close_modal"
                                    data-bs-dismiss="modal" data-bs-dismiss="dropdown"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center my-2"> 
                            <div class="dropdown-center btn my-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    Selectionner les categories
                                </button>
                                <div class="dropdown-menu" wire:ignore>
                                    @php
                                    $cntcb = 1;
                                    $cbid = 'cbid' . $cntcb;
                                    @endphp
                                    @foreach ($allCategories as $choi)
                                    <div class="form-check mx-3 py-1">
                                        <input type="checkbox" class="form-check-input" id="{{ $cbid }}"
                                            value="{{ $choi->id }}" wire:model="selected_categories">
                                        <label class="form-check-label" for="{{ $cbid }}">{{ $choi->name }}</label>
                                    </div>
                                    @unless($loop->last)
                                    <hr class="dropdown-divider">
                                    @endunless
                                    @php
                                    $cntcb += 1;
                                    $cbid = 'cbid' . $cntcb;
                                    @endphp
                                    @endforeach
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
                <th scope="col">Marque</th>
                <th scope="col">Categories</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($marques->isNotEmpty())
                @php
                $cnt = 1;
                $addmodal = 'add' . $cnt;
                $editmodal = 'edit' . $cnt;
                $delmodal = 'delete' . $cnt;
                $showmodal = 'showmodal' . $cnt;
                @endphp

                @foreach ($marques as $key => $marque)
                <tr>
                    <td>{{ $cnt }}</td>
                    <td>{{ $marque->name }}</td>
                    <td>
                        <div class="dropdown ">
                            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" aria-expanded="false">
                                Categories : {{ $marque->categories->count() }}
                            </button>
                            <div class="dropdown-menu">
                                @foreach ($marque->categories as $cat)
                                <div class="text-center">
                                    <label>{{ $cat->name }}</label>
                                </div>
                                @unless($loop->last)
                                <hr class="dropdown-divider">
                                @endunless
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td class="td-actions ">
                        {{-- <a class="btn " data-bs-toggle="modal" data-bs-target="#{{ $showmodal }}">
                            <i class="fas fa-eye"></i>
                        </a>
                         <a class="btn  " data-bs-toggle="modal" data-bs-target="#attach"
                            wire:click="loadid('{{ $marque->id }}')" title="Ajouter à une categorie">
                            <i class="fa-solid fa-link"></i>
                        </a> --}}
                        <a class="btn  " data-bs-toggle="modal" data-bs-target="#edit"
                            wire:click="loadid('{{ $marque->id }}')" title="Modifier le categorie">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn  " data-bs-toggle="modal" data-bs-target="#delete"
                            wire:click="loadid('{{ $marque->id }}')" title="Supprimer le categorie">
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