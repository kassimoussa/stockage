<div class="py-3 px-3">
    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title ">Stock du site {{ $site }} </h3>
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <a role="button" data-bs-toggle="modal" data-bs-target="#addmateriel" type="button"
                class="btn  btn-outline-dark fw-bold">Ajouter Materiel</a>
            <a href="{{ url('/stocks/allrentrees', $site)  }}" type="button" class="btn  btn-outline-dark fw-bold">Rentrées</a>
            <a href="{{ url('/stocks/allsorties', $site)  }}" type="button" class="btn  btn-outline-dark fw-bold">Sorties</a>
        </div>
    </div>

    <div class="modal fade" id="addmateriel" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeStock">
                    <div class="modal-header d-flex justify-content-between">
                        <h3>Ajout </h3>
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

                        <div class="field_wrapper col mb-2">
                            <div class="input-group">
                                <a class="input-group-text icon add_button">
                                    <i class="fa fa-tools" aria-hidden="true"></i>
                                </a>
                                <input type="text" class="form-control" wire:model="materiel"
                                    placeholder="Nom du matériel" required>
                                <input type="number" class="form-control" wire:model="quantite" placeholder="Quantité"
                                    min="1" required>
                                <input type="file" wire:model="filename" class="form-control" accept="image/*">
                                {{--  <input type="text" name="site" value="{{ $site }}" hidden > --}}

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-start mb-2">
        <form action="" class="col-md-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark" >Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Par matériel"
                    value="{{ $search }}">
            </div>
        </form>
    </div>

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle "
            id="">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Materiels</th>
                <th scope="col">Quantité</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($stocks->isNotEmpty())
                    @php
                        $cnt = 1;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                        $showmodal = 'showmodal' . $cnt;
                    @endphp

                    @foreach ($stocks as $key => $stock)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $stock->materiel }}</td>
                            <td>{{ $stock->quantite }}</td>
                            <td class="td-actions ">
                                <a href="{{ url('/stocks/rentree', $stock) }}" class="btn  " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Rentrée de stock">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ url('/stocks/sortie', $stock) }}" class="btn  " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Sortie de stock">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <a class="btn" data-bs-toggle="modal"
                                    data-bs-target="#delmodal"
                                    wire:click="delid('{{ $stock->id }}')">
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

        <x-delete-modal delmodal="delmodal" message="Etes-vous sûre de supprimer le materiel du stock " />

    </div>

</div>
