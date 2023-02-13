@extends('2.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks' ])
@section('content')
    <div class="">

        <x-alert />
        
        <livewire:toggle-stock :site="$site" />

    </div>
@endsection
