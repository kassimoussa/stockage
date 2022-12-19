<div class="py-3 px-3">
    <x-loading-indicator />
    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">La liste des users </h3>

        <a data-bs-toggle="modal" data-bs-target="#adduser" class="btn  btn-outline-dark  fw-bold">Nouvelle Utilisateur</a>

    </div>

    <div class="modal fade" id="adduser" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-xl modal-dialog-centered " role="document">
            <div class="modal-content">
                <form wire:submit.prevent="storeuser">
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
                        <div class="row ">
                            <div class="col-6 mb-3">
                                <label for="name" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="name" placeholder="Nom de l'user "
                                    wire:model="name" required>
                                <span class="text-danger mb-1">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="username" class="form-label">Username *</label>
                                <input type="username" class="form-control" id="username" placeholder="Username"
                                    wire:model="username" required>
                                <span class="text-danger mb-1">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" placeholder="email de l'user "
                                    wire:model="email" required>
                                <span class="text-danger mb-1">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Mot de passe de l'user " wire:model="password" required>
                                <span class="text-danger mb-1">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
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
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Par nom"
                    value="{{ $search }}">
            </div>
        </form>
    </div>

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($users->isNotEmpty())
                    @php
                        $cnt = 1;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="td-actions ">
                                <a data-bs-toggle="modal" data-bs-target="#editmodal"
                                    wire:click="edit_modal('{{ $user->id }}')" class="btn "
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn" data-bs-toggle="modal"
                                    data-bs-target="#delmodal"
                                    wire:click="delid('{{ $user->id }}')">
                                    <i class="fas fa-trash-alt"></i> 
                                </a>
                            </td>
                        </tr>
                        @php
                            $cnt = $cnt + 1;
                            $editmodal = 'edit' . $cnt;
                            $delmodal = 'delete' . $cnt;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <x-delete-modal delmodal="delmodal" message="Etes-vous sûr de vouloir supprimer l'user " />
        <div class="modal fade" id="editmodal" tabindex="-1" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="update">
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
                            <div class="row ">
                                <div class="col-12 mb-3">
                                    <label for="ed_name" class="form-label">Nom *</label>
                                    <input type="text" class="form-control" id="ed_name"
                                        placeholder="Nom de l'user " wire:model="ed_name" required>
                                    <span class="text-danger mb-1">
                                        @error('ed_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ed_username" class="form-label">Username *</label>
                                    <input type="text" class="form-control" id="ed_username"
                                        placeholder="Username" wire:model="ed_username" required>
                                    <span class="text-danger mb-1">
                                        @error('ed_username')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="ed_email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="ed_email"
                                        placeholder="email de l'user " wire:model="ed_email" required>
                                    <span class="text-danger mb-1">
                                        @error('ed_email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                               {{--  <div class="col-6 mb-3">
                                    <label for="ed_password" class="form-label">Password *</label>
                                    <input type="password" class="form-control" id="ed_password"
                                        placeholder="Mot de passe de l'user " wire:model="ed_password" required>
                                    <span class="text-danger mb-1">
                                        @error('ed_password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

</div>
