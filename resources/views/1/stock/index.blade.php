@extends('1.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks' ])
@section('content')
    <div class="">

        <x-alert />
        
        <livewire:stock-index />

    </div>
@endsection
