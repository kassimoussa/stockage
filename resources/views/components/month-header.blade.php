<li class="nav-item">
    <a class="nav-link  fw-bold @if ($moisc == $i) {{ 'active' }} @endif"
     href="#{{ $moisl }}" role="tab" aria-controls="{{ $moisl }}" aria-selected="true"
     data-bs-toggle="tooltip" data-bs-placement="top" title="Total = {{ $cnts }}">{{ ucfirst($moisl) }}</a>
</li>