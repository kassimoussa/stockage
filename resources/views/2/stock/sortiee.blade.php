@extends('2.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')

    <div class="cont">

        {{-- <div class="row mt-3">
            <form action="{{ url('/stocks/retrait', $stock) }}" role="form" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="card col-md-12 mb-3">
                    <h4 class="card-header text-center">Sortie de stock</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold ">Materiel</span>
                                    <input type="text" class="form-control" name="materiel"
                                        value="{{ $stock->materiel }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 mb-3">
                                    <span class="input-group-text txt fw-bold ">Quantité</span>
                                    <input type="number" class="form-control" name="quantite" min="1" max="{{ $stock->quantite }}"
                                        placeholder="Quantité disponible: {{ $stock->quantite }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3 ">
                                    <span class="input-group-text txt fw-bold ">Raison</span>
                                    <input type="text" class="form-control" name="raison">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3 mb-3">
                                    <span class="input-group-text txt fw-bold ">Date</span>
                                    <input type="date" class="form-control" name="date_sortie" required >
                                </div>
                            </div>

                            <div class="row mt-3 mb-2">
                                <div class="col-md-12 form-group text-center">
                                    <button type="submit" name="submit" class="btn btn-primary fw-bold">Soumettre</button>
                                    <button type="reset" class="btn btn-outline-danger  fw-bold">Annuler</button> 
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </form>
        </div>
        <br> 
        <div class="col-md-12">
            <h3>Dernières Sorties pour {{ $stock->materiel }}</h3>
            <table class="table table-bordered border-dark table-sm table-hover" id="">
                <thead class="  table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Raison</th>
                    <th scope="col">User</th>
                    <th scope="col">Date</th>
                </thead>
                <tbody>
                    @if (!empty($sorties) && $sorties->count())
                        @php
                            $cnt = 1;
                        @endphp

                        @foreach ($sorties as $key => $sortie)
                            <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $sortie->quantite }}</td>
                                <td>{{ ucfirst($sortie->raison) }}</td>
                                <td>{{ $sortie->username }}</td>
                                <td>{{ date('d/m/Y', strtotime($sortie->date_sortie)) }}</td>
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

        </div> --}}

        <livewire:stock-sortie :stock="$stock" />


    </div>
    <style>
        .txt {
            width: 20%;
        }

    </style>
@endsection
