@extends('2.layout', ['page' => 'Liste des utilisateurs', 'pageSlug' => 'admin'])
@section('content')
    <div class="conainer">
        
        <livewire:admin-liste-users  />

    </div>
@endsection
