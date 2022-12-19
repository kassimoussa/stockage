@extends('1.layout', ['page' => 'Liste des utilisateurs', 'pageSlug' => 'admin'])
@section('content')
    <div class="conainer">
        
        <livewire:admin-liste-users  />

    </div>
@endsection
