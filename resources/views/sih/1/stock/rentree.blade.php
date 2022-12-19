@extends('1.layout', ['page' => 'Gestion des stocks', 'pageSlug' => 'stocks'])
@section('content')

   <div class="">

   <livewire:stock-rentree :stock="$stock" />


    </div>
    <style>
        .txt {
            width: 20%;
        }

    </style>
@endsection
