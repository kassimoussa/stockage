<div class="py-4 px-3 ">
    <x-loading-indicator />
    <div class="d-flex justify-content-end  mb-4">

        <select wire:model="annex" id="list" class="  form-group float-end mb-2 ">
            <option disabled="disabled">Choisir une année</option>
            <option value="2023">2023 </option>
            <option value="2024">2024 </option>
        </select>
    </div>
    <div class="card ">
        <div class="card-header">
            <ul class="nav nav-tabs nav-justified card-header-tabs" id="statsg" role="tablist">
                <x-month-header moisl="janvier" i="01" />
                <x-month-header moisl="février" i="02" />
                <x-month-header moisl="mars" i="03" />
                <x-month-header moisl="avril" i="04" />
                <x-month-header moisl="mai" i="05" />
                <x-month-header moisl="juin" i="06" />
                <x-month-header moisl="juillet" i="07" />
                <x-month-header moisl="aôut" i="08" />
                <x-month-header moisl="septembre" i="09" />
                <x-month-header moisl="octobre" i="10" />
                <x-month-header moisl="novembre" i="11" />
                <x-month-header moisl="décembre" i="12" />
                {{--
                <x-month-header moisl="tout" i="13" /> --}}
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content my-2">
                 <div class="tab-pane @if ($moisc == 1) {{ 'active' }} @endif " id="janvier" role="tabpanel">

                    <x-sortie-month-table moisl="janvier" i="1" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="février" i="2" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="mars" i="3" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="avril" i="4" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="mai" i="5" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="juin" i="6" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="juillet" i="7" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="aôut" i="8" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="septembre" i="9" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="octobre" i="10" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="novembre" i="11" :results="$sorties" />
                </div>
                <div class="tab-content my-2">
                    <x-sortie-month-table moisl="décembre" i="12" :results="$sorties" />
                </div>  
                {{-- <div class="tab-content my-2">
                    <div class="tab-pane @if ($moisc == 2) {{ 'active' }} @endif " id="fevrier" role="tabpanel">
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
                                    @if ($sorties[2]->isNotEmpty())
                                    @php
                                    $cnt = 1;
                                    @endphp

                                    @foreach ($sorties[2] as $key => $result)
                                    <tr>
                                        <td>{{ $cnt }}</td>
                                        <td><img style="width: 60px; height: 60px; oject-fit: cover;"
                                                src="{{ asset($result->materiel->storage_path) }}"
                                                alt="{{ $result->materiel->filename }}" role="button"
                                                wire:click="showImg('{{ $result->materiel->id }}')"
                                                data-bs-toggle="modal" data-bs-target="#imgmodal"> </td>
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
                </div> --}}

            </div>

        </div>

    </div>
    <x-img-modal imgmodal="imgmodal" :imgurl="$imgUrl" />

    <script>
        $('#statsg a').on('click', function(e) {
            e.preventDefault()
            $(this).tab('show')
        });
    </script>
</div>