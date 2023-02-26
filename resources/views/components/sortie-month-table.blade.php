<div class="tab-pane @if ($moisc == $i) {{ 'active' }} @endif " id="{{ $moisl }}"
    role="tabpanel">
    <div class=" ">
        <table class="table table-bordered table-striped hover table-sm align-middle ">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">N° Patrimoine</th>
                <th scope="col">Categorie</th>
                <th scope="col">Marque</th>
                <th scope="col">Model</th>
                <th scope="col">User</th>
                <th scope="col">Raison</th>
                <th scope="col">Date</th>
            </thead>
            <tbody class="text-center">
                @if ($results[$i]->isNotEmpty())
                    @php
                        $cnt = 1;
                    @endphp

                    @foreach ($results[$i] as $key => $result)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td><img style="width: 60px; height: 60px; oject-fit: cover;" src="{{ asset($result->materiel->storage_path) }}"  alt="{{ $result->materiel->filename }}"
                                    role="button" wire:click="showImg('{{ $result->materiel->id }}')" data-bs-toggle="modal"
                                    data-bs-target="#imgmodal"> </td>
                            <td>{{ $result->materiel->num_patrimoine }}</td>
                            <td>{{ $result->category->name }}</td>
                            <td>{{ $result->marque->name }}</td>
                            <td>{{ $result->model->name }}</td>
                            <td>{{ ucfirst($result->submitedby) }}</td>
                            <td>{{ $result->raison }}</td>
                            <td>{{ date('d/m/Y', strtotime($result->date_sortie))}}</td>
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
</div>
