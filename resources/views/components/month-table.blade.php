<div class="tab-pane @if ($moisc == $i) {{ 'active' }} @endif " id="{{ $moisl }}"
    role="tabpanel">
    <div class=" ">
        <table class="table table-bordered table-striped hover table-sm align-middle ">
            <thead class="bg-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Marteriel</th>
                <th scope="col">Quantité</th>
                <th scope="col">{{ ucfirst($txt) }}</th>
                <th scope="col">User</th>
                <th scope="col">Date</th>
            </thead>
            <tbody class="text-center">
                @if ($results->isNotEmpty())
                    @php
                        $cnt = 1;
                    @endphp

                    @foreach ($results as $key => $result)
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $result['materiel'] }}</td>
                            <td>{{ $result['quantite'] }}</td>
                            <td>{{ $result[$txt] }}</td>
                            <td>{{ ucfirst($result['submitedby']) }}</td>
                            <td>{{ date('d/m/Y', strtotime($result[$date])) }}</td>
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
