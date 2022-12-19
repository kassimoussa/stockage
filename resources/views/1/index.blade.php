@extends('1.layout', ['page' => 'Accueil', 'pageSlug' => 'index'])
@section('content')
    <div class="containe">

        <x-alert />
       
        <div class="row row-cols-2 row-cols-md-3 g-4 py-2 d-flex justify-content-center">
            <x-card-icon icon="fa-warehouse" title="Stocks " url="/stocks" text="Voir les stocks" />
            @if (session('service') == 'Virtualisation & Système')
                <x-card-icon icon="fa-user-cog" title="Administration" url="/admin" text="Voir la liste des users " />
            @endif
        </div>
    </div> 
@endsection
